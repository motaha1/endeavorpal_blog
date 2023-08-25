@extends('layouts.app')

@section('content')

<div class="m-auto text-center pt-8 pb-4">
  <h1 class="text-4xl font-bold">Update Post</h1>
</div>

<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
  <form action="/blog/{{$post->slug}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-4">
          <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
          <input type="text" id="title" name="title" value="{{$post->title}}"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
          @error('title')
              <div class="text-red-500">{{ $message }}</div>
          @enderror
      </div>
      <div class="mb-4">
          <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
          <textarea id="description" name="description" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">{{$post->description}}</textarea>
          @error('description')
              <div class="text-red-500">{{ $message }}</div>
          @enderror
      </div>
      <div class="mb-4">
          <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
          <input type="file" id="image" name="image"
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
          @error('image')
              <div class="text-red-500">{{ $message }}</div>
          @enderror
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
          Submit Post
      </button>
  </form>
</div>

@endsection
