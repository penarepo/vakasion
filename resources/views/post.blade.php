{{-- @dd($posts) --}}

@extends('layouts.main')
@section('container')
    <article class="mb-5">
        <h2>
            <a href="/posts/{{ $post["slug"] }}" >{{ $post['title'] }} </a>
        </h2>
        <h5>{{ $post['author'] }}</h5>
        <p>{{ $post['body'] }}</p>
    </article>

    <a href="/posts">Kembali</a>

@endsection

  
    
