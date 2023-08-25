

@extends('layouts.app')
@section('content')

<title>Blog Detail</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .container {
        padding: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .blog-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }
    .author-info {
        font-size: 14px;
        color: #777;
    }
    .comment-list {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }
    .comment {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #fff;
    }
    .comment strong {
        color: #333;
    }
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        resize: vertical;
    }
    .comment-form button {
        margin-top: 10px;
    }
</style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        @if (Auth::check())
        @if (Auth::user()->id == $post->user_id || Auth::user()->super == 1)
            <div class="post-actions">
                @if (Auth::user()->id == $post->user_id || Auth::user()->super == 1)
                    <a href="/blog/{{$post->slug}}/edit/" class="btn btn-sm btn-primary">Edit Post</a>
                @endif
    
                @if (Auth::user()->id == $post->user_id)
                    <form class="d-inline" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                    </form>
                @endif
    

                @if (Auth::user()->super == 1)
                <form class="d-inline" action="{{ route('posts.toggleActivation', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $post->active ? 'btn-success' : 'btn-danger' }}">
                        {{ $post->active ? 'its active' : 'its deactive' }}
                    </button>
                </form>
            @endif
        </div>
    @endif
    @endif

        <div class="col-md-8 offset-md-2">
            <img src="/images/{{ $post->image_path }}" alt="Blog Image" class="img-fluid blog-image mb-3">
            <h2 class="mb-3">{{ $post->title }}</h2>
            <p class="mb-3">{{ $post->description }}</p>
            <p class="author-info">Author: {{ $post->user->name }} &nbsp;|&nbsp; Date: {{ $post->updated_at->format('F d, Y') }}</p>
            <h3 class="mb-3">Comments</h3>
          
            @foreach ($comment as $item)
            <ul class="comment-list">
                <li class="comment">
                    <div class="comment-content">
                        <strong>{{$item->user->name}} : </strong> {{$item->body}} | Created at: {{$item->created_at->format('F d, Y')}}
                    </div>
                @if(Auth::user() &&Auth::user()->super == 1)
                    <div class="comment-actions d-flex justify-content-between">
                        <div>
                            <form action="{{ route('comments.toggleActivation', ['comment' => $item->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ !$item->active ? 'btn-danger' : 'btn-success' }}">
                                    {{ !$item->active ? "It's Deactive" : "It's Active" }}
                                </button>
                            </form>
                        </div>
                        <div>
                            @endif
                            @if (Auth::check())
                                @if (Auth::user()->id === $item->user_id || Auth::user()->super == 1)
                                    <button type="button" class="btn btn-sm btn-primary edit-comment-button" data-toggle="modal" data-target="#editCommentModal" data-comment-id="{{ $item->id }}" data-comment-body="{{ $item->body }}">Edit</button>
                                @endif
                                @if (Auth::user()->id === $item->user_id)
                                    <form class="d-inline" action="/comment/{{$item->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                 
                </li>
            </ul>
        @endforeach
        
        
        @if (Auth::user())
        <h3 class="mb-3">Add a Comment</h3>
        <form class="comment-form" method="POST" action="{{ route('comment.store') }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
        @endif
    
            

            <!-- Modal -->
            <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (!$comment->isEmpty())

                            <form id="editCommentForm" action="{{ route('comment.update', ['comment' => $item->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="editedComment">Comment</label>
                                    <textarea class="form-control" id="editedComment" name="editedComment"></textarea>
                                </div>
                            </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveEditedComment">Save changes</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
 @if(session('updateSuccess'))
    alert("Updated successfully");
@endif

@if(session('updateError'))
    alert("Error updating");
@endif

var editCommentModal = document.getElementById('editCommentModal');
editCommentModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var actionType = button.getAttribute('data-action-type');
    var modal = this;
    
    if (actionType === 'edit') {
        var commentId = button.getAttribute('data-comment-id');
        var commentBody = button.getAttribute('data-comment-body');
        var editCommentForm = modal.querySelector('#editCommentForm');
        var actionUrl = "{{ url('comment') }}/" + commentId;

        modal.querySelector('#editedComment').value = commentBody;
        editCommentForm.setAttribute('action', actionUrl);
    } else if (actionType === 'new') {
        // Clear the form for new comment
        modal.querySelector('#editedComment').value = '';
        var editCommentForm = modal.querySelector('#editCommentForm');
        var actionUrl = "{{ url('commbgnbfdgnfgnfent/store') }}"; // Adjust the route as needed
        editCommentForm.setAttribute('action', actionUrl);
    }
});

var saveButton = document.getElementById('saveEditedComment');
saveButton.addEventListener('click', function() {
    var editCommentForm = document.getElementById('editCommentForm');
    editCommentForm.submit();
});

    </script>
    
    <!-- Add these scripts in your layout file -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</div>
</body>
</html>
@endsection




