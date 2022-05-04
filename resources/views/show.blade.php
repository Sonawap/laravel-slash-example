@extends('layouts.app')

@section('title')
    {{ $article->subject }}
@endsection
@section('content')
<div class="container">
    <comment :article_id="{{ $article->id }}"></comment>
</div>
@endsection
