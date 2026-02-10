<?php

namespace App\Services\Profile;

use App\Http\Responses\ApiResponder;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Districts;
use App\Models\specialization;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileService
{

    public function getUserInfo(): ?User
    {
        return User::where('id', Auth::user()->id)->select('id', 'name', 'email', 'created_at')->first();
    }

    public function profileUpdate(array $data): bool
    {
        try {
        
            $mdl = User::find(Auth::user()->id);
            $mdl->name = $data['name'];
            $mdl->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
