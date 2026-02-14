<?php

namespace App\Services\Auth;

use App\Http\Responses\ApiResponder;
use App\Http\Tools\Tools;
use App\Mail\RegisterMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            throw new HttpResponseException(
                ApiResponder::error(
                    'E-posta bulunamadı',
                    404,
                    ['E-posta bulunamadı']
                )
            );
        }

        if (! Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(
                ApiResponder::error(
                    'Girilen şifreniz geçersiz.',
                    401,
                    ['Girilen şifreniz geçersiz.']

                )
            );
        }

        if ($user->email_verified_at == null) {
            $this->sendApproveMail($user);
        }

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user'  => $user
        ];
    }

    public function register(array $data): array
    {

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'expert_id' => $data['expert_id'],
            'phone' => $data['phone'],
            'country_id'    => $data['country_id'],
            'city_id'    => $data['city_id'],
            'district_id'    => $data['district_id'],

        ]);



        $this->sendApproveMail($user);

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user'  => $user
        ];
    }

    public function sendApproveMail($user)
    {

        try {
            $code = Tools::codeGenerate(6, true);


            $u = User::find($user->id);
            $u->email_verification_code = $code;
            $u->save();

            Mail::to($user->email)->send(new RegisterMail($user->name, $code));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }



    public function userApproved(array $data): string
    {

        $code = $data['email_verification_code'];
        $user_id = $data['user_id'];

        $user = User::where('id', $user_id)->select('email_verification_code')->first();
        if ($user == null) {
            throw new HttpResponseException(
                ApiResponder::error(
                    'Kullanıcı bulunamadı',
                    404,
                    ['Kullanıcı bulunamadı']
                )
            );
        }
        if ($user->email_verification_code == $code) {

            $mdl = User::find($user_id);
            $mdl->email_verified_at = Carbon::now();
            $mdl->email_verification_code  = null;
            $mdl->save();

            $user = User::find($user_id);
            $token = $user->createToken('api')->plainTextToken;

            return $token;
        } else {
            throw new HttpResponseException(
                ApiResponder::error(
                    'Girilen kod geçersiz.',
                    422,
                    ['Girilen kod geçersiz.']
                )
            );
        }
    }
}
