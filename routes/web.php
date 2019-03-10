<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
    if (Session::get('login_flag')=='login') return view('Admin.Layout.dashboard');
    
    else    return redirect('/challenges/my');
});

Route::get('/frontend',function(){
    return view('Admin.frontend.index');
});
Route::get('/signup', function () {
    return view('Modal/signup');
});
Route::get('/signin', function () {
    return view('Modal/signin');
});
Route::get('/logout',function(){
    Session::put('login_flag','false');
    Session::put('admin_login_flag','false');
    return redirect('landing');
});
Route::get('/cart', function () {
    return view('shop/cart');
});
Route::get('/payment', function () {
    return view('shop/payment');
});


Route::post('/saveProfile', array('uses' => 'UserController@saveProfile'));

Route::post('adminregister', array('uses' => 'AdminController@adminsignup'));
Route::post('adminlogin', array('uses' => 'AdminController@adminlogin'));

Route::post('register1', array('uses' => 'UserController@usersignup'));
Route::post('login1', array('uses' => 'UserController@usersignin'));
Route::post('logincheck', array('uses' => 'UserController@logincheck'));
Route::post('sendvc', array('uses' => 'UserController@sendvc'));
Route::post('user/challenges/join', array('uses' => 'UserController@ChallengeJoin'));
Route::post('image/upload', array('uses' => 'UserController@ImageUpload'));
Route::post('image/submit', array('uses' => 'UserController@ImageSubmit'));
Route::post('friend/invite', array('uses' => 'UserController@Invite'));
Route::post('challenge/invite', array('uses' => 'UserController@addChallengeInvite'));

Route::post('image/get', array('uses' => 'UserController@getImage'));
Route::post('userpix/get', array('uses' => 'UserController@getPix'));
Route::post('voting/set', array('uses' => 'UserController@addVoting'));
Route::post('challenges/charge', array('uses' => 'UserController@Charge'));
Route::post('exposure/get', array('uses' => 'UserController@getExposure'));
Route::post('Boost/set', array('uses' => 'UserController@setBoost'));
Route::post('getfriendlist', array('uses' => 'UserController@getInvite'));
Route::post('getfriendlist1', array('uses' => 'UserController@getCInvite'));
Route::post('view/userpix', array('uses' => 'UserController@getUserpix'));
Route::post('withdraw_request', array('uses' => 'UserController@withdraw_request'));

//---------------------------userpix_call------------------------------------//
Route::post('view/userpix', array('uses' => 'AdminController@getUserpix'));
Route::post('updateuserpix', array('uses' => 'AdminController@updateuerpix'));
Route::post('delete/images', array('uses' => 'UserController@Imagedelete'));


Route::post('shop/image', array('uses' => 'UserController@shopimage'));
Route::post('shop/cart', array('uses' => 'UserController@add_cart'));

Route::post('paypal', 'PaymentController@payWithpaypal');
Route::get('status/{amount}', 'PaymentController@getPaymentStatus');
//--------------------------------end----------------------------------------//

Route::post('getNotification', array('uses' => 'UserController@getNotification'));
Route::post('processNotification', array('uses' => 'UserController@processNotification'));
Route::post('invited_challenge_join', array('uses' => 'UserController@ivtChallengeJoin'));


Route::get('test1', 'TestController@setcookie');
Route::get('test2', 'TestController@getcookie');

Route::get('admin/user', 'AdminController@user');
Route::get('admin/admin', 'AdminController@admin');
Route::get('admin/user1', 'AdminController@user1');
Route::get('admin/c_u/{cid}', 'AdminController@u_join_c');
Route::get('admin/challenge', 'AdminController@challenge');
Route::get('admin/challenge1', 'AdminController@challenge1');
Route::get('admin/deposits', 'AdminController@deposits');
Route::get('admin/withdrawrequest', 'AdminController@withdrawrequest');
Route::get('admin/deposits1', 'AdminController@deposits1');
Route::get('admin/withdrawrequest1', 'AdminController@withdrawrequest1');
Route::get('admin/image', 'AdminController@image');
Route::get('admin/commit', 'AdminController@commit');

//--------------------------------shopimage----------------------------------//
//Route::get('/shop', 'AdminController@shopimage');
//---------------------------------end--------------------------------------//
//Route::get('login', 'UserController@usersignin');
Route::post('/challenge/upload', array('uses' => 'AdminController@challengeupload'));
Route::post('/user/permission', array('uses' =>'AdminController@permission_user'));
Route::post('/challenge/permission', array('uses' =>'AdminController@permission'));
Route::post('/test/api', array('uses' => 'AdminController@testapi'));
//Route::post('/challenge/uploadimage',array('uses' => 'AdminController@showUploadFile'));


Route::get('/landing',function(){
    if (Session::get('login_flag')=='login') return redirect('/challenges/my');
    else    return view('landing');
});
Route::get('/invite','UserController@getListInvite');
Route::get('/shop','UserController@init_shoppage');
Route::get('/cart','UserController@cart');
Route::get('/balanceoverview','UserController@account_setting');
Route::get('/myprofile','UserController@my_profile');
Route::post('/myprofile','UserController@my_profile');
Route::get('/withdraw_paypal','UserController@withraw_paypal');
Route::get('challenges/invite/{cid}','UserController@challengInvite');
Route::get('/challenges/open', 'UserController@OpenChallenges');
Route::get('/challenges/closed', 'UserController@ClosedChallenges');
Route::get('/challenges/my', 'UserController@MyChallenges');
Route::get('/challenges/pass', 'UserController@passChallenges');
Route::get('/challenges/voting/{cid}', 'UserController@setVote');
Route::get('/challenges/detail/{cid}', 'UserController@challengeDetail');
Route::get('/challenges/result/{cid}', 'UserController@challengeResult');
Route::get('/challenges/invited/{cid}', 'UserController@invitedChallenge');


$this->get('admin/withdraw_process/{id}/{action}','AdminController@AdminRemark');


//Route::get('/challenges/open',function(){
//    if(isset($_COOKIE['email'])){
//        if (Session::get($_COOKIE['email'])) {
//            return view('challenges/open');
//        }
//        else{
//            return redirect('landing');
//        }
//    }
//    else{
//        return redirect('landing');
//    }
//
//});
//Route::get('/challenges/my',function(){
//    //return Session::get('jindongzheshenyang@gmail.com');
//    if(isset($_COOKIE['email'])){
//        if (Session::get($_COOKIE['email'])) {
//            return view('challenges.mychallenges');
//        }
//        else{
//            return redirect('landing');
//        }
//    }
//    else{
//        return redirect('landing');
//    }
//});

Route::get('/paypal',function(){
    return view('paywithpaypal');
});
Route::get('/paypal', 'PaymentController@index');
Route::get('/Aims',function(){

    return view('Aims');
});

Route::get('/charges&credit',function(){
    return view('charges&credit');
});
Route::get('/news&updates',function(){
    return view('news&updates');
});
Route::get('/support/withdrawal',function(){
    return view('support/withdrawal');
});
Route::get('/support/generalitermofuse',function(){
    return view('support/generalitermofuse');
});
Route::get('/support/deposit',function(){
    return view('support/deposit');
});
Route::get('/support/contact',function(){
    return view('support/contact');
});

// -----------pak_make_accountsettingpage(admin_side)---------------------
Route::get('/Admin/deposits',function(){
    return view('deposits');
});

// -----------pak_make_accountsettingpage(user_side)---------------------

Route::get('/transferredlog',function(){
    return view('transferredlog');
});
Route::get('/Profit_Loss',function(){
    return view('Profit_Loss');
});
Route::get('/withdraw_strip',function(){
    return view('withdraw_strip');
});


//-------------------------new-------------------------
Route::get('/admin_login',function(){
    return view('Admin/Auth/login');
});
Route::get('/admin_register',function(){
    return view('Admin/Auth/register');
});

Route::get('/total_image',function(){
    return view('Admin/total_image');
});

Route::get('/home',function(){
    return view('Admin/user');
});
Route::get('/about_us',function(){
    return view('about_us');
});
Route::get('/copyright',function(){
    return view('copyright');
});
Route::get('/privacy',function(){
    return view('privacy');
});
Route::get('/term_conditions',function(){
    return view('term_conditions');
});
// Route::get('/img_upload','UserController@withraw_paypal');
// Route::post('/img_upload', 'UserController@my_profile');

