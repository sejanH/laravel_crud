<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class Show extends Controller
{

    protected function site_data(){
        $category = DB::table('blogpost_category')->get()->toArray();
        $site_data = DB::table('blogdetails')->get()->toArray();
        $post_info = DB::table('blog_post_details')
                        ->leftJoin('userposts','blog_post_details.id','=','userposts.id')
                        ->select("blog_post_details.*")
                        ->get()
                        ->toArray();
        
        $sitedtls = array($site_data,$category,$post_info);
        return $sitedtls;
    }

    public function pages($page=null)
    {
    $data = DB::table('userposts')
                ->join('blog_post_details','userposts.id','=','blog_post_details.id')
                ->latest()
                ->select('userposts.*','blog_post_details.likes','blog_post_details.dislikes','blog_post_details.clicked')
                ->get();
    $UserComments = new \App\BlogPostComment;
    $comments = $UserComments::select('post_id')->get()->toArray();
    $count = count($comments);
    $count_per_post= array();
    for ($i=0; $i < $count; $i++) { 
        $c = 0;
        for ($j=0; $j < $count; $j++) { 
            if(strcmp($comments[$i]['post_id'],$comments[$j]['post_id'])==0)
            {
                $count_per_post[$comments[$i]['post_id']] = ++$c;
            }
            
        }
    }
        if(!Auth::check()){
            if($page!=null){
                return redirect('/');
            }
            return view('pages.home',['title'=>'Home','posts' => $data,'site_data' => $this->site_data(),'comment'=>$count_per_post]);
        }
        elseif($page==null || $page=='home'){
            return view('pages.home',['title'=>'Home','posts' => $data,'site_data' => $this->site_data(),'comment'=>$count_per_post]);
        }
        switch ($page) {
            case 'create':
            case 'update':
            case 'delete':
                return view('pages.'.$page,['title'=>ucfirst($page),'site_data' => $this->site_data()]);
                break;
            case 'manage':
                $user_data = DB::table('userposts')->select("*")->where('postedby',Auth::user()->username)->latest()->get(); 
                return view('pages.manage',[
                    'title'=>ucfirst($page),
                    'site_data' => $this->site_data(),
                    'user_data'=>$user_data
                ]);
                break;
            default:
                return view('errors.404');
                break;
        }
       return view('pages.'.$page,['title'=>ucfirst($page),'site_data' => $this->site_data(),'comment'=>$count_per_post]);

    }

    public function posts($id=null){
        $id = explode('-', $id);
        $data = DB::table('userposts')
                    ->join('blog_post_details','userposts.id','=','blog_post_details.id')
                    ->where('userposts.id',$id[0])
                    ->select('userposts.*','blog_post_details.likes','blog_post_details.dislikes','blog_post_details.clicked')
                    ->get()->toArray();
        $comments = \App\BlogPostComment::where('post_id','like','%'.$id[0])->latest()->get()->toArray();
        // dd($comments);
        return view('pages.posts',[
                                'title'         => isset($data[0]->title)?$data[0]->title:'Post not found',
                                'site_data'     => $this->site_data(),
                                'post_data'     => $data,
                                'post_comments' => $comments]);
    }
    
    public function UpdatePostById($post_id){
        if(Auth::check()){
            $id = explode('-', $post_id);
            $postbyid = DB::table('userposts')->where('id',$id[0])->get();
            if($postbyid[0]->postedby==Auth::user()->username){
                return view('pages.update',[
                                'title' => 'Update Post',
                                'site_data'=>$this->site_data(),
                                'postDetails'=>$postbyid]);
            }else{
                $this->fourOfour();
                return view('errors.403');
            }
        }else{
            $this->fourOfour();
            return view('errors.403');
        }
    }

    public function profile($username){
        if(Auth::check())
        {
            $data = DB::table('users')->where('username',$username)->get()->toArray();
            return view('pages.profile',['title' => isset($data[0]->username)?'Profile->'.ucfirst($data[0]->username):'Profile not found','site_data' => $this->site_data(),'post_data' => $data]);
        }else{
            return $this->pages('pages.home');
        }
    }

    public function search(Request $search,$query=null){
        $time = microtime(true);
        $category_model = new \App\BlogpostCategory;
        $categories = $category_model::select('category_name')->get()->toArray();
        $matched = false;
        $q= null;
        foreach ($categories as $cat) {
            if($cat['category_name']==$query){
                $matched = true;
                $q = $cat['category_name'];
                break;
            }
        }
        if($matched){
            $data = DB::table('blog_post_details as bpd')
                        ->join('userposts as up','bpd.id','=','up.id')
                        ->where('bpd.category',$q)
                        ->select('up.*','bpd.*')
                        ->get()
                        ->toArray();
            if(count($data)==0){
                $data = null;
            }
            $elapsed = (microtime(true) - $time);
            return view('pages.search',['title' => 'Search result',
                                        'site_data' =>$this->site_data(),
                                        'search_result' => $data,
                                        'elapsed' => $elapsed,
                                        ]);
        }else{
            $data = DB::table('blog_post_details as bpd')
                        ->join('userposts as up','bpd.id','=','up.id')
                        ->where('up.title','like','%'.$search->search.'%')
                        ->orWhere('up.title','like','%'.$search->search.'%')
                        ->select('*')
                        ->get()
                        ->toArray();
            if(count($data)==0){
                $data = null;
            }
            $elapsed = (microtime(true) - $time);
            return view('pages.search',['title' => 'Search result',
                                        'site_data' =>$this->site_data(),
                                        'search_result' => $data,
                                        'elapsed' => $elapsed,
                                        ]);
        }
    }
 

    /*
    http error code 404 message
    */
    public function fourOfour(){
        return view('errors.header',['site_data'=>$this->site_data()]);
    }
}