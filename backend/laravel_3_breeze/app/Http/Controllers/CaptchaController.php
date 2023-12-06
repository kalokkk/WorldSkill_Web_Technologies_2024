<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaptchaController extends Controller
{
    private $CAPTCHA_TOKEN_KEY = "captcha_token";

    public function index(Request $request) {
        $this->setCaptchaTokenIfNotExists($request);

        return view('captcha.index');
    }

    public function submit(Request $request) {
        $captcha_value = $request->input('captcha_value');

        return response($captcha_value . " is correct!");
    }

    private function setCaptchaTokenIfNotExists(Request $request) {
        if ($request->session()->exists($this->CAPTCHA_TOKEN_KEY)) {
            return;
        }

        $captcha_token = strtoupper(Str::random(4));
        $request->session()->put($this->CAPTCHA_TOKEN_KEY, $captcha_token);
    }

    public function generateImage(Request $request) {
        if (!$request->session()->exists($this->CAPTCHA_TOKEN_KEY)) {
            return asset('/images/placeholder.svg');
        }

        $captch_token = $request->session()->get($this->CAPTCHA_TOKEN_KEY);

        // (A) OPEN IMAGE
        $img = imagecreate(130, 44);
        $white = imagecolorallocate($img, 100,100,100);
        imagefill($img, 0, 0, $white);
        // (B) WRITE TEXT
        $txt = $captch_token;
        $fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!
        $fontSize = 24;
        $fontColor = imagecolorallocate($img, 255, 0, 0);
        $posX = 20;
        $posY = 35;
        $angle = 0;
        imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
        // (C) OUTPUT IMAGE
        // (C1) DIRECTLY SHOW IMAGE
        ob_start(); // Start intecepting data
        imagepng($img);
        $image_data = ob_get_clean(); // End inteception
        imagedestroy($img);
        
        return response($image_data)->header('Content-type', 'image/png');
    }

    
}
