<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $this->validate($request, [
            'post_date' => 'nullable|date',
        ]);

        $post_date = $request->input('post_date');
        $search = $request->input('search');

        $post_end_date = (new Carbon($post_date))->add('day', 1)->format("Y-m-d H:i:s");
        // dd($post_end_date);

        // session()->flashInput(['post_date' => $post_date, 'search' => $search]);

        $posts = Post::with(['user'])
            ->whereHas('user', function ($query) use ($search) {
                return $query->when(!empty($search), function ($user_query) use ($search) {
                    return $user_query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when(!empty($post_date), function ($query) use ($post_date, $post_end_date) {
                return $query->where('post_date', '>=', $post_date . " 00:00:00")
                    ->where('post_date', '<', $post_end_date);
            })
            ->paginate(10)
            ->withQueryString();

        // return view('list_posts', compact('posts'));
        return Inertia::render('Post/List', [
            'posts' => $posts,
            'filters' => compact('search', 'post_date')
        ]);
    }

    public function new()
    {
        return Inertia::render('Post/Create', ['post' => new Post()]);
    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'post_date' => 'required|date',
            'content' => 'required',
        ]);

        $post = new Post(
            $request->input()
        );
        $post->user_id = $request->user()->id;
        $post->save();

        return redirect('/posts');
    }

    public function show(Request $request, Post $post)
    {

        if ($request->user()->cannot('view', $post)) {
            abort(403);
        }

        return Inertia::render('Post/Create', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $this->validate($request, [
            'title' => 'required',
            'post_date' => 'required|date',
            'content' => 'required'
        ]);

        $post->update($request->input());

        return redirect('/posts/' . $post->id);
    }

    public function old_posts(Request $request)
    {

        $this->validate($request, [
            'post_date' => 'nullable|date',
        ]);

        $post_date = $request->input('post_date');
        $search = $request->input('search');

        $post_end_date = (new Carbon($post_date))->add('day', 1)->format("Y-m-d H:i:s");
        // dd($post_end_date);

        // session()->flashInput(['post_date' => $post_date, 'search' => $search]);

        $posts = Post::with(['user'])
            ->whereHas('user', function ($query) use ($search) {
                return $query->when(!empty($search), function ($user_query) use ($search) {
                    return $user_query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when(!empty($post_date), function ($query) use ($post_date, $post_end_date) {
                return $query->where('post_date', '>=', $post_date . " 00:00:00")
                    ->where('post_date', '<', $post_end_date);
            })
            ->paginate(10)
            ->withQueryString();

        return view('list_posts', compact('posts'));
    }
}
