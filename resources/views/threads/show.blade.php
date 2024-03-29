@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{$thread->title}}
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach

            @if (auth()->check())
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Post</button>
                </form>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate here.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel">

                <div class="panel-body">
                    This thread was published {{ $thread->created_at->diffForHumans() }} by 
                    <a href="#">{{ $thread->creator->name }}</a> and currently has {{ $thread->replies_count }} comments.
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
