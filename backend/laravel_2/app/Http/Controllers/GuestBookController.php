<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestBookController extends Controller
{
    public function index() {
        $comments = DB::table('comments')
                        ->get();

        return view('guest_book', compact('comments'));
    }

    public function store(Request $request) {
        $userName = $request->input('user_name', null);
        $message = $request->input('message', null);

        if (isset($userName) && isset($message)) {
            DB::table('comments')
               ->insert(['user_name' => $userName, 'message' => $message]);
        }

        return redirect()->action([GuestBookController::class, 'index']);
    }

    public function delele(Request $request) {
        $id = $request->input('id', null);

        if (isset($id)) {
            DB::table('comments')
                ->where('id', $id)
                ->delete();
        }

        return redirect()->action([GuestBookController::class, 'index']);
    }
}
