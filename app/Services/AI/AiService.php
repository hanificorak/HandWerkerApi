<?php

namespace App\Services\AI;

use App\Http\Responses\ApiResponder;
use App\Http\Tools\Tools;
use App\Mail\RegisterMail;
use App\Models\AiLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class AiService
{

    public function sendGemini(
        $country_name = "",
        $city_name = "",
        $category = "",
        $detail = ""
    ) {

        $prompt = " You are a pricing estimation AI.
                        Give the average service price.
                        Country: {$country_name}
                        City: {$city_name}
                        Category: {$category}
                        Job Detail: {$detail}
    
                        IMPORTANT RULES:
                        - Respond ONLY with price
                        - No explanation
                        - No sentence
                        - Format exactly like: 450 ₺
                        - If unsure, estimate realistically.";

        try {
            $apiKey = config('services.gemini.key');



            $response = Http::timeout(120)->connectTimeout(30)->withHeaders([
                'x-goog-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent',
                [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            $data = $response->json();

            $result = data_get(
                $data,
                'candidates.0.content.parts.0.text'
            );

            $this->addLogs($prompt, 1, null, trim($result));
            return ['status' => true, 'message' => trim($result)];
        } catch (\Throwable $th) {
            $this->addLogs($prompt, 0, $th->getMessage());

            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    public function addLogs($prompt = null, $status = false, $err = null, $result = null)
    {
        $mdl = new AiLogs();
        $mdl->user_id = FacadesAuth::user()->id;
        $mdl->status = $status;
        $mdl->promp = $prompt;
        $mdl->result = $result;
        $mdl->error_info = $err;
        $mdl->ai_type = "gemini";
        $mdl->api_key = config('services.gemini.key');
        $mdl->save();
    }
}
