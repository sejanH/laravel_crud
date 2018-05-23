<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userpost;
use App\BlogPostDetails;
use App\BlogPostComment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('pages.home',['title'=>'Home']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $randId = str_random(10);
        $post_created = Userpost::create([
                        'id'        =>  $randId,
                        'postedby'  =>  Auth::user()->username,
                        'title'     =>  $request->title,
                        'body'      =>  $this->scriptStripper($request->body),
                        ]);
        if(! $post_created){
            return null;
        }
        return $randId;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $result = $this->create($request);
     //   dd($result);
        if($result){
            BlogPostDetails::create([
                'id'   => $result,
                'clicked'   => 0,
                'likes'     => 0,
                'dislikes'  => 0,
                'category'  =>$request->category,
            ]);
            $request->session()->flash('msg','Post created successfully');
        }else{
            $this->create($request);
        }
        return redirect('create');
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
        //
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
        $post = Userpost::findOrFail($id);
        $post->exists = true;
        $post->update($request->all());
        $title = \DB::table('userposts')->select('title')->where('id',$id)->get();
        $request->session()->flash('msg','Post updated successfully');
        return redirect('post/edit/'.$id.'-'.str_slug($title[0]->title,'~'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            BlogPostDetails::destroy($id);
            Userpost::destroy($id);
        }
        \Request::session()->flash('msg','Post deleted successfully');
        return redirect()->back();   
    }

    public function clicked($id=null){
        \DB::table('blog_post_details')->where('id',$id)->increment('clicked');
    }

    public function comment($id,Request $request){
        if(Auth::check())
        {
            $user = Auth::user()->username;
            $post_id = $id;
            $comment_model = new BlogPostComment;
            $comment_model->user = $user;
            $comment_model->post_id = $id;
            $comment_model->comment = $this->scriptStripper($request->comment);
            $comment_model->save();
        }
        return redirect()->back();
    }

    public function checkExists($id,$column){
        $allowed = true;
        $username = Auth::user()->username;
        $old_members = \DB::table('blog_post_details')->select('liked_by','disliked_by')->where('id',$id)->get();
        $old_members2 = explode(',', $old_members[0]->$column);
        foreach ($old_members2 as $user) {
            if($username==$user){
                $allowed = false;
            }
        }
        if($column=='disliked_by'){
            $matched = false;
            $likers = explode(',', $old_members[0]->liked_by);
            foreach ($likers as $l) {
                if($username==$l){
                    \DB::table('blog_post_details')->where('id',$id)->decrement('likes');
                    $matched= true;
                    break;
                }
            }
            if($matched){
                $new_likers = str_replace($username.',','' , $old_members[0]->liked_by);
                \DB::table('blog_post_details')->where('id',$id)->update(['liked_by' => $new_likers]);
            }
        }else{
            $matched = false;
            $dislikers = explode(',', $old_members[0]->disliked_by);
            foreach ($dislikers as $l) {
                if($username==$l){
                    \DB::table('blog_post_details')->where('id',$id)->decrement('dislikes');
                    $matched= true;
                    break;
                }
            }
            if($matched){
                $new_dislikers = str_replace($username.',','' , $old_members[0]->disliked_by);
                \DB::table('blog_post_details')->where('id',$id)->update(['disliked_by' => $new_dislikers]);
            }
        }
        return array(
                    'allowed' => $allowed,
                    'members' => $old_members[0]->$column
                );
    }

    public function like($id){
        if(Auth::check()){
            $username = Auth::user()->username;
            $result = $this->checkExists($id,'liked_by');
            if( $result['allowed'] == true ){
                \DB::table('blog_post_details')->where('id',$id)->increment('likes');
                \DB::table('blog_post_details')->where('id',$id)->update(['liked_by' => $username.','.$result['members']]);
                $final = \DB::table('blog_post_details')->select('likes','dislikes')->where('id',$id)->get()->toJson();
                echo $final;
        }else{
            echo json_encode(false); 
        }
    }else{
        return json_encode("login to like");
    }
}
    public function dislike($id){
        if(Auth::check()){
            $username = Auth::user()->username;
            $result = $this->checkExists($id,'disliked_by');
            if( $result['allowed'] == true ){
                \DB::table('blog_post_details')->where('id',$id)->increment('dislikes');
                \DB::table('blog_post_details')->where('id',$id)->update(['disliked_by' => $username.','.$result['members']]);
                $final = \DB::table('blog_post_details')->select('likes','dislikes')->where('id',$id)->get()->toJson();
                echo $final;
            }else{
                echo json_encode(false); 
            }
    }else{
        return json_encode("login to dislike");
    }
}


    //strip js tags
    function scriptStripper($input)
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $input);
    }


}
