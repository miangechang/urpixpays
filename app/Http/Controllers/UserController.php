<?php

namespace App\Http\Controllers;
use App\Mail\InviteEmail;
use function foo\func;
use Mail;
use App\Mail\TestEmail;
use App\User;
// use App\Http\Controllers\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Session;
use DateTime;
use Carbon\Carbon;
// you have this
use App\File;

use Illuminate\Http\Request;

// add this
use Illuminate\Support\Facades\File as LaraFile;
class UserController extends Controller
{
    /**
     * Show the profile for the given user.
    
     * @param  int  $id
     * @return View
     */
    public function __construct()
    {
        $date=Carbon::now();
        DB::statement("UPDATE `image` SET  `image`.`boosttime` =`image`.`boosttime`-TIMESTAMPDIFF(SECOND,`image`.`boostdate`, '".$date."') where `image`.`booststate`='1'");
        DB::table('image')->where('boosttime',"<",0)->update(['booststate'=>0,'boosttime'=>0]);

        DB::statement("UPDATE `ujoinc` SET  `ujoinc`.`datetime` =  `ujoinc`.`datetime`-TIMESTAMPDIFF(SECOND,`ujoinc`.`exposure`, '".$date."') where `ujoinc`.`exposurestate`='1'");
        DB::table('ujoinc')->where('datetime',"<",0)->update(['exposurestate'=>0,'datetime'=>0]);

        DB::table('image')->where('booststate','>',0)->update(['boostdate'=>$date]);

        DB::table('ujoinc')->where('datetime','>',0)->update(['exposure'=>$date]);

        DB::statement("UPDATE `challenge` SET `state`='completed' WHERE TIMESTAMPDIFF(HOUR ,`start-time`, '".$date."')>`timeline` AND state='start'");
        $c_ids=DB::table('challenge')->pluck('id');
        for ($i=0;$i<count($c_ids);$i++) {
            $score_board_list = DB::select("SELECT id,vote_count,FIND_IN_SET( vote_count, (
                    SELECT GROUP_CONCAT( vote_count
                    ORDER BY vote_count DESC, `c-id` DESC ) 
                    FROM ujoinc WHERE `c-id`=".$c_ids[$i].")
                    ) AS rank
                    FROM ujoinc WHERE `c-id`=".$c_ids[$i]);
            foreach ($score_board_list as $entry) {
                $array = json_decode(json_encode($entry), True);
                DB::statement("UPDATE ujoinc SET rank=" . $array['rank'] . " WHERE id=" . $array['id']);
                // execute $query ...
            }
        }
        DB::table('userpix')->where('Points','<',1000)->update(['rank'=>'1']);
        DB::table('userpix')->where('Points','>',1000)->update(['rank'=>'2']);
        DB::table('userpix')->where('Points','>',2000)->update(['rank'=>'3']);
        DB::table('userpix')->where('Points','>',4000)->update(['rank'=>'4']);
        DB::table('userpix')->where('Points','>',9000)->update(['rank'=>'5']);
        DB::table('userpix')->where('Points','>',15000)->update(['rank'=>'6']);
        DB::table('userpix')->where('Points','>',25000)->update(['rank'=>'7']);
        DB::table('userpix')->where('Points','>',50000)->update(['rank'=>'8']);
        DB::table('userpix')->where('Points','>',1250000)->update(['rank'=>'9']);
        
   
   
   
   //--------------add_challenge-------------------//
        $completed_cid=DB::table('challenge')->where('state','completed')->pluck('id');
        
        if(count($completed_cid)>0){

        $completed_prize=DB::table('challenge')->where('state','completed')->pluck('prize');
        $completed_price=DB::table('challenge')->where('state','completed')->pluck('price');
        for ($i=0;$i<count($completed_cid);$i++)
        {
            $prize = explode(',',$completed_prize[$i]);
            $price=floatval(rtrim($completed_price[$i], "$"));
            $userpix_id=DB::table('ujoinc')->where([['c-id',$completed_cid[$i]],['rank','1'],])->pluck('u-id');

            for($ii=0;$ii<count($userpix_id);$ii++){
                $userpix=DB::table('userpix')->where('u-id',$userpix_id[$ii])->get();

                    foreach($userpix as $userpixs)
                    {
                     $Flip0=$userpixs->Flip;
                     $Charge0=$userpixs->Charge;
                     $Wand0=$userpixs->Wand;
                     $walet0=$userpixs->walet;
                    }
                    $Flip=0;$Charge=0;$wand=0;$walet=0;   
                    $Flip=$Flip0+$prize[0];
                    $Charge=$Charge0+$prize[1];
                    $Wand=$Wand0+$prize[2];
                    $walet=$walet0+$price;
                    DB::table('userpix')
                        ->where('u-id', $userpix_id[$ii])
                        ->update([
                            'Flip' => $Flip,
                            'Charge' => $Charge,
                            'Wand'=>$Wand,
                            'walet'=>$walet
                    ]);
                    
            
                    DB::table('challenge')
                         ->where('state', 'completed')
                         ->update([
                         'state' => 'ended'
                    ]);
 
                }

            }
        }  
        
        
        

//--------------add_challenge_end-------------------//

    }
    public function account_setting()
    {
        $uid=$_COOKIE['id'];
        $balence=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
        return view('balanceoverview',compact('balence'));
    }  
    public function my_profile()
    {
       
        $uid=$_COOKIE['id'];
        $u_profile=DB::table('users')->where('no',$uid)->pluck('profile_image')[0];
        $u_name=DB::table('users')->where('no',$uid)->pluck('name')[0];
        $u_age=DB::table('users')->where('no',$uid)->pluck('age')[0];        
        $u_email=DB::table('users')->where('no',$uid)->pluck('email')[0];
        $u_date=DB::table('users')->where('no',$uid)->pluck('register_date')[0];
        $u_wallet=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
        $u_Flip=DB::table('userpix')->where('u-id',$uid)->pluck('Flip')[0];
        $u_Charge=DB::table('userpix')->where('u-id',$uid)->pluck('Charge')[0];
        $u_Wand=DB::table('userpix')->where('u-id',$uid)->pluck('Wand')[0];
        return view('myprofile',compact('u_name','u_email','u_date','u_wallet','u_Flip','u_Charge','u_Wand','u_profile','u_age'));
    }
    public function withraw_paypal()
    {
        $uid=$_COOKIE['id'];

        $balence=DB::table('withdraw')->where('user_id',$uid)->orderBy('id','DESC')->pluck('after')[0];
        // $balence=$balences['after'];
        return view('withdraw_paypal',compact('balence'));
    }
    // public function withraw_request()
    // {
    //     $uid=$_COOKIE['id'];
    //     $balence=DB::table('withdraw')->where('user_id',$uid)->orderBy('id','DESC')->pluck('after')[0];
    //     return view('withdraw_paypal',compact('balence'));
    // }    
    
    public function show($id)
    {
        $user = DB::table('users')->where('no', '1')->first();
        return view('user.profile',['data'=> $user]);
    }
    public function response($state, $message, $data){
        $senddate['state']=$state;
        $senddate['message']=$message;
        $senddate['data']=$data;
        print_r(json_encode($senddate));
    }
    public function usersignup(){
        $data=Input::all();
        $email=$data['email'];
        $age=$data['age'];
        $user = DB::table('users')->where([['email', $email],['vc','true']])->first();

        //$this->response(200,'test',$user);
        if($user || $age<18){
            $this->response(200,"Invalid email or password",NULL);
        }
        else{
            $vc=DB::table('users')->where('email',$email)->value('vc');
            if($vc==$data['vc']){
                DB::table('users')
                    ->where('email',$email )
                    ->update(['vc' =>'true' ]);

                //$this->sendemail($email,$vc);
                //Mail::to('jackfrank613@gmail.com')->send(new TestEmail($data,"Hi! this is Verification Code."));
            //     $uid=DB::table('users')->where('email',$email)->pluck('no');
            //     $inserarr=[
            //         'u-id'=>$uid[0],
            //   ];
            //     DB::table('userpix')->insert($inserarr);
                $this->response(1,"Success Sign up",$uid);
            }
            else{
                Mail::to($email)->send(new TestEmail($vc,"Hi! this is Verification Code."));
                $this->response(200,"Invalid verification code!",$email);
            }

        }
    }
    public function usersignin(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $email=$data['email'];
        $password=$data['password'];
        $user = DB::table('users')->where([['email', $email],['password',md5($password)],['vc','true']])->first();
        //$this->response(200,'test',$user);
        if($user){
            Session::put($email, md5($email));
            Session::put('login_flag','login');
            $this->response(1,'Success Login',$user);
        }
        else{
            $this->response(200,"Invalid email or password",NULL);
        }
    }
    public function logincheck(){
        $data=Input::all();
        $email=$data['email'];
        if (Session::get($email)==md5($email)){
            $this->response(1,'already login','');
            //return redirect('test1');
            //return view('welcome');
        }else{
            $this->response(200,'sign please','test1');
            //return redirect('landing');
        }

    }
    public function sendvc(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $email=$data['email'];
        $name=$data['name'];
        $age=$data['age'];
        $password=$data['password'];
        $mobile_number=$data['mobile_number'];
        //$vc=$data['vc'];
        $user = DB::table('users')->where([['email', $email],['vc','true']])->first();

        //$this->response(200,'test',$user);
        if($user){
            $this->response(200,'Email in use',NULL);
        }
        elseif($age<18){
            $this->response(202,'The age must be more than 18',NULL);
        }
        else{
            $user1 = DB::table('users')->where('email', $email)->first();
            $vc='true'/*rand(100000,999999)*/;
            if ($user1){
                DB::table('users')
                    ->where('email',$email )
                    ->update(['vc' =>$vc ]);
                //$this->sendemail($email,$vc);
                //Mail::to($email)->send(new TestEmail($vc,"Hi! this is Verification Code."));

                $this->response(1,"Sent VC to email again",NULL);
            }
            else{
                $inserarr=[
                    'name'=>$name,
                    'age'=>$age,
                    'email'=>$email,
                    'password'=>md5($password),
                    'mobilenum'=>$mobile_number,
                    'vc'=>$vc
                ];
                DB::table('users')->insert($inserarr);
                $uid=DB::table('users')->where('email',$email)->pluck('no');
                $inserarr=[
                    'u-id'=>$uid[0]
                ];
                DB::table('userpix')->insert($inserarr);
                DB::table('userpix')->where('u-id',$uid[0])->update([
                    'Flip'=>5,
                    'Charge'=>5,
                    'Wand'=>5
                    ]);
                
//--------------------add_invite_walet-----------------------//
                $invite_user_id=DB::table('invite')->where('friend_email',$email)->pluck('user_id');
                if(count($invite_user_id)>0)
                {
                    for($i=0;$i<count($invite_user_id);$i++)
                    {
                         DB::table('invite')
                          ->where('user_id',$invite_user_id[$i])
                          ->update(['state' => 'join']);                
        
                        $invite_user_walets=DB::table('userpix')->where('u-id',$invite_user_id[$i])->get();
                        foreach($invite_user_walets as $invite_user_walet)
                        {
                             $walet0=$invite_user_walet->walet;
                        }
                        
                        $walet=$walet0+0.05;
                        DB::table('userpix')
                            ->where('u-id',$invite_user_id[$i])
                            ->update(['walet'=>$walet]);
        
                        $user2_email=DB::table('users')->where('no',$invite_user_id[$i])->pluck('email');
                        $user2_check=DB::table('invite')->where('friend_email',$user2_email)->pluck('user_id');
                        if(count($user2_check)>0)
                        {
                        $invite_user_walets=DB::table('userpix')->where('u-id',$user2_check)->get();
                        foreach($invite_user_walets as $invite_user_walet)
                        {
                             $walet0=$invite_user_walet->walet;
                        }
                        
                        $walet=$walet0+0.02;
                        DB::table('userpix')
                            ->where('u-id',$user2_check)
                            ->update(['walet'=>$walet]);                    
                        }
                    }
                }

//-------------------------- add_invite_end-----------------------------------//

                $this->response(1,"Success Sign up",$uid);
                //Mail::to($email)->send(new TestEmail($vc,"Hi! this is Verification Code."));
                // $this->response(1,/*"Sent VC to email"*/'Success sign up',NULL);
            }
        }
    }
    public function OpenChallenges()
    {
        if (Session::get('login_flag')!='login') return redirect('landing');
        $uid=$_COOKIE['id'];
        $joinc=DB::table('ujoinc')
            ->where('u-id',$uid)
            ->select('c-id')
            ->pluck('c-id');
        $challenge = DB::table('challenge')
            ->whereNotIn('id',$joinc)
            ->where('state','start')
            ->join('users','users.no','challenge.u-id')
            ->get();
        return view('challenges.open',['data'=> $challenge]);
    }
    public function ClosedChallenges(){
        if (Session::get('login_flag')!='login') return redirect('landing');
        $uid=$_COOKIE['id'];
        $joinc=DB::table('ujoinc')
            ->where('u-id',$uid)
            ->select('c-id')
            ->pluck('c-id');
        $challenge = DB::table('challenge')
            ->whereIn('id',$joinc)
            ->where('state','closed')
            ->join('users','users.no','challenge.u-id')
            ->get();
        return view('challenges.closed',['data'=> $challenge]);
    }
    public function MyChallenges()
    {
        if (Session::get('login_flag')!='login') return redirect('landing');
        $uid=$_COOKIE['id'];
        $joinc=DB::table('ujoinc')->where('u-id',$uid)->select('c-id')->pluck('c-id');
        $challenge = DB::table('challenge')->whereIn('id',$joinc)
            ->where('state','start')->join('users','users.no','challenge.u-id')->get();
        $userpix=DB::table('userpix')->where('u-id',$uid)->first();
        return view('challenges.mychallenges',['data'=> $challenge,'userpix'=>$userpix]);
    }
    public function passChallenges(){
        if (Session::get('login_flag')!='login') return redirect('landing');
        $uid=$_COOKIE['id'];
        $joinc=DB::table('ujoinc')->where('u-id',$uid)->select('c-id')->pluck('c-id');
        $challenge = DB::table('challenge')->whereIn('id',$joinc)
            ->where('state','ended')->join('users','users.no','challenge.u-id')->get();
        $userpix=DB::table('userpix')->where('u-id',$uid)->first();
        return view('challenges.passchallenges',['data'=> $challenge,'userpix'=>$userpix]);
    }
    public function challengeDetail($cid){
        $challenge=DB::table('challenge')
            ->join('users',function ($join){
                $join->on('users.no','challenge.u-id');
            })
            ->where('id',$cid)->first();
        $images=DB::table('image')
            ->join('users',function ($join){
                $join->on('users.no','image.u-id');
            })
            ->where('c-id',$cid)->get();
        return view('challenges.challenge_rank',['data'=> $challenge,'images'=>$images]);
    }
    public function challengeResult($cid){
        $challenge=DB::table('challenge')
            ->join('users',function ($join){
                $join->on('users.no','challenge.u-id');
            })
            ->where('id',$cid)->first();
        $rank=DB::table('ujoinc')
            ->join('users',function ($join){
                $join->on('users.no','ujoinc.u-id');
            })
            ->where('ujoinc.c-id',$cid)
            ->orderBy('rank','asc')
            ->get();
        $uid=$_COOKIE['id'];
        $myrank=DB::table('ujoinc')
            ->join('users',function ($join){
                $join->on('users.no','ujoinc.u-id');
            })
            ->where([['ujoinc.c-id',$cid],['ujoinc.u-id',$uid]])
            ->first();

        return view('challenges.ended_challenge',['data'=> $challenge,'rank'=>$rank,'myrank'=>$myrank]);
    }
    public function invitedChallenge($cid){
        $challenge=DB::table('challenge')
            ->join('users',function ($join){
                $join->on('users.no','challenge.u-id');
            })
            ->where('id',$cid)->first();
        $images=DB::table('image')
            ->join('users',function ($join){
                $join->on('users.no','image.u-id');
            })
            ->where('c-id',$cid)->get();
        return view('challenges.invitedchallenge',['data'=> $challenge,'images'=>$images]);
    }
    public function ChallengeJoin(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $userid=$data['userid'];
        $cid=$data['cid'];
        $inserarr=[
            'u-id'=>$userid,
            'c-id'=>$cid

        ];
        DB::table('ujoinc')->insert($inserarr);
        $this->response(1,'Success Join',NULL);

    }

    public function getExposure(){
        //validate the info, create rules for the inputs
        $date=Carbon::now();


        $data=Input::all();
        $userid=$data['uid'];
        $cid=$data['cid'];
        $arryUser=DB::table('ujoinc')->where([['c-id',$cid],['u-id',$userid]])->pluck('datetime');
        $index=$arryUser[0];
        $exposure=$index/86400*15;
        $senddate['cid']=$cid;
        $senddate['exposure']=(int)$exposure;
        $this->response(1,'Success',$senddate);

    }
    public function Charge(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $userid=$_COOKIE['id'];
        $uid=$_COOKIE['id'];
        $currentcharge=DB::table('userpix')->where('u-id',$uid)->pluck('Charge')->toArray();

        if (intval($currentcharge[0])<=0) {
            $this->response(200,"Can't Charge. Please buy Charge",$currentcharge);
        }
        else{
            DB::table('userpix')->where('u-id',$uid)
                ->decrement('Charge',1);
            $cid=$data['cid'];
            $result=DB::table('ujoinc')
                ->where([['c-id',$cid],['u-id',$userid]])
                ->update(['exposure'=>Carbon::now(),'exposurestate'=>'1','datetime'=>'86400']);
            $this->response(1,'Success Charge',$result);

        }

    }
    public function setBoost(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $uid=$_COOKIE['id'];
        $currentwand=DB::table('userpix')->where('u-id',$uid)->pluck('Wand')->toArray();
        if (intval($currentwand[0])<=0) {
            $this->response(200,"Can't Boost. Pleas buy Wand",$currentwand);
        }
        else{
            DB::table('userpix')->where('u-id',$uid)
                ->decrement('Wand',1);
            $iid=$data['iid'];
            DB::table('image')
                ->where('id',$iid)
                ->update(['boostdate'=>Carbon::now(),'booststate'=>1,'boosttime'=>7200]);
            $this->response(1,'Success Boost',$iid);

        }

    }
    public function MyChallenges1(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $userid=$data['userid'];
        $challenges = DB::table('challenge')->where('u-ids','like', $userid)->get();
        $this->response(1,'Success',$challenges);
    }
    public function ImageUpload(){
        $data=Input::all();
        $iid=$data['iid'];
        $uid=$data['uid'];
        $cid = $data['cid'];
        $destinationPath = 'uploads/images';
        $file = $data['image'];

        if ($iid==0){
            $inserarr=[
                'c-id'=>$cid,
                'u-id'=>$uid
            ];
            $id=DB::table('image')->insertGetId($inserarr);
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            //------------------------
            $imgname=$file->getClientOriginalName();
            $exten=".".$ext;
            $imgname=trim($imgname,$exten);            
            //------------------------
            $imagename=md5($iid.$file->getClientOriginalName()).$id.'.'.$ext;
            $file->move('public/'.$destinationPath,$imagename);
            $imageurl=asset($destinationPath.'/'.$imagename);
            
            //-------------imgname_update-------------------//
            
               DB::table('image')
                   ->where('id',$id)
                  ->update(['imgname' => $imgname]);
                
            //---------------imgname_update_end------------//        
            DB::table('image')
                ->where('id',$id )
                ->update(['url' => $imageurl]);

            $senddata['id']=$id;
            $senddata['url']=$imageurl;
            $this->response(1,"Success add",$senddata);
        }else{
            $currentflip=DB::table('userpix')->where('u-id',$uid)->pluck('Flip')->toArray();
            if (intval($currentflip[0])<=0) {
                $this->response(200,"Can't Upload or Swap. Please buy Flip",$currentflip);
            }
            else{
                //File::delete($filename);
                $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            //---------------    
            $imgname=$file->getClientOriginalName();
            $exten=".".$ext;
            $imgname=trim($imgname,$exten);            
            //------------------    
                $imagename=md5($iid.$file->getClientOriginalName()).$iid.'.'.$ext;
                $file->move('public/'.$destinationPath,$imagename);
                $imageurl=asset($destinationPath.'/'.$imagename);
                $d_filename=DB::table('image')
                    ->where('id',$iid )->pluck('url')[0];
                //File::delete($d_filename);
            //-------------imgname_update-------------------//
            
              DB::table('image')
                  ->where('id',$iid)
                  ->update(['imgname' => $imgname]);
                
            //---------------imgname_update_end------------//   
                DB::table('image')
                    ->where('id',$iid )
                    ->update(['url' => $imageurl]);
                $dec=DB::table('userpix')->where('u-id',$uid)
                    ->decrement('Flip',1);
                $senddata['url']=$imageurl;
                $senddata['dec']=$dec;

                $this->response(2,"Success swap",$senddata);
            }
        }
    }


    public function ImageSubmit(){
        $data=Input::all();
        $iid=(int)$data['iid'];
        $uid=$data['uid'];
        $cid = $data['cid'];
        $destinationPath = 'uploads/images';
        $file = $data['image'];

        if ($iid==0){
            $inserarr=[
                'c-id'=>$cid,
                'u-id'=>$uid
            ];
            $id=DB::table('image')->insertGetId($inserarr);
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            //----------------imgname----------------
            $imgname=$file->getClientOriginalName();
                        $imgname=$file->getClientOriginalName();
            $exten=".".$ext;
            $imgname=trim($imgname,$exten);
            DB::table('image')
                ->where('id',$id )
                ->update(['imgname' => $imgname]);
            
            //-------------------end--------------------
            $imagename=md5($iid.$file->getClientOriginalName()).$id.'.'.$ext;
            $file->move('public/'.$destinationPath,$imagename);
            $imageurl=asset($destinationPath.'/'.$imagename);
            DB::table('image')
                ->where('id',$id )
                ->update(['url' => $imageurl]);

            $senddata['id']=$id;
            $senddata['url']=$imageurl;
            $this->response(1,"Success add",$senddata);
        }else{
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            //----------------imgname----------------
            $imgname=$file->getClientOriginalName();
            $exten=".".$ext;
            $imgname=trim($imgname,$exten);
            DB::table('image')
                ->where('id',$iid )
                ->update(['imgname' => $imgname]);
            
            //-------------------end--------------------

            $imagename=md5($iid.$file->getClientOriginalName()).$iid.'.'.$ext;
            $file->move('public/'.$destinationPath,$imagename);
            $imageurl=asset($destinationPath.'/'.$imagename);
            DB::table('image')
                ->where('id',$iid )
                ->update(['url' => $imageurl]);
            $dec=DB::table('userpix')->where('u-id',$uid)
                ->decrement('Flip',1);
            $senddata['url']=$imageurl;
            $senddata['dec']=$dec;

            $this->response(2,"Success swap",$senddata);
        }

// $htmlContent = str_replace('balloontip.css', 'https://www.pcpao.org/balloontip.css', $htmlContent); 
    }
    public function getImage(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $uid=$data['uid'];
        $cid=$data['cid'];
        $image = DB::table('image')->where([['u-id', $uid],['c-id',$cid]])->get();
        $this->response(1,'Success',$image);
    }
    public function getPix(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $type=$data['type'];
        $amount=$data['amount'];
        $uid=$data['uid'];
        switch ($type){
            case 1:
                $walet=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
                if($amount==1){$walet=$walet-0.49;}
                elseif($amount==5){$walet=$walet-1.99;}
                elseif($amount==10){$walet=$walet-3.49;}
                elseif($amount==25){$walet=$walet-7.5;}
                DB::table('userpix')
                ->where('u-id',$uid)
                ->update(['walet'=>$walet]);

                DB::table('userpix')
                    ->where('u-id',$uid )
                    ->increment('Flip',$amount);
                $userpix=DB::table('userpix')->where('u-id',$uid)->first();
                $this->response(1,'Success',$userpix);
                break;
            case 2:
                $walet=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
                if($amount==1){$walet=$walet-0.49;}
                elseif($amount==5){$walet=$walet-1.99;}
                elseif($amount==10){$walet=$walet-3.49;}
                elseif($amount==25){$walet=$walet-7.5;}
                DB::table('userpix')
                ->where('u-id',$uid)
                ->update(['walet'=>$walet]);                
                
                
                DB::table('userpix')
                    ->where('u-id',$uid )
                    ->increment('Charge',$amount);
                $userpix=DB::table('userpix')->where('u-id',$uid)->first();
                $this->response(1,'Success',$userpix);
                break;
            case 3:
                $walet=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
                if($amount==1){$walet=$walet-0.59;}
                elseif($amount==5){$walet=$walet-2.75;}
                elseif($amount==10){$walet=$walet-5;}
                elseif($amount==25){$walet=$walet-11.25;}
                DB::table('userpix')
                ->where('u-id',$uid)
                ->update(['walet'=>$walet]);                
                
                
                DB::table('userpix')
                    ->where('u-id',$uid )
                    ->increment('Wand',$amount);
                $userpix=DB::table('userpix')->where('u-id',$uid)->first();
                $this->response(1,'Success',$userpix);
                break;
            default:
                $this->response(200,'Unknown Pix Type',NULL);
                break;
        }


    }
    public function setVote($cid){
        if (Session::get('login_flag')!='login') return redirect('landing');
        $uid=$_COOKIE['id'];
        //echo $cid;
        $iid=DB::table('vote')->where('u-id',$uid)->pluck('i-id');


        $image=DB::table('image')->select('image.*')
            ->join('ujoinc',function ($join){
                $join->on('image.c-id','ujoinc.c-id');
                $join->on('image.u-id','ujoinc.u-id');

            })
            ->where([['image.u-id','<>',$uid],['image.c-id',$cid]])
            ->whereNotIn('image.id',$iid)
            ->orderBy('image.boosttime','dec')
            ->orderBy('ujoinc.datetime','dec')
            ->inRandomOrder()
            ->get();
        return view('challenges.voting',['data'=> $image]);
    }
    public function addVoting(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $uid=$data['uid'];
        $cid=$data['cid'];

        if( isset( $data['likearry'] ) ){
            // do something
            $likearry=$data['likearry'];
            for ($i=0;$i<count($likearry);$i++){
                $inserarr=[
                    'u-id'=>$uid,
                    'i-id'=>$likearry[$i]
                ];
                DB::table('like')->insert($inserarr);
                DB::table('image')
                    ->where('id',$likearry[$i] )
                    ->increment('like',1);
            }

        }
        if( isset( $data['votearry'] ) ){
            // do something
            $votearry=$data['votearry'];
            for ($i=0;$i<count($votearry);$i++){

                $inserarr=[
                    'u-id'=>$uid,
                    'i-id'=>$votearry[$i]
                ];
                DB::table('vote')->insert($inserarr);
                DB::table('image')
                    ->where('id',$votearry[$i] )
                    ->increment('vote',1);

                $userid=DB::table('image')->where('id',$votearry[$i])
                    ->pluck('u-id')->toArray()[0];
                DB::table('ujoinc')->where([['u-id','=',$userid],['c-id',$cid]])->increment('vote_count',1);
                DB::table('challenge')->where('id',$cid)->increment('votes',1);

                DB::table('userpix')
                    ->join('image','userpix.u-id','image.u-id')
                    ->where('image.id','=',$votearry[$i])->increment('Points',1);
            }
            DB::table('ujoinc')->where('u-id','=',$uid)->increment('datetime',100);



        }
        $this->response(1,'Success',$uid);
        //$image = DB::table('image')->where([['u-id', $uid],['c-id',$cid]])->get();

    }
    public function Invite(){
        //validate the info, create rules for the inputs
        $date=Carbon::now();
        $data=Input::all();
        $f_email=$data['f_email'];
        $uid=$_COOKIE['id'];
        Mail::to($f_email)->send(new InviteEmail('',"Hi! You have been invited to the site from your friend."));
        $temp=DB::table('invite')->where([['user_id',$uid],['friend_email',$f_email]])->get();
        if (count($temp)==0) {
            $inserarr = [
                'user_id' => $uid,
                'friend_email' => $f_email,
                'datetime' => $date
            ];
            DB::table('invite')->insert($inserarr);
        }
        $this->response(1,'Success Invite',$temp);
    }


    public function getListInvite(){
        //validate the info, create rules for the inputs
        if (Session::get('login_flag')!='login') return redirect('/challenges/my');
        $uid=$_COOKIE['id'];
        $data=DB::table('invite')
            ->where('user_id',$uid)
            ->get();
        return view('friend_invite_page',['data'=> $data]);
    }
    public function challengInvite($cid){
        //validate the info, create rules for the inputs
        $challenge=DB::table('challenge')
            ->join('users',function ($join){
                $join->on('users.no','challenge.u-id');
            })
            ->where('id',$cid)->first();
        if (Session::get('login_flag')!='login') return redirect('/challenges/my');
        $uid=$_COOKIE['id'];
        $data=DB::table('invite_challenge')
            ->where('user_id',$uid)
            ->get();
        return view('invite_challenge',['data'=> $data,'challenge'=>$challenge]);
    }
    public function addChallengeInvite(){
        $date=Carbon::now();
        $data=Input::all();
        $f_email=$data['f_email'];
        $c_id=$data['cid'];
        $uid=$_COOKIE['id'];
        Mail::to($f_email)->send(new InviteEmail('',"Hi! You have been invited to the site from your friend."));
        $temp=DB::table('invite_challenge')->where([['user_id',$uid],['friend_email',$f_email],['c_id',$c_id]])->get();
        if (count($temp)==0) {
            $inserarr = [
                'user_id' => $uid,
                'friend_email' => $f_email,
                'datetime' => $date,
                'c_id'=>$c_id
            ];
            $id=DB::table('invite_challenge')->insertGetId($inserarr);
            $u_name=DB::table('users')->where('no',$uid)->pluck('name')[0];
            $inserarr = [
                'u_email' => $f_email,
                't_id' => (int)$id,
                'n_type'=>'invite_challenge',
                'n_date'=>$date,
                'state'=>'new',
                'msg'=>$u_name.' invited you to join the '.$c_id
            ];
            DB::table('note')->insert($inserarr);

        }

        $this->response(1,'Success Invite',$temp);
    }
    public function ivtChallengeJoin(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $uid=$_COOKIE['id'];
        $u_email=DB::table('users')->where('no',$uid)->pluck('email')[0];
        $cid=$data['cid'];
        $inserarr=[
            'u-id'=>$uid,
            'c-id'=>$cid
        ];
        DB::table('ujoinc')->insert($inserarr);
        DB::table('invite_challenge')
            ->where([['friend_email',$u_email],['c_id',$cid]])
            ->update(['state'=>'join']);
        $tid=DB::table('invite_challenge')
            ->where([['friend_email',$u_email],['c_id',$cid]])
            ->pluck('id')[0];
        DB::table('note')
            ->where([['u_email',$u_email],['t_id',$tid],['n_type','invite_challenge']])
            ->delete();
        $f_email=DB::table('invite_challenge')
            ->where([['friend_email',$u_email],['c_id',$cid]])
            ->join('users','users.no','invite_challenge.user_id')
            ->pluck('email')[0];
        
//------------------------invite_challenge_add--------------------------------//
        $user_f_id=DB::table('users')->where('email',$f_email)->pluck('no');
        $user_f_walets=DB::table('userpix')->where('u-id',$user_f_id)->get();
        foreach($user_f_walets as $user_f_walet)
        {
             $walet0=$user_f_walet->walet;
        }
        
        $walet=$walet0+0.02;
        DB::table('userpix')
            ->where('u-id', $user_f_id)
            ->update(['walet'=>$walet]);

        $user2_f_id=DB::table('invite_challenge')->where('friend_email',$f_email)->pluck('user_id');
        
        if(count($user2_f_id)>0){
            
            $user2_f_walets=DB::table('userpix')->where('u-id',$user2_f_id)->get();        
            foreach($user2_f_walets as $user2_f_walet)
            {
                 $walet2=$user2_f_walet->walet;
            }
            $walet=$walet2+0.01;
            DB::table('userpix')
                ->where('u-id', $user2_f_id)
                ->update(['walet'=>$walet]);

        }
 //------------------------invite_challenge_end-------------------------------//                   
        $date=Carbon::now();
        $ctitle=DB::table('challenge')->where('id',$cid)->pluck('title')[0];
        $inserarr = [
            'u_email' => $f_email,
            't_id' => '0',
            'n_type'=>'show',
            'n_date'=>$date,
            'state'=>'new',
            'msg'=>$f_email.' join to'.$ctitle
        ];
        DB::table('note')->insert($inserarr);
        $this->response(1,'Success Join',$tid);

    }
    
    public function getInvite(){
        $data=Input::all();
        $email=$data['email'];
        $uid=DB::table('users')->where('email',$email)
        ->pluck('no')[0];
        if(!empty($uid)){
            $senddata=DB::table('invite')
                ->where('user_id',$uid)
                ->get();
            $this->response(1,'Success',$senddata);
        }
        else{
            $this->response(1,'There is any friend invited',$email);
        }
    }
    public function getCInvite(){
        $data=Input::all();
        $email=$data['email'];
        $uid=DB::table('users')->where('email',$email)
            ->pluck('no')[0];
        if(!empty($uid)){
            $senddata=DB::table('invite_friend')
                ->where('user_id',$uid)
                ->get();
            $this->response(1,'Success',$senddata);
        }
        else{
            $this->response(1,'There is any friend invited',$email);
        }
    }
    public function getNotification(){
        $uid=$_COOKIE['id'];
        $u_email=DB::table('users')->where('no',$uid)->pluck('email')[0];
        $notification=DB::table('note')->where('u_email',$u_email)->get();
        if (!empty($notification)){
            $this->response(1,'Success Get Note Data',$notification);
        }

        else{
            $this->response(200,'Success NULL',NULL);
        }
    }
//-------------------------initial_page--------------------------//  
    public function init_shoppage()
    {
       if (Session::get('login_flag')!='login') return redirect('landing'); 
 //           $images=DB::table('image')->get();
            $images=DB::table('image')->get();
            $imgcount=count($images);
            if($imgcount%12==0)
            {
                $page_number=$imgcount/12;
            }
            else
            {
                $x=$imgcount%12;
                $page_number=($imgcount-$x)/12+1;
            }            
            $total_search=$imgcount;
            if(count($images)<13)
            {
                $imgurl=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('url');
                $imgname=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('imgname');
                $imgid=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('id');                
                $count2=count($imgurl)-1;$count1=0;
            }
            else
            {
                $imgurl=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('url');
                $imgname=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('imgname');
                $imgid=DB::table('image')->where('state',NULL)->orderby('vote','desc')->pluck('id');                
                $count2=11;$count1=0;
            }
        return view('shop/shop',compact('imgurl','count1','count2','imgname','page_number','imgid','imgurl1'));     
    }   
      
//-----------------------------add_shop_get----------------------------------//
    public function shopimage()
    {
        if (Session::get('login_flag')!='login') return redirect('landing');
        
        $data=input::all();
        $keyword=$data['keyword'];
        $option=$data['option'];
        $btn_num=$data['page'];
        
        $group_number=0;
        if($option=="Sort by popularity"){
            $imgs=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('vote','desc')
            ->pluck('url');
            $imgnames=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('vote','desc')
            ->pluck('imgname');            
            $imgids=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('vote','desc')
            ->pluck('id');            
        }
        if($option=="Sort by average rating"){
            $imgs=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('like','desc')
            ->pluck('url');
            $imgnames=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('like','desc')
            ->pluck('imgname');            
            $imgids=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('like','desc')
            ->pluck('id');            
        }
        if($option=="Sort by latest"){
            $imgs=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('boostdate','desc')
            ->pluck('url');
            $imgnames=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('boostdate','desc')
            ->pluck('imgname');            
            $imgids=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('boostdate','desc')
            ->pluck('id');            
        }
        if($option=="Sort by price:low to high"){
            $imgs=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','asc')
            ->pluck('url');
            $imgnames=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','asc')
            ->pluck('imgname');            
            $imgids=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','asc')
            ->pluck('id');            
        }
        if($option=="Sort by price:high to low"){
            $imgs=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','desc')
            ->pluck('url');
            $imgnames=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','desc')
            ->pluck('imgname');            
            $imgids=DB::table('image')->where([['imgname', 'LIKE', "%{$keyword}%"],['state',NULL]])
            ->orderBy('price','desc')
            ->pluck('id');                
          
        }
        $imgcount=count($imgs);
        if($imgcount%12==0)
        {
            $page_number=$imgcount/12;
        }
        else
        {
            $x=$imgcount%12;
            $page_number=($imgcount-$x)/12+1;
        }
        if($imgcount<13)
        {   
            $image=$imgs;
            $count1=0;$count2=$imgcount;
        }
        else
        {
            $image=$imgs;
            $count1=0;$count2=12;
        }

        if($btn_num!=1)
        {
            if($imgcount>($btn_num-1)*12)
            {
                $count1=12*($btn_num-1);
                if($btn_num*12<$imgcount+1)
                {
                    $count2=$btn_num*12;
                }
                else
                {
                    $count2=$imgcount;
                }
            }
      }
        $data1['imgurl']=$imgs;$data1['imgid']=$imgids;$data1['imgname']=$imgnames;$data1['count1']=$count1;$data1['count2']=$count2;$data1['page_number']=$page_number;$data1['total_search']=$imgcount;        
        $this->response(1,'success',$data1);
    }
 
//--------------------------------end-----------------------------------------// 
    public function add_cart()
    {
        $data=Input::all();
        $img_id=$data['img_id'];
        $flag=$data['flag'];
        $uid=$_COOKIE['id'];
        if($flag=="add")
        {
            $s=DB::table('cart')->where('img_id',$img_id)->get();
            if(count($s)==0){
            $inserarr=[
                'img_id'=>$img_id,
                'uid'=>$uid,
                'img_num'=>1,
            ];
            DB::table('cart')->insert($inserarr);
            DB::table('image')->where('id',$img_id)->update(['state'=>'carted']);
            }            
        }
        if($flag=="delete")
        {
            DB::table('cart')
                ->where('img_id',$img_id)
                ->delete();
            DB::table('image')->where('id',$img_id)->update(['state'=>NULL]);                
        }
        $this->response(1,'success',$data);
    } 
    
    
    
    public function cart()
    {
        $uid=$_COOKIE['id']; 
        $imgurl = DB::table('cart')
            ->where('uid',$uid)
            ->join('image','image.id','cart.img_id')
            ->pluck('url');
        $imgname = DB::table('cart')
            ->where('uid',$uid)
            ->join('image','image.id','cart.img_id')
            ->pluck('imgname');            
            
        $length=count($imgurl);
        if($length==0)
        {
            return redirect('shop/shop');
        }        
        $count1=0;$count2=$length;
        return view('shop/cart',compact('imgurl','imgname','count1','count2'));        
    }
    
    public function payment()
    {
         return view('shop/payment');
    }
    public function withdraw_request()
    {
        $uid=$_COOKIE['id']; 
        $data=Input::all();
        $amount=$data['amount'];
        $account=$data['account_info'];
        $description=$data['description'];
        $method='Paypal';
        $balence=DB::table('userpix')->where('u-id',$uid)->pluck('walet')[0];
        $request_balence=DB::table('withdraw')->where('user_id',$uid)->get();
        if(count($request_balence)>0){
            foreach($request_balence as $rows){
                $req=$rows->amount;
                $balence=$balence-$req;
            }
        }
        
        $username=DB::table('users')->where('no',$uid)->pluck('name')[0];
        $inserarr=[
            'user_id'=>$uid,
            'username'=>$username,
            'amount'=>$amount,
            'method'=>$method,
            'before'=>$balence,
            'after'=>$balence-$amount,
            'description'=>$description
        ];
        DB::table('withdraw')->insert($inserarr);
         $this->response(1,'success',$data);
         return redirect('/balanceoverview');
    }
    
    public function saveProfile(Request $request){
        $this->validate($request, [
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $uid=$_COOKIE['id'];
        if (Input::hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $profile_picture->move(public_path() . '/images/profile_pictures', $profile_picture->getClientOriginalName());
            $url =$profile_picture->getClientOriginalName();
            
            DB::table('users')
                 ->where('no', $uid)
                 ->update([
                 'profile_image' => $url
            ]);            
        }
        return back();
    }    
    
    public function processNotification(){
        $data=Input::all();
        $note=$data['note'];
        switch ($note['n_type']){
            case "invite_challenge":
                $cid=DB::table('invite_challenge')
                    ->where('id',$note['t_id'])
                    ->pluck('c_id')[0];
                $url=url('/challenges/invited/'.$cid);
                $this->response(1,'There is any friend invited',$url);
                break;
            case "userpix_show":
                DB::table('note')
                    ->where('n_id',$note['n_id'])
                    ->delete();
                $this->response(3,'Success',NULL);                
            case "show":
                DB::table('note')
                    ->where('n_id',$note['n_id'])
                    ->delete();
                $this->response(2,'Success',NULL);
            default:
                $this->response(200,'There is any friend invited',$note);
                break;
        }
//        $uid=DB::table('users')->where('email',$email)
//            ->pluck('no')[0];
//        if(!empty($uid)){
//            $senddata=DB::table('invite_friend')
//                ->where('user_id',$uid)
//                ->get();
//            $this->response(1,'Success',$senddata);
//        }
//        else{
//            $this->response(1,'There is any friend invited',$email);
//        }
    
    }
    
    
    
    //   public function userimg_upload(){
           
    //   }
}
