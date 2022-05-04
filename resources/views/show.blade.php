@extends('layouts.app')

@section('title')
    {{ $article->subject }}
@endsection
@section('content')
<div class="container">
    <comment :article_id="{{ $article->id }}" :user_id={{ auth()->user() ? auth()->user()->id : 0 }}></comment>
</div>
@endsection
