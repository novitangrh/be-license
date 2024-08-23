<?php

namespace App\Services;

class WhatsAppService
{
    public function sendMessage($phone, $message)
    {
        $telp = $phone;
        $telp = str_replace(array("+", " ", "-"), '', $telp);

        if (substr($telp, 0, 1) == "0") {
            $telp = '62' . substr($telp, 1, 30);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('CHAT_API'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
        "number": "'.$telp.'",
        "message": "'.$message.'"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
