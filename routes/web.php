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

Route::get('/', function () {
    return view('login');
});

Route::GET('logout', function () {
    session_start();
    $_SESSION['admin_master'] = null;
    return redirect('/');
});

/*********Admin + Login***********/
Route::get('/admin', 'AdminController@admin');
Route::get('/', 'AdminController@adminlogin');
Route::get('account', 'AdminController@change_account');
Route::get('user_by_franchise', 'AdminController@user_by_franchise');
Route::post('search_user_by_franchise', 'AdminController@search_user_by_franchise');

Route::get('distribution', 'AdminController@distribution');
Route::post('distribution', 'AdminController@search_distribution');


Route::get('/logincheck', 'AdminController@logincheck');
Route::get('registration', 'AdminController@registration');
Route::post('registration', 'AdminController@save_registration');

Route::get('date_wise_report', 'WorkController@date_wise_report');
Route::post('search_date_wise_report', 'WorkController@search_date_wise_report');
Route::get('s_date_wise_report', 'WorkController@s_date_wise_report');


Route::get('insert_url_data', 'APIController@insert_url_data');

Route::get('works', 'WorkController@works');
Route::get('work_done', 'WorkController@work_done');
Route::get('view_work_done', 'WorkController@view_work_done');
Route::get('start_work', 'WorkController@start_work');
Route::get('my_works', 'WorkController@my_works');
Route::get('user_works/{id}', 'WorkController@user_works');
Route::post('save_work', 'WorkController@save_work');

Route::get('open_work', 'WorkController@open_work');
Route::get('re_open_work', 'WorkController@re_open_work');
Route::get('re_open_work_file', 'WorkController@re_open_work_file');
Route::get('gain_type_points', 'AdminController@gain_type_points');
Route::get('gain_type_points/{id}/edit', 'AdminController@edit_gain_type_points');
Route::post('gain_type_points/{id}', 'AdminController@update_gain_type_points');

Route::get('/settings/{id}', 'SettingController@settings');
Route::get('/changepass', 'SettingController@changepass');
Route::post('myadminpost', 'SettingController@myadminpost');
/*********Admin + Login***********/


/*********Users***********/
Route::resource('notificn', 'NotificationController');
Route::get('notification/{id}/delete', 'NotificationController@destroy');
Route::get('notification/{id}/active', 'NotificationController@active');

Route::resource('user_master', 'UserMasterController');
Route::get('activate_with_key/{id}', 'UserMasterController@activate_with_key');
Route::get('user_master/{id}/delete', 'UserMasterController@destroy');
//Route::post('user_master/{id}/activate', 'UserMasterController@activate');
Route::get('user_master/{id}/activate', 'UserMasterController@activate');
Route::get('user_master/{id}/inactivate', 'UserMasterController@inactivate');
Route::get('user_master/{id}/empty', 'UserMasterController@empty_point');
Route::get('user_master/{id}/remind', 'UserMasterController@reminder_points');
Route::post('send_notification', 'UserMasterController@send_notification');
Route::get('paynow/{id}', 'UserMasterController@paynow');
Route::post('paynow/{id}', 'UserMasterController@paynow_save');
Route::get('payment_history', 'UserMasterController@payment_history');


Route::get('show_work', 'WorkController@show_work');
Route::get('edit_show_work', 'WorkController@edit_show_work');
Route::post('update_show_work', 'WorkController@update_show_work');

/*********Users***********/


/*************API******************/
Route::get('getBankDetails','APIController@getBankDetails');
Route::get('getUserRecord','APIController@getUserRecord');
Route::get('getAdsCounts','APIController@getAdsCounts');
Route::get('getregister','APIController@getregister');
Route::get('verify_otp','APIController@verify_otp');
Route::get('resend_otp','APIController@resend_otp');
Route::get('getAllAds','APIController@getAllAds');
Route::get('checkrc','APIController@checkrc');
Route::get('get_user_point','APIController@get_user_point');
Route::get('get_user_point_new','APIController@get_user_point_new');
Route::get('view_share_ads_by_user','APIController@view_share_ads_by_user');
Route::post('edit_profile','APIController@edit_profile');
Route::post('edit_profile_login','APIController@edit_profile_login');
Route::get('getMyReferral','APIController@getMyReferral');
Route::get('getAdsPoints','APIController@getAdsPoints');
Route::get('getAllNews','APIController@getAllNews');
Route::get('getAllGallery','APIController@getAllGallery');
//-----------Redeem----------//
Route::get('redeem_now', 'APIController@redeem_now'); //Redeems now
Route::get('redeem_history', 'APIController@redeem_history'); //Redeems show
Route::get('point_history', 'APIController@point_history'); //Point show
Route::get('add_update_bank_details','APIController@add_update_bank_details');
//-----------Redeem----------//
Route::get('getData','AdminController@getData');
Route::get('test','APIController@test');
/*************API******************/
Route::get('report_d','APIController@get_dis_report');
Route::get('view_full_work_report/{dist_id}/view_full_work_report','APIController@view_full_work_report');
Route::get('get_more_record','APIController@get_more_record');
Route::get('download_data_on_excel','APIController@download_data_on_excel');
/*----------------------------------------------------------------------*/
Route::get('get_download_in_excel','testing@get_download_in_excel');


Route::get('view_done_report/{id}','APIController@view_done_report');



