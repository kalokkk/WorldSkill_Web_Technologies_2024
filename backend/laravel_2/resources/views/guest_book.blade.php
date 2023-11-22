<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guess Book</title>
</head>
<body>
    <div class="">
        <h1>留言版</h1>
        <span>GUEST BOOK</span>
    </div>

    @if (isset($comments) && count($comments))
    {{-- Comments --}}
    <section>
        <ul>
            @foreach ($comments as $comment)
                <li>
                    <div class="comment-block">
                        <div class="">
                            <span>#{{ $comment->id }} {{ $comment->user_name }} say:</span>
                            <span>{{ $comment->message}}</span>
                        </div>
                        <div class="">
                            <div class="">
                                <form method="POST" action="{{ url('/comment') }}">
                                    @method('PUT')
                                    @csrf
                                    {{-- {{ method_field('PUT') }} --}}
                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                    <button>Like</button>
                                </form>
                                <span>Like count: {{ $comment->like_count }}</span>
                            </div>
                            <form method="POST" action="{{ url('/comment') }}">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id" value="{{$comment->id}}">
                                <button>Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
    @endif

    {{-- Submit Form --}}
    <section>
        <form method="POST" action="{{ url('/comment') }}">
            @csrf
            <input type="text" name="user_name" placeholder="name"/>
            <textarea name="message" id="comment" cols="30" rows="10" placeholder="comment..."></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>