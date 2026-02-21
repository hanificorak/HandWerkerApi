<?php

namespace App\Services\Jobs;

use App\Models\MasterPoints;
use App\Models\Offers;
use App\Models\PointsImages;
use App\Models\UserJobs;
use App\Models\UserJobsImages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsService
{

    public function jobsPoint(array $data): array
    {
        try {
            $job_id = $data['job_id'];
            $comment = $data['comment'];
            $point = $data['point'];
            $master_id = $data['master_id'];
            $images = $data['photos'];

            $mdl = new MasterPoints();
            $mdl->create_user_id = Auth::id();
            $mdl->master_id = $master_id;
            $mdl->job_id = $job_id;
            $mdl->point = $point;
            $mdl->comments = $comment;

            $mdl->save();


            if ($images != null && count($images) > 0) {
                foreach ($images as $image) {

                    // Dosya bilgileri
                    $originalName = $image->getClientOriginalName(); // orijinal dosya adı
                    $extension    = $image->getClientOriginalExtension(); // jpg, png
                    $mimeType     = $image->getClientMimeType(); // image/jpeg
                    $fileSize     = $image->getSize(); // byte cinsinden

                    $fileName = uniqid() . '.' . $extension;
                    $path = 'images/points/' . Auth::user()->id . '/' . $mdl->id . '/' . $fileName;

                    // Dosyayı taşı
                    $image->move(
                        public_path('images/points/' . Auth::user()->id . '/' . $mdl->id . ''),
                        $fileName
                    );

                    // DB kaydı
                    $img = new PointsImages();
                    $img->create_user_id       = Auth::id();
                    $img->points_id         = $mdl->id;
                    $img->original_file_name   = $originalName;
                    $img->file_size            = $fileSize; // byte
                    $img->file_type            = $mimeType;
                    $img->path                 = $path;
                    $img->save();
                }
            }


            return ["message" => "OK", "status" => true];
        } catch (\Throwable $th) {
            return ["message" => $th->getMessage(), "status" => false];
        }
    }
}
