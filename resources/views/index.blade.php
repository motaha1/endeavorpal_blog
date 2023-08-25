@extends('layouts.app')

@section('content')
<style>


</style>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">


<section class="section section-md vide_bg bg-gray-dark " data-vide-bg="vedio/sss.mp4">
  <div class="container">
    <div class="row spacing-30">
      <div class="col-12">
        <div class="jumbotron-custom jumbotron-custom-variant-2 context-dark">
          <hr class="divider-sm divider-success" data-caption-animate="fxRotateInLeft" data-caption-delay="50">
          <h1 data-caption-animate="fxRotateInRight" data-caption-delay="150">Welcome To Our Blog</h1>
          <p class="subtitle-variant-3" data-caption-animate="fxRotateInLeft" data-caption-delay="350">Lets Start blogging</p> <a class="btn btn-white-outline btn-lg btn-aqil btn-aqil--mod-1" href="/blog/" data-caption-animate="fxRotateInRight" data-caption-delay="550"> <span>LETS START BLOGGING</span> </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <section class="section section-md text-center bg-image context-dark" style="background-image: url(https://as1.ftcdn.net/v2/jpg/03/19/09/92/1000_F_319099272_UaQ98GaYi12EyljeOTAA8op98MeNP7sj.jpg);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-10 col-lg-8">
          <hr class="divider-sm divider-success">
          <h1 class="textillate text-white" data-loop="true"> <span class="textillate-text"> <span data-in-effect="fadeIn" data-out-effect="fadeOut">WELCOME TO THE BLOG</span></span></h1>
          <p class="subtitle-variant-3 text-success">lets start</p> <a class="btn btn-white-outline btn-lg btn-aqil btn-aqil--mod-1" href="/blog"> <span>LET'S START BLOGGING</span> </a>
        </div>
      </div>
    </div>
  </section>

<div class="container sm:grid grid-cols-2 gap-50 mx-auto py-15">
    <div>
        <img class="sm:rounded-lg" src="https://picsum.photos/seed/picsum/960/620" alt="">
    </div>
    <div>
        <h2 class="font-bold text-gray-700 text-4xl uppercase">test</h2>
        <p class="font-bold text-gray-600 text-xl pt-2">hello test</p>
        <p class="py-4 text-gray-500 text-sm leading-5">heloo leoolvff</p>
        <a href="/" class="bg-gray-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l place-self-start">Read more</a>
    </div>
</div> --}}
<script src="{{ asset('js/core.min.js') }}"></script>
@endsection
