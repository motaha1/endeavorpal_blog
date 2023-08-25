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
<div class="post-grid">
@foreach ($posts as $post)




<div class="col-6 col-md-4 mb-4 post-container {{ !$post->active ? 'inactive-post' : '' }}">


  <div class="post-news">
      <div class="post-news-image">
          <img src="/images/{{ $post->image_path }}" alt="" width="469" height="200">
      </div>
      <div class="post-news-body">
          <div class="unit unit-horizontal">
              <div class="unit-left">
                  <time class="post-news-time" datetime="{{ $post->updated_at }}">
                      <span class="big">{{ date('d', strtotime($post->updated_at)) }}</span>
                      <span class="small">{{ date('F', strtotime($post->updated_at)) }}</span>
                  </time>
              </div>
              <div class="unit-body">
                  <p class="post-news-title">
                      <a href="/blog/{{ $post->slug }}/">{{ $post->title }}</a>
                  </p>
                  <div class="post-news-text">
                      <p>{{ $post->description }}</p>
                      <span class="text-gray-500 italic">by: {{ $post->user->name }}</span>
                  </div>
              </div>
          </div>
      </div>
      <!-- Add your button here -->
      <div class="button-container">
          <a href="/blog/{{$post->slug}}/" class="button">Read More</a>
      </div>
  </div>
</div>





@endforeach
</div>

  <script src="{{ asset('js/core.min.js') }}"></script>

  
@endsection