<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('/posts') }}" method="get">
        <label>Author Name
            <input type="search" name="search" value="{{ old('search') }}">
        </label>

        <label>Date
            <input type="text" name="post_date" value="{{ old('post_date') }}">
        </label>

        <button type="submit">Search</button>
    </form>

    <table width="100%" border="1">
        <tr>
            <th>&nbsp;</th>
            <th>User</th>
            <th>Title</th>
            <th>Content</th>
        </tr>
        <?php $i = 0; ?>
        @foreach($posts as $post)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ Str::excerpt($post->content) }}</td>
        </tr>
        @endforeach
    </table>
    {{ $posts->links() }}

    @vite(['resources/css/app.css'])
</body>
</html>