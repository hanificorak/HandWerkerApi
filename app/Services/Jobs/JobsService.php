<?php

namespace App\Services\Jobs;

use App\Http\Responses\ApiResponder;
use App\Http\Tools\Tools;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Models\UserJobs;
use App\Models\UserJobsImages;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class JobsService
{
    public function get(array $data): array
    {
        try {
            $user = Auth::user();

            $query = UserJobs::where('create_user_id', $user->id);

            if (isset($data['status'])) {
                $query->where('status', $data['status']);
            }

            return $query->get()->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function add(array $data): bool
    {
        try {

            $images = $data['photos'];

            $mdl = new UserJobs();
            $mdl->created_at = Carbon::now();
            $mdl->updated_at = null;
            $mdl->create_user_id = Auth::user()->id;

            $mdl->title = $data['title'];
            $mdl->category = $data['category'];
            $mdl->description = $data['description'];
            $mdl->country = $data['country'];
            $mdl->city = $data['city'];
            $mdl->district = $data['district'];
            $mdl->address = $data['address'];


            if ($mdl->save()) {

                if ($images != null && count($images) > 0) {
                    foreach ($images as $image) {

                        // Dosya bilgileri
                        $originalName = $image->getClientOriginalName(); // orijinal dosya adı
                        $extension    = $image->getClientOriginalExtension(); // jpg, png
                        $mimeType     = $image->getClientMimeType(); // image/jpeg
                        $fileSize     = $image->getSize(); // byte cinsinden

                        $fileName = uniqid() . '.' . $extension;
                        $path = 'images/' . Auth::user()->id . '/' . $mdl->id . '/' . $fileName;

                        // Dosyayı taşı
                        $image->move(
                            public_path('images/' . Auth::user()->id . '/' . $mdl->id . ''),
                            $fileName
                        );

                        // DB kaydı
                        $img = new UserJobsImages();
                        $img->create_user_id       = Auth::id();
                        $img->user_jobs_id         = $mdl->id;
                        $img->original_file_name   = $originalName;
                        $img->file_size            = $fileSize; // byte
                        $img->file_type            = $mimeType;
                        $img->path                 = $path;
                        $img->save();
                    }
                }

                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
