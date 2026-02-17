<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function passwordUpdate(array $data): array
    {
        try {

            if (!Hash::check($data['current_password'], Auth::user()->password)) {
                return ["status" => false, "message" => "Mevcut şifrenizi yanlış girdiniz."];
            }
            $mdl = User::find(Auth::user()->id);
            $mdl->password = Hash::make($data['new_password']);
            $mdl->save();

            return ["status" => true, "message" => 'Şifre başarıyla güncellendi.'];
        } catch (\Throwable $th) {
            return ["status" => false, "message" => $th->getMessage()];
        }
    }
}
