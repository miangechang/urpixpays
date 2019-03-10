<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\TestEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Upload;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */

    public function response($state, $message, $data){
        $senddate['state']=$state;
        $senddate['message']=$message;
        $senddate['data']=$data;
        print_r(json_encode($senddate));
    }
    public function user()
    {
      if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
      
      
          $user = DB::table('users')
            ->join('userpix', 'users.no', 'userpix.u-id')
            ->select('users.no', 'users.email', 'users.name', 'users.email', 'users.password', 'users.mobilenum', 'users.permission', 'users.vc', 'users.role',  'userpix.Flip', 'userpix.Charge', 'userpix.Wand', 'userpix.Rank', 'userpix.walet', 'userpix.Points')
            ->get();
     return view('Admin.user',['data'=> $user]);
        
        
    }
    
    public function user1()
    {
      if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
      
      
          $user = DB::table('users')
            ->join('userpix', 'users.no', 'userpix.u-id')
            ->select('users.no', 'users.email', 'users.name', 'users.email', 'users.password', 'users.mobilenum', 'users.permission', 'users.vc', 'users.role',  'userpix.Flip', 'userpix.Charge', 'userpix.Wand', 'userpix.Rank', 'userpix.walet', 'userpix.Points')
            ->get();
        return view('Admin.user1',['data'=> $user]);
    }
    public function admin()
    {
      if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $user = DB::table('admin')->get();
        return view('Admin.admin',['data'=> $user]);
    }    
    
    
    
//--------------------------u_join_c_add--------------------------------------// 
    public function u_join_c($cid)
    {
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $data0['title'] = DB::table('challenge')->where('id',$cid)->pluck('title')[0];
        $data0['description'] = DB::table('challenge')->where('id',$cid)->pluck('description')[0];
        $data0['uid'] = DB::table('challenge')->where('id',$cid)->pluck('u-id')[0];
        $data0['name'] = DB::table('users')->where('no',$data0['uid'])->pluck('name')[0];
        $data0['email'] = DB::table('users')->where('no',$data0['uid'])->pluck('email')[0];        
        $data0['cid']=$cid;
        $ujoincs=DB::table('ujoinc')->where('c-id',$cid)->join('users','users.no','ujoinc.u-id')->get();
        return view('Admin.c_u',compact('data0','ujoincs'));   

   }
        
//--------------------------------end----------------------------------------//

    public function challenge()
    {
        
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $challenge = DB::table('challenge')->get();
        return view('Admin.challenge',['data'=> $challenge]);
    }
    
    public function challenge1()
    {
        
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $challenge = DB::table('challenge')->get();
        return view('Admin.challenge1',['data'=> $challenge]);
    }    
    
    public function deposits()
    {
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $deposit=DB::table('deposit')->get();
        $num=count($deposit);
        return view('Admin.deposits',compact('deposit','num'));
    }
    
     public function withdrawrequest()
    {
       if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $withdraw=DB::table('withdraw')->get();
        $num=count($withdraw);
        return view('Admin.withdrawrequest',compact('withdraw','num'));
    }
    public function deposits1()
    {
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $deposit=DB::table('deposit')->get();
        $num=count($deposit);
        return view('Admin.deposits1',compact('deposit','num'));
    }
    
     public function withdrawrequest1()
    {
       if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $withdraw=DB::table('withdraw')->get();
        $num=count($withdraw);
        return view('Admin.withdrawrequest1',compact('withdraw','num'));
    }    
    public function getujoinc()
    {
        if (Session::get('login_flag')!='login') return redirect('landing');
        $challenge = DB::table('challenge')->get();
        return view('Admin.c_u',['data'=> $challenge]);
    }    
    // public function getujoinc()
    // {
    //     if (Session::get('login_flag')!='login') return redirect('landing');
    //       $data = DB::table('ujoinc')->get();
    //       return view('Admin.c_u',['data'=> $data]);
    // }
    public function image()
    {
        $image = DB::table('image')
            ->join('users','users.no','=','image.u-id')
            ->join('challenge','image.c-id','=','challenge.id')
            ->select('image.*','users.*','challenge.*')
            ->get();
        return view('Admin.image',['data'=> $image]);
    }
    public function commit()
    {
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $image = DB::table('commit')
            ->join('users','users.no','=','commit.u-id')
            ->join('image','image.id','=','commit.i-id')
            ->select('commit.*','users.*','image.*')
            ->get();
        return view('Admin.commit',['data'=> $image]);
    }
    public function challengeupload(){
        $data=Input::all();
        $title=$data['title'];
        $description=$data['description'];
        $photocount=$data['photocount'];
        $price=$data['price'];
        $type=$data['type'];
        $prize=$data['prize'];
        $file = $data['image'];
        $inserarr=[
            'title'=>$title,
            'description'=>$description,
            'photocount'=>$photocount,
            'type'=>$type,
            'price'=>$price,
            'u-id'=>$_COOKIE['id'],
            'prize'=>$prize

        ];
        $id=DB::table('challenge')->insertGetId($inserarr);
        $destinationPath = 'uploads/challengesimages';
        $imagename=$id.$file->getClientOriginalName();
        $file->move('public/'.$destinationPath,$imagename);
        $imageurl=asset($destinationPath.'/'.$imagename);
        DB::table('challenge')
            ->where('id',$id )
            ->update(['image-url' => $imageurl]);
        //return redirect('admin/challenge');            
       // $this->response(1,"success",$imageurl);
    }
    public function permission(){
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $data=Input::all();
        $cid=$data['cid'];
        $table=$data['table'];
        $value=$data['value'];
        if($value=='deleted'){
            $this->Imagedelete();
        }
        $date=Carbon::now();
        DB::table('challenge')
            ->where('id',$cid )
            ->update(['start-time' => $date,'state'=>$value]);
        $this->response(1,"success",NULL);
    }
    
    
    
        public function permission_user(){
        if (Session::get('admin_login_flag')!='admin_login') return redirect('/admin_login');
        $data=Input::all();
        $email=$data['email']; 
        $value=$data['value'];
      
      
        DB::table('users')
            ->where('email',$email )
            ->update(['permission'=>$value]);
        $this->response(1,"success",NULL);
    }
    //---------------------------image_delete-------------------------------//
        public function Imagedelete()
       {
        $data=input::all();
        $cid = $data['cid'];
        $d_filenames=DB::table('image')->where([['c-id',$cid],['vote','<',100],])->get();
        if(count($d_filenames)>0){
            $i=0;
            foreach($d_filenames as $d_filename){
                $url=$d_filename->url;
                $url1=trim($url,"http://urpixpays.com/publicsiti/");
                $url2=trim($url1,'e/');
                File::delete($url2);
                $i++;
            }
        }
        $check1=DB::table('image')->where('c-id',$cid )->get();
        if(count($check1)>0){
          DB::table('image')
            ->where('c-id',$cid )
            ->delete(); 
        }
        $check2=DB::table('challenge')->where('id',$cid )->get();
        if(count($check2)>0){    
          DB::table('challenge')
            ->where('id',$cid )
            ->delete();
        }        
        $check3=DB::table('invite_challenge')->where('c_id',$cid )->get();
        if(count($check3)>0){
            DB::table('invite_challenge')
            ->where('c-id',$cid )
            ->delete();
        }
        $check4=DB::table('ujoinc')->where('c-id',$cid )->get();
        if(count($check4)>0){
            DB::table('ujoinc')
            ->where('c-id',$cid )
            ->delete();
        }    
        $this->response(1,"Success deleted challenge!",$d_filenames);
    }
    public function showUploadFile( ) {
        $data=Input::all();
        echo var_dump($data);
        $file = $data['image'];
        $name=$data['name'];
//        $file = $request->file('image');
        echo $name;

        $destinationPath = 'uploads';
        $file->move($destinationPath,$name.$file->getClientOriginalName());
        $this->response(1,"Uploaded",$data);
        //echo 'asdf';
    }

    public function usersignin(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $email=$data['email'];
        $password=$data['password'];
        $user = DB::table('users')->where([['email', $email],['password',md5($password)]])->first();
        //$this->response(200,'test',$user);
        if($user){
            Session::put($email, md5($email));
            $this->response(1,'Success Login',md5($email));

        }
        else{
            $this->response(200,"Invalid email or password",NULL);
        }
    }
    
    
//----------------------------get_userpix-------------------------------------//           
    public function getUserpix(){
        $data=Input::all();
        $id=$data['uid'];
        $up_data=DB::table('userpix')->where('u-id',$id)->first();

        $this->response(1,'Success view',$up_data);
    }         
            
//-----------------------------------end--------------------------------------//

//-----------------------------get_ujoinc_data-------------------------------//
    // public function getujoinc(){
    //     $data=Input::all();
    //     $cid=$data['cid'];
    //     $ujoincs=DB::table('ujoinc')->where('c-id',$cid)->get();
    //     $title=DB::table('challenge')->where('id',$cid)->pluck('title')[0];
    //     $description=DB::table('challenge')->where('id',$cid)->pluck('description')[0];
    //     $ujoinc_data=array();
    //     for($i=0;$i<count($ujoincs);$i++)
    //     {
    //         $ujoinc_data[$i]['title']=$title;
    //         $ujoinc_data[$i]['description']=$description;
    //         foreach($ujoincs[$i] as $ujoinc)
    //         {
    //             $uid=$ujoinc->u-id;
    //             $email=DB::table('users')->where('uid',$uid)->pluck('email')[0];
    //             $name=DB::table('users')->where('uid',$uid)->pluck('name')[0];
    //             $ujoinc_data[$i]['email']=$email;
    //             $ujoinc_data[$i]['name']=$name;
    //             $ujoinc_data[$i]['u-id']=$uid;
    //             $ujoinc_data[$i]['c-id']=$ujoinc->c-id;
    //             $ujoinc_data[$i]['vote_count']=$ujoinc->vote_count;
    //             $ujoinc_data[$i]['rank']=$ujoinc->rank;
    //             $ujoinc_data[$i]['ujoinc_date']=$ujoinc->ujoinc_date;
    //             $ujoinc_data[$i]['exposure']=$ujoinc->exposure;
    //         }
    //     }
    //     $this->response(1,'Success view','');
    // }

//---------------------------------end----------------------------------------//
//----------------------------add_uerpix_update-------------------------------//
    public function updateuerpix()
    {
        $data=input::all();
        $uid=$data['uid'];
        $Flip=$data['Flip'];
        $Wand=$data['Wand'];
        $Charge=$data['Charge'];
        $walet=$data['walet'];
        $rank=$data['rank'];

        DB::table('userpix')
            ->where('u-id',$uid)
            ->update([
                'Flip' => $Flip,
                'Charge' => $Charge,
                'Wand' => $Wand,
                'walet' => $walet,
                'rank' => $rank
            ]);

        $u_email=DB::table('users')->where('no',$uid)->pluck('email')[0];
        $t_id=DB::table('userpix')->where('u-id',$uid)->pluck('no')[0];
        $date=Carbon::now();
        
        $inserarr = [
            'u_email' => $u_email,
            't_id' => $t_id,
            'n_type'=>'userpix_show',
            'n_date'=>$date,
            'state'=>'new',
            'msg'=>'Your walet is changed by admin.'
        ];
        DB::table('note')->insert($inserarr);  
        
        // return redirect('admin/user');

    // $this->response(1,'Success update',$data);        
    
    }

//----------------------------------end---------------------------------------//
    public function AdminRemark($id,$action){
      // if (Session::get('admin_login_flag')!='admin_login') return redirect('Admin/Auth/login');
       
       if($action=='success'){
          $userid=DB::table('withdraw')->where('id',$id)->pluck('user_id')[0];
          $amount=DB::table('withdraw')->where('id',$id)->pluck('amount')[0];
          $walet=DB::table('userpix')->where('u-id',$userid)->pluck('walet')[0];
          DB::table('userpix')
            ->where('u-id',$userid)
            ->update([
                'walet' => $walet-$amount
          ]);
          
          DB::table('withdraw')
            ->where('id',$id)
            ->update([
                'remark' => $action
          ]);
       } 
       elseif($action=='non process'){
          DB::table('withdraw')
            ->where('id',$id)
            ->update([
                'remark' => $action
          ]);           
       }
       elseif($action=='cancel'){
          DB::table('withdraw')
            ->where('id',$id)
            ->update([
                'remark' => $action
          ]);           
       }
       elseif($action=='delete'){
          DB::table('withdraw')
            ->where('id',$id )
            ->delete();            
       }

      return redirect('admin/withdrawrequest');
    }
    
    public function adminsignup(){
        $data=Input::all();
        $email=$data['email'];
        $name=$data['name'];
        $password=$data['password'];
        $phone=$data['phone']; 
        $admin=DB::table('admin')->where('email',$email)->first();
        if($admin){
            return redirect('admin_register');
        }
        else{
            $inserarr=[
                'name'=>$name,
                'email'=>$email,
                'password'=>md5($password),
                'phone_number'=>$phone
            ];
            DB::table('admin')->insert($inserarr); 
            // Session::put($email, md5($email));
            Session::put('admin_login_flag','admin_login');            
            return redirect('admin/user');
        }
    }
    public function adminlogin(){
        $data=Input::all();
        $email=$data['email'];
        $password=md5($data['password']);
        $validation=DB::table('admin')->where([['email',$email],['password',$password]])->first();
        if($validation){
            // Session::put($email, md5($email));
            Session::put('admin_login_flag','admin_login');
            $role=DB::table('admin')->where([['email',$email],['password',$password]])->pluck('role')[0];             
            if($role=='manager'){
                return redirect('admin/admin');
            }
            return redirect('admin/user');
        }
        else
        {
            return redirect('/admin_login');
        }
        
    }    
    
    
    public function sendvc(){
        //validate the info, create rules for the inputs
        $data=Input::all();
        $email=$data['email'];
        $name=$data['name'];
        $password=$data['password'];
        $mobile_number=$data['mobile_number'];
        //$vc=$data['vc'];
        $user = DB::table('users')->where([['email', $email],['vc','true']])->first();

        //$this->response(200,'test',$user);
        if($user){
            $this->response(200,'Email in use',NULL);
        }
        else{
            $user1 = DB::table('users')->where('email', $email)->first();
            $vc=rand(100000,999999);
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
                    'email'=>$email,
                    'password'=>md5($password),
                    'mobilenum'=>$mobile_number,
                    'vc'=>$vc
                ];
                DB::table('users')->insert($inserarr);
                //Mail::to($email)->send(new TestEmail($vc,"Hi! this is Verification Code."));
                $this->response(1,"Sent VC to email",NULL);
            }

        }
    }
}
