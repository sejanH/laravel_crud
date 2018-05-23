<?php

namespace App\Http\Controllers;
use Input;
use Image;
use File;
use Illuminate\Http\Request;
use DB;
use Auth;

class Profile extends Controller
{



    protected function site_data(){
        $category = DB::table('blogpost_category')->get()->toArray();
        $site_data = DB::table('blogdetails')->get()->toArray();
        $sitedtls = array($site_data,$category);
        return $sitedtls;

    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        if(Auth::check())
        {
            $data = DB::table('users')->where('username',$username)->get()->toArray();
            return view('pages.profile',['title' => isset($data[0]->username)?'Profile->'.ucfirst($data[0]->username):'Profile not found','site_data' => $this->site_data(),'post_data' => $data]);
        }else{
            return redirect('home');
        }
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
        //
    }
    /*
    profile image upload 
    */
    public function upload(){

        if(Input::file('image'))
        {
            $user = Auth::user();
            $image = Input::file('image');
            $filename  = $user->username.'-'.time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/user_profile/' . $filename);
            $img = Image::make($image->getRealPath())->resize(230, 230)->save($path);
            $old_pro_pic = DB::table('users')->where('username',$user->username)->get();
            File::delete('images/user_profile/' . $old_pro_pic[0]->profile_pic);
            $user->profile_pic = $filename;
            $user->save();
        }
            return redirect('/profile/'.Auth::user()->username);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
