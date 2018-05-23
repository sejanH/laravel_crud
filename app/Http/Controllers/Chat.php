<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Chatting;

class Chat extends Controller
{
    public function __construct()
    {
        config(['app.timezone' => 'Asia/Dhaka']);
    }

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


    public function showAll()
    {
        if(!Auth::check()){
            return redirect('/home');
        }
        $Chat = new Chatting;
        $sender = Auth::user()->username;
        $chatList = $Chat::query()->where('sender',$sender)->orWhere('receipient',$sender)->latest()->get()->toArray();

        $now = new \DateTime();
        $count = count($chatList);
        for($i=0; $i< $count; $i++) {
            $interval = date_diff(date_create($chatList[$i]['created_at']),$now);
            $hours = $interval->h + ($interval->d*24);
            if($hours>24){
                $chatList[$i]['ago'] = $interval->d.' days '. $interval->h.' hours';
            }else{
                $chatList[$i]['ago'] = $interval->h.' hours '. $interval->i.' mins';
            }
        }
       // dd($chatList);

        return view('pages.chat',[
                    'title'     =>ucfirst('Chat'),
                    'site_data' => $this->site_data(),
                    'msg'       => $chatList
                                 ]);
    }

    public function showOne($user=NULL){
        if(!Auth::check()){
            return redirect('/home');
        }

        if($user)
        {
            $user = explode('-', $user);
            $userExists = \App\User::where('username',$user[0])->orWhere('username',$user[1])->get()->toArray();
            if($userExists){
                $Chat = new Chatting;   
                $chatList = $Chat::query()
                            ->where([
                                'sender' => $user[0],'receipient' => $user[1]
                            ])
                            ->orWhere([
                                'sender' => $user[1],'receipient' => $user[0]
                            ])
                            ->get()->toArray();

                $now = new \DateTime();
                $count = count($chatList);
                for($i=0; $i< $count; $i++) {
                    if($chatList[$i]['sender']!=Auth::user()->username){
                        $chatList[$i]['sender'] = "<a href='".url('profile/'.$chatList[$i]['sender'])."'>".$chatList[$i]['sender']."</a>";
                    }else{
                        $chatList[$i]['sender'] = "me";
                    }
                    $interval = date_diff(date_create($chatList[$i]['created_at']),$now);
                    $hours = $interval->h + ($interval->d*24);
                    if($hours>24){
                        $chatList[$i]['ago'] = $interval->d.' days '. $interval->h.' hours';
                    }else{
                        $chatList[$i]['ago'] = $interval->h.' hours '. $interval->i.' mins';
                    }
                }

                foreach ($chatList as $cl) {
                    echo    "<div class='columns'>";
                    if($cl['sender']=='me'){
                        echo    "<div class='column is-on-thirds' style='font-size:12px;font-weight:600'>".$cl['sender']." <i class='fa fa-angle-right'></i></div>".
                                "<div class='column is-two-thirds'>".$cl['message']."</div>".
                                "<div style='font-size:9px' class='column'>".$cl['ago']."</div>";
                        echo    "</div>";
                    }else{
                    echo    "<div style='font-size:9px' class='column'>".$cl['ago']."</div>".
                            "<div class='column is-two-thirds' style='text-align:right'>".$cl['message']."</div>".
                            "<div class='column is-on-thirds' style='font-size:12px;font-weight:600'><i class='fa fa-angle-left'></i> ".$cl['sender']."</div>";
                    echo    "</div>";
                    }
                }
            }
            else
                dd($userExists);
        }
    }

    public function sendMsg($participants=NULL){
        $Cahtmodel = new Chatting;
       // $send = $Cahtmodel::create();
        return $participants;
    }

    public function fourOfour(){
        return view('errors.header',['site_data'=>$this->site_data()]);
    }
    
}
