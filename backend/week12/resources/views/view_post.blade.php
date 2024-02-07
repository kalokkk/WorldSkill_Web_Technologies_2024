<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form > label {
            display: block;
            margin-bottom: 20px;
        }

        form input, form textarea {
            width: 200px;
        }

        form textarea {
            height: 100px;
        }
    </style>
</head>
<body>
    <form action="{{ url('/posts/'.$post->id) }}" method="post">
        @method("PUT")
        @csrf
        
        <label>Title
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </label>
        @error('title')
        <div>{{ $message }}</div>
        @enderror

        <label>Post Date
            <input type="text" name="post_date" value="{{ old('post_date', $post->post_date) }}">
        </label>
        @error('post_date')
        <div>{{ $message }}</div>
        @enderror
        
        <label>Content
            <textarea type="text" name="content">{{ old('content', $post->content) }}</textarea>
        </label>
        @error('content')
        <div>{{ $message }}</div>
        @enderror

        <button type="submit">Save</button>
    </form>
</body>