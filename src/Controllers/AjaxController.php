<?php

namespace XRA\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//------- Models --
use function PHPSTORM_META\type;
use XRA\Blog\Models\Post;

class AjaxController extends Controller
{
    public function getPost(Request $request)
    {
        $query = $request->get('query');
        $post_type = $request->get('post_type');
        if (isset($post_type) && !empty($post_type)) {
            $posts = Post::where('type', $post_type)->where('title', 'like', '%'.$query.'%')->get();
        } else {
            $posts = Post::where('title', 'like', '%'.$query.'%')->get();
        }

        return response()->json($posts);
    }
    public function searchRestaurants(Request $request)
    {
        $query = $request->get('query');

        $results = Post::where('type', 'restaurant')
                        ->where('title', 'like', '%'.$query.'%')
                        ->get();


        $view='pub_theme::restaurant.search.search_results';
        return view($view, compact('results'));
    }
}
