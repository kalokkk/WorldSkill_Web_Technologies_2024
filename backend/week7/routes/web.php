<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $books = Book::query();
    if ($request->input('author')) {
        $author = Author::where('name', $request->input('author'))->first();
        if ($author && $author->books())  $books->orWhereIn('id', $author->books()->pluck('id'));
    }
    if ($request->input('category')) {
        $category = Category::where('name', $request->input('category'))->first();
        if ($category && $category->books()) $books->orWhereIn('id', $category->books()->pluck('id'));
    }
    $books = $books->with('authors')->get();
    $authors = Author::all();
    $categories = Category::all();
    
    return view('home', compact('books', 'authors', 'categories'));
});
