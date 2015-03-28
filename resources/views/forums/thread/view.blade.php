@extends('app')

@section('content')
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-8 bbcode">
                {!! app('bbcode')->Parse($post->content_text) !!}
            </div>
            <div class="col-md-4">
                {{ $post->user->name }}
            </div>
        </div>
        <hr/>
    @endforeach
@endsection