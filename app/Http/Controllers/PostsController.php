<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     


        //
        $user = Auth::user();

        // Determine whether the user is an admin (super == 1)
        $isAdmin = $user && $user->super == 1;
    
        // Fetch posts based on the user's role
        if ($isAdmin) {
            $posts = Post::orderBy('created_at', 'desc')->get();
        } else {
            $posts = Post::where('active', true)->orderBy('created_at', 'desc')->get();
        }
    
        return view('blog.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('blog.create') ; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
    
        // Handle image upload and storage
      $newimage =uniqid().'-'.$request->title.'.'.$request->image->extension() ; 
      $request->image->move(public_path('images') , $newimage);
    $slug = Str::slug($request->title , '-') ; 
        // Create a new blog post
        $blog = new Post([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $newimage,
            'slug' =>$slug , 
            'user_id' =>auth() ->user() ->id , 
        ]);
        $blog->save();


        return redirect()->route('blog.index')->with('success', 'Post added successfully!');
      

    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
     

        if ($post) {
            if (!$post || (!$post->active && !Auth::user()->super)) {
                // Post not found or deactivated for normal users
                return redirect('/blog')->with('error', 'This post is not accessible.');
            }
            // Store the last viewed post ID in the session
            $user = Auth::user();

            Session::put('last_viewed_post_id', $post->id);
    
            $isAdmin = $user && $user->super == 1;

            // Fetch comments based on the user's role
            if ($isAdmin) {
                $comment = Comment::where('post_id', $post->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $comment = Comment::where('post_id', $post->id)
                    ->where('active', true)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

      

    
            return view('blog.show', compact('post' , 'comment'));
        }
        //
   
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //

        return view ('blog.edit')->with('post' , Post::where('slug' , $slug)->first()) ; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {
            $post = Post::where('slug', $slug)->first();
    
            // Check if a new image is provided
            if ($request->hasFile('image')) {
                $newimage = uniqid() . '-' . $request->title . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $newimage);
                $post->image_path = $newimage;
            }
    
            // Update the other fields
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = auth()->user()->id;
            $post->save();
    
            return redirect('/blog/' . $slug)->with('updateSuccess', true);
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('updateError', 'An error occurred during the update process.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        Post::where('slug' , $slug)->delete() ; 
        return redirect('/blog/')->with('updateSuccess', true);


    }
    public function toggleActivation(Post $post)
    {
        $post->active = !$post->active;
        $post->save();
    
        return back()->with('toggleSuccess', 'Post status has been updated.');
    }
    

}
