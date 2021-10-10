<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GlobalController extends Controller
{

    function index(Request $request, $path = null,$path2 = null)
    {
        // dd($request->segment(2));
        switch ($path) {
            case null:
                return view('index');
                break;
            case "home":
                return redirect('/');
                break;
            case "category":
                $category = $this->getCategoryBySlug($path2);
                return view('index',compact('category'));
                break;
            case "post": 
                $post = $this->getPostBySlug($path2);
                return view("index",compact('post'));
                break;
            case "new":
                return view("create_new_post");
                break;
            default:
            abort(404);
                break;
        }
    }

    public function getCategoryBySlug($slug){
        if(is_null($slug)){
            abort(404);
        }
        return Category::setEagerLoads([])->where('slug',$slug)->first();

    }
    public function getPostBySlug($slug){
        if(is_null($slug)){
            abort(404);
        }
        return Post::setEagerLoads([])->where('slug',$slug)->first();

    }
}
