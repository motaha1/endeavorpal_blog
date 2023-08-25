@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">


<div class="m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold">all posts</h1>
</div>

@if (Auth::check())
<div>
    <a href="/blog/create/" class="bg-gray-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l place-self-start">New Post</a>
</div>
@endif
{{-- <div class="container sm:grid grid-cols-2 gap-15 mx-auto py-15 px-5">

    <img src="https://picsum.photos/id/343/960/620" alt="">
</div>
<div>
    <h2 >
        hello
    </h2>
    <span class="text-gray-500 italic">
        by :motaha
        <p class="text-l text-gray-700 py-8 leading-6">cdcsdcsd</p>

        <a href="/" class="bg-gray-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l place-self-start">Read more</a>

    </span> --}}
</div>
<div class="row">
    @foreach ($posts as $post)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="post-container {{ !$post->active ? 'inactive-post' : '' }}">
                <div class="post-news">
                    <div class="post-news-image">
                        <img src="/images/{{ $post->image_path }}" alt="" class="img-fluid">
                    </div>
                    <div class="post-news-body">
                        <p class="post-news-title">
                            <a href="/blog/{{ $post->slug }}/">{{ $post->title }}</a>
                        </p>
                        <div class="post-news-text">
                            <p>{{ strlen($post->description) > 60 ? substr($post->description, 0, 100) . '...' : $post->description }}</p>
                            <span class="text-gray-500 italic">by: {{ $post->user->name }}</span>
                        </div>
                    </div>
                    <div class="unit unit-horizontal">
                        <div class="unit-left">
                            <time class="post-news-time" datetime="{{ $post->created_at }}">
                                <span class="big">{{ date('d', strtotime($post->created_at)) }}</span>
                                <span class="small">{{ date('F', strtotime($post->created_at)) }}</span>
                            </time>
                        </div>
                        <div class="unit-body">
                            <div class="button-container">
                                <a href="/blog/{{$post->slug}}/" class="button">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>



  <script src="{{ asset('js/core.min.js') }}"></script>

  
@endsection