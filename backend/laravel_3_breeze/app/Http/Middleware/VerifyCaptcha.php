<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->has('captcha_value')) {
            return redirect()->route('captcha.index')->withErrors(["message" => "Missing input value!"]);
        }

        if ($request->input('captcha_value') !== $request->session()->get('captcha_token')) {
            return redirect()->route('captcha.index')->withErrors(["message" => "The captcha token is incorrect!"]);
        }

        return $next($request);
    }
}
