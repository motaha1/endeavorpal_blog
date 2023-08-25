<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Models\Comment;
use Illuminate\Support\Facades\Session;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, Post $post)
    {
        $com = new Comment([
            'body' => $request->comment,
           
            'post_id' => session('last_viewed_post_id'),
          
            'user_id' =>auth() ->user() ->id , 
        ]);

        $com->save();
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, $id)
     {
         $comment = Comment::findOrFail($id);
         $comment->update([
             'body' => $request->input('editedComment')
         ]);
 
         return redirect()->back()->with('updateSuccess', true);
     }
 
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $postId = $comment->post_id; // Get the associated post ID
        
        $comment->delete();
    
        // Assuming you have the Post model and the slug attribute
        $post = Post::find($postId);
    
        return redirect('/blog/' . $post->slug)->with('updateSuccess2', true);
    }



    public function toggleActivation(Request $request, Comment $comment)
    {
        // $comment->update(['active' => !$comment->active]);
        // $comment->save();

        $comment->active = !$comment->active;
        $comment->save();
  
        return redirect()->back()->with('success', 'Comment activation status toggled successfully.');
    }

    
}
