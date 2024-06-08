<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Sample API",
 *     description="This is a sample API documentation using Swagger and L5-Swagger.",
 *     @OA\Contact(
 *         email="Quantre34@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function Encrypt($key,$data){
        
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = $key;
        $key = hash('sha256', '');//$encryption_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return $output = openssl_encrypt(base64_encode($data), $encrypt_method, $key, 0, $iv);
    }
    ///
    public function Decrypt($key,$data){
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = $key;
        $key = hash('sha256', '');//$encryption_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt($data, $encrypt_method, $key, 0, $iv);
        return $output = base64_decode($output);
    }
}
