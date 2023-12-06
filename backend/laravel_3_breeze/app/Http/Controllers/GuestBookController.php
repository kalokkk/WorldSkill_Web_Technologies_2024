<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestBookController extends Controller
{
    public function index() {
        $comments = DB::table('comments')
                        ->orderBy('id', 'desc')
                        ->get();

        return view('guest_book', compact('comments'));
    }

    public function store(Request $request) {
        $user = $request->user();
        // if (!$user) {
        //     return redirect()
        // }

        $userName = $request->input('user_name', null);
        $message = $request->input('message', null);

        if (isset($userName) && isset($message)) {
            DB::table('comments')
               ->insert(['user_id' => $user->id, 'user_name' => $userName, 'message' => $message]);
        }

        return redirect()->action([GuestBookController::class, 'index']);
    }

    public function like(Request $request) {
        $id = $request->input('id', null);

        if (isset($id)) {
            // $comment = DB::table('comments')
            //     ->where('id', $id)
            //     ->first();

            // DB::table('comments')
            //     ->where('id', $id)
            //     ->update(['like_count' => $comment->like_count + 1]);

            DB::table('comments')
                ->where('id', $id)
                ->increment('like_count');
        }

        return redirect()->action([GuestBookController::class, 'index']);
    }

    public function delete(Request $request) {
        $id = $request->input('id', null);

        $user = $request->user();
        $comment = DB::table('comments')
                        ->where('id', $id)
                        ->first();

        if (!$comment) {
            return redirect()->route('comments');
        }

        if ($comment->user_id != $user->id) {
            return response("You're not authorized!");
        }

        if (isset($id)) {
            DB::table('comments')
                ->where('id', $id)
                ->delete();
        }

        return redirect()->action([GuestBookController::class, 'index']);
    }
}
