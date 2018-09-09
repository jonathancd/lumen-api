<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Http\Middleware\PostMiddleware;

use Validator;

use App\Post;
use App\Sport;
use App\User;

class PostsController extends Controller
{

	public function __construct()
    {

    	$this->middleware('auth_post', [
    								'only' => ['update', 'destroy']
    							  ]);


        $this->messages = [
            'user.required' => "Is required",
            'sport.required' => "Is required",
            'title.required' => "Is required",
            'content.required' => "Is required",
            'date.required' => "Is required",
        ];
    }


    public function create(){

    	$sports = Sport::all();

    	return response()->json(["sports" => $sports], 201);

    }


	public function destroy($post){

		$post = Post::find($post);

		if($post){

			if($post->delete())
				return response()->json(["msg" => "Post deleted successfully."], 201);
			else
				return response()->json(["msg" => "An error has ocurred trying to delete the Post."], 401);

		}else{

			return response()->json(["msg" => "Post not found."], 401);

		}

	}


	public function index(){

		$posts = Post::orderBy('date', 'DESC')->get();

		foreach($posts as $post){
			$post->creator = User::find($post->id_user);
			$post->sport = Sport::find($post->id_sport);
		}

		return response()->json(["posts" => $posts], 201);

	}


	public function show($id_post){

		$post = Post::find($id_post);

		if($post){

			$post->creator = User::find($post->id_user);
			$post->sport = Sport::find($post->id_sport);

			return response()->json(["post" => $post], 201);

		}else{

			return response()->json(["msg" => "Post not found."], 401);

		}

	}


	public function store(Request $request){

		$validation = Validator::make($request->all(),[ 
	        'user' => 'required',
	        'sport' => 'required',
	        'title' => 'required',
	        'content' => 'required'
	    ], $this->messages);


    	if($validation->fails()){

    		$errors = $validation->errors();

    		return response()->json(["errors" => $errors], 401);
    	}


    	$post = new Post;
    		$post->id_user = $request->user;
    		$post->id_sport = $request->sport;
    		$post->title = $request->title;
    		$post->content = $request->content;
    		$post->date = $request->date;

    	if($post->save())
				return response()->json(["msg" => "Post created successfully."], 201);
		else
			return response()->json(["msg" => "An error has ocurred trying to create the Post."], 401);

	}
	

	public function update(Request $request, $id_post){

		$post = Post::find($id_post);

		if($post){

			$validation = Validator::make($request->all(),[ 
		        'sport' => 'required',
		        'title' => 'required',
		        'content' => 'required'
		    ], $this->messages);


	    	if($validation->fails()){

	    		$errors = $validation->errors();

	    		return response()->json(["errors" => $errors], 401);
	    	}

    			$post->id_sport = $request->sport;
    			$post->title = $request->title;
    			$post->content = $request->content;
    			$post->date = $request->date;

			if($post->save())
					return response()->json(["post" => $post,"msg" => "Post updated successfully."], 201);
			else
				return response()->json(["msg" => "An error has ocurred trying to update the Post."], 401);

		}else{

			return response()->json(["msg" => "Post not found."], 401);

		}

	}

}