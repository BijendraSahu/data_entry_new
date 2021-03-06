<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\BankDetails;
use App\FirebaseData;
use App\GainTypePoints;
use App\LoginModel;
use App\PushData;
use App\RedeemRequest;
use App\UserMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;

session_start();

class AdminController extends Controller
{
    public function admin()
    {
        if ($_SESSION['admin_master'] != null) {
            $data = LoginModel::find(['id' => $_SESSION['admin_master']['id']])->first();
            return view('dashboard', ['data' => $data])->with('no', 1);
        } else {
            return redirect('/adminlogin');
        }

    }

    public function user_by_franchise()
    {
        if ($_SESSION['admin_master'] != null) {
            $franchises = AdminModel::getFranchiseDropdown();
            $data = AdminModel::find(['id' => $_SESSION['admin_master']['id']])->first();
            $users = UserMaster::getPaidUserMaster();
            return view('reports.users_by_franchise', ['data' => $data, 'franchises' => $franchises, 'users' => $users])->with('no', 1);
        } else {
            return redirect('/adminlogin');
        }

    }

    public function search_user_by_franchise()
    {
        $start_date = Carbon::parse(request('start_date'));
        $end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
        $e_date = $end_date . ' 23:59:00';
        $franchises = AdminModel::getFranchiseDropdown();
        $users = UserMaster::where('paid_time', '>=', $start_date)->where('paid_time', '<=', $e_date)->where(['activated_by' => request('franchise_id')])->get();
        return view('reports.users_by_franchise')->with(['users' => $users, 'franchises' => $franchises]);
    }

    public function distribution()
    {
        if ($_SESSION['admin_master'] != null) {
            $data = AdminModel::find(['id' => $_SESSION['admin_master']['id']])->first();
            $redeem_requests = RedeemRequest::where(['status' => 'approved'])->get();
            return view('reports.distribution_report', ['data' => $data, 'redeem_requests' => $redeem_requests])->with('no', 1);
        } else {
            return redirect('/adminlogin');
        }

    }

    public function search_distribution()
    {
        $start_date = Carbon::parse(request('start_date'));
        $end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
        $e_date = $end_date . ' 23:59:00';
        $redeem_requests = RedeemRequest::where('approved_time', '>=', $start_date)->where('approved_time', '<=', $e_date)->where(['status' => 'approved'])->get();
        return view('reports.distribution_report')->with(['redeem_requests' => $redeem_requests]);
    }

    public function adminlogin()
    {
        if (isset($_SESSION['admin_master'])) {
            return redirect('/admin');
        } else {
            return view('login');
        }
    }

    public function logincheck()
    {
        $username = request('username');
        $password = md5(request('password'));
        $password_new = request('password');
        $user = LoginModel::where(['username' => $username, 'password' => $password])->first();
        $user_new = LoginModel::where(['username' => $username, 'password' => $password_new])->first();
        if (isset($user)) {
            if ($user->is_active == 1) {
                $_SESSION['admin_master'] = $user;
                return 'success';
            } else {
                return 'unautherised';
            }
        } else if (isset($user_new)) {
            if ($user_new->is_active == 1) {
                $_SESSION['admin_master'] = $user_new;
                return 'success';
            } else {
                return 'unautherised';
            }
        } else {
            return 'fail';
        }
    }

    public function registration()
    {
        return view('registration');
    }

    public function save_registration(Request $request)
    {
        $username = AdminModel::where(['username' => request('username')])->first();
        if (isset($username) & request('username') != null) {
            return redirect('/')->withInput()->withErrors(array('message' => 'Username already exist in system please use different number'));
        } else {
            $reg = new AdminModel();
            $reg->name = request('name');
            $reg->contact = request('contact');
            $reg->paytm_no = request('paytm_no');
            $reg->email = request('email');
            $reg->username = request('username');
            $reg->password = md5(request('password'));
            $reg->is_active = 0;
            $file = $request->file('file_path');
            if ($request->file('file_path') != null) {
                $destination_path = 'admin_pic/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $file->move($destination_path, $filename);
                $reg->image = $destination_path . $filename;
            }
            $reg->save();
            return redirect('/')->with('message', 'Registration has been successful please contact to administrator(9329641500) to activate your account');
        }

    }

    public function getData()
    {
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

//        require_once __DIR__ . '/firebase.php';
//        require_once __DIR__ . '/push.php';

        $firebase = new FirebaseData();
        $push = new PushData();

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        $title = request('title');// isset($_GET['title']) ? $_GET['title'] : '';

        // notification message
        $message = request('message');//$_GET['message']) ? $_GET['message'] : '';

        // push type - single user / topic
        $push_type = request('push_type');

        // whether to include to image or not
//        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;


        $push->setTitle($title);
        $push->setMessage($message);
//        if ($include_image) {
//            $push->setImage('https://api.androidhive.info/images/minion.jpg');
//        } else {
//            $push->setImage('');
//        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $res = array();
        $res['data']['title'] = $title;
        $res['data']['is_background'] = 0;
        $res['data']['message'] = $message;
//        $res['data']['image'] = $this->image;
//        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = Carbon::now(); //date('Y-m-d G:i:s');

        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $res);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
        //echo $_GET['push_type'];

        echo "Data: " . json_encode($response);
    }


    public function change_account()
    {
        if ($_SESSION['admin_master'] != null) {
            $data = LoginModel::find($_SESSION['admin_master']->id);
            $data->name = request('name');
            $data->email = request('email');
            $data->contact = request('contact');
            $data->paytm_no = request('paytmno');
            $data->save();
            return 1;
        } else {
            return redirect('/adminlogin');
        }

    }
}
