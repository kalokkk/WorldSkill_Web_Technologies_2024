<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request) {
        return view('contact');
    }

    public function show(Request $request) {
        list('name' => $name, 'email' => $email, 'message' => $message) = $request->all();

        return view('show_contact', compact('name', 'email', 'message'));
    }
}
