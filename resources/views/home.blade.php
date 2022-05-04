@extends('layouts.app')

@section('title')
    Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @forelse ($articles as $article)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img class="card-img-top" src="{{ $article->image }}" alt="Blog Post">
                            <div class="card-body">
                                <p>Posted by: {{ $article->user->name }} | Comments: {{ $article->comments->count() }} <br> Views: {{ $article->views }} | likes: {{ $article->likes }}</p>
                                <a href="{{ route('show', $article->id) }}" class="text-decoration-none text-primary"><h5 class="card-title text-primary">{{ $article->subject }}</h5></a>
                                <p class="card-text">{{ Str::substr($article->body, 0, 200) }}...</p>
                                @foreach ($article->tags as $tag)
                                    <button type="button" class="btn btn-outline-secondary">{{ $tag }}</button>                            
                                @endforeach
                                <p class="mt-3">
                                    <a href="{{ route('show', $article->id) }}" class="btn btn-primary">Read more...</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4 class="text-center">No Post Yet</h4>
                @endforelse
            </div>
            @if ($articles->count() > 0)
                <div class="card-footer">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
