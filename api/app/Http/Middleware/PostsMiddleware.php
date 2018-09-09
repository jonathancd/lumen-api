<?php

namespace App\Http\Middleware;

use Closure;

use App\Post;
use App\User;

class PostsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::where('token', $request->token)->first();
        $post = Post::find($request->route()[2]['id_post']);

        if($post && $user->id == $post->id_user)
            return $next($request);

        return response()->json([
                'msg' => 'Unauthorized'
            ], 401);
    }
}
