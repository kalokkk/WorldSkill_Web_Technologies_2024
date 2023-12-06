<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guess Book</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>留言版</h1>
            <span>GUEST BOOK</span>
        </div>

        @if (isset($comments) && count($comments))
        {{-- Comments --}}
        <section class="comment-container">
            <ul>
                @foreach ($comments as $comment)
                    <li class="comment-block">
                        <div>
                            <div class="details">
                                <span>#{{ $comment->id }} {{ $comment->user_name }} say:</span>
                                <span>{{ $comment->message}}</span>
                            </div>
                            <div class="btn-group">
                                <div class="">
                                    <span>Like count: {{ $comment->like_count }}</span>
                                    <form method="POST" action="{{ url('/comment') }}">
                                        @method('PUT')
                                        @csrf
                                        {{-- {{ method_field('PUT') }} --}}
                                        <input type="hidden" name="id" value="{{$comment->id}}">
                                        <button>Like</button>
                                    </form>
                                </div>
                                @auth
                                @if (auth()->user()->id === $comment->user_id)
                                <form method="POST" action="{{ url('/comment') }}">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                    <button>Delete</button>
                                </form>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
        @endif

        {{-- Submit Form --}}
        <section class="submit">
            <form method="POST" action="{{ url('/comment') }}">
                @csrf
                <input type="text" name="user_name" placeholder="name"/>
                <textarea name="message" id="comment" cols="30" rows="10" placeholder="comment..."></textarea>
                <button type="submit">Submit</button>
            </form>
        </section>
    </div>
</body>
</html>