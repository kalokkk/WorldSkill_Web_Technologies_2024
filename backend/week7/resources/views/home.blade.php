<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="GET" action="/">
        Filter for the Books
        <label for="author">Authors
            <select name="author" id="author">
                @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{ $author->name }}</option>
                @endforeach
            </select>
        </label>
        <label for="category">Category
            <select name="category" id="">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <button>Filter</button>
    </form>

    <div class="">
        <table>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ isset($book->category->name) ? $book->category->name : '' }}</td>
                    {{-- <td>{{ $book->name }}</td> --}}
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>