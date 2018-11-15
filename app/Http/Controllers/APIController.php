<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\Exports\UsersExport;
use App\SchoolData;
use App\SchoolValue;
use App\UserMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Maatwebsite\Excel\Facades\Excel;
use Validator;


class APIController extends Controller
{

//    ---------------------------------------
    /**************Rest API Function**************/
    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**************Rest API Function**************/
    public function insert_url_data(Request $request)
    {
//        $value = new SchoolValue();
//        $value->RVAL = request('data');
//        $value->save();
        $data = request('data');
        DB::select("$data");

    }


    public function get_dis_report(Request $request)
    {
        $details = \Illuminate\Support\Facades\DB::select("select id,districtname, (select COUNT(*) from datasample where districtid=d.id) as totalwork,
        (select COUNT(*) from datasample where districtid=d.id and IS_WORK_DONE=1 and IS_OPEN=1) as totalworkdone
        from district d");
        return view('work.report')->with(['result' => $details]);
    }

    function view_full_work_report($dist_id)
    {
        $details = DB::select("SELECT districtid, school_code, (select schoolname from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schoolname, (select schooladdr from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schooladdr, (select districtname from district where id=d.DISTRICTID ) as place,
d.f1,d.f2,d.f3,d.f4,d.f5,d.f6,d.f7,d.f8,d.f9,d.f10,d.f11,d.f12,d.f13,d.f14,d.f15,d.f16,d.f17,d.f18,d.f19,d.f20,d.f21,d.f22,d.f23,d.f24,d.f25,d.f26,d.f27,d.f28,d.f29,d.f30,d.f31,d.f32,d.f33,d.f34,d.f35,d.f36,d.f37,d.f38,d.f39,d.f40,d.f41,d.f42,d.f43,d.f44,d.f45,d.f46,d.f47,d.f48,d.f49,d.f50,d.f51,d.f52,d.f53,d.f54,d.f55,d.f56,d.f57,d.f58,d.f59,d.f60,d.f61,d.f62,d.f63,d.f64,d.f65,d.f66,d.f67,d.f68,d.f69,d.f70,d.f71,d.f72,d.f73,d.f74,d.f75,d.f76,d.f77,d.f78,d.f79,d.f80,d.f81,d.f82,d.f83,d.f84,d.f85,d.f86,d.f87,d.f88,d.f89,d.f90,d.f91,d.f92,d.f93,d.f94,d.f95,d.f96,d.f97,d.f98,d.f99,d.f100,frmid as studentnumber, f103 as studentname,f104 as fathername,d.ID as data_id, case when d.testid=1 then '5' when d.testid=2 then '6' when d.testid=3 then '7' when d.testid=4 then '8' when d.testid=5 then '9' when d.testid=6 then '10' when d.testid=7 then '11' when d.testid=8 then '12' when d.testid=9 then 'Jagran' when d.testid=10 then 'Darpan' else '' end as class_data FROM datasample d WHERE districtid=$dist_id");
        return view('reports.view_full_details_dist_work')->with(["result" => $details]);
    }

    public function test()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world Amit')->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "denG_Y3xlKw:APA91bFg0PVxYaI-knF2q-X79Lbz5xRP_a0BhPOQyfSmbW7bYmPQuZyfPUnArMpmYnM8K6WbUKt-iKT4Owjlx31XNH4fMC1ioBsqTtcI5_rEfJJc2ImvvWOBEG_ejPZLdfYzdyZ9eDGx";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        // $downstreamResponse->numberSuccess();
//        $downstreamResponse->numberFailure();
//        $downstreamResponse->numberModification();


//return Array - you must remove all this tokens in your database
        // $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
        // $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
        // $downstreamResponse->tokensToRetry();

// return Array (key:token, value:errror) - in production you should remove from your database the token
    }

    function get_more_record()
    {
        $dist_id = $_SESSION['dist_id'];
        $details = DB::select("SELECT districtid, school_code, (select schoolname from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schoolname, (select schooladdr from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schooladdr, (select districtname from district where id=d.DISTRICTID ) as place,
d.f1,d.f2,d.f3,d.f4,d.f5,d.f6,d.f7,d.f8,d.f9,d.f10,d.f11,d.f12,d.f13,d.f14,d.f15,d.f16,d.f17,d.f18,d.f19,d.f20,d.f21,d.f22,d.f23,d.f24,d.f25,d.f26,d.f27,d.f28,d.f29,d.f30,d.f31,d.f32,d.f33,d.f34,d.f35,d.f36,d.f37,d.f38,d.f39,d.f40,d.f41,d.f42,d.f43,d.f44,d.f45,d.f46,d.f47,d.f48,d.f49,d.f50,d.f51,d.f52,d.f53,d.f54,d.f55,d.f56,d.f57,d.f58,d.f59,d.f60,d.f61,d.f62,d.f63,d.f64,d.f65,d.f66,d.f67,d.f68,d.f69,d.f70,d.f71,d.f72,d.f73,d.f74,d.f75,d.f76,d.f77,d.f78,d.f79,d.f80,d.f81,d.f82,d.f83,d.f84,d.f85,d.f86,d.f87,d.f88,d.f89,d.f90,d.f91,d.f92,d.f93,d.f94,d.f95,d.f96,d.f97,d.f98,d.f99,d.f100,frmid as studentnumber, f103 as studentname,f104 as fathername,d.ID as data_id, case when d.testid=1 then '5' when d.testid=2 then '6' when d.testid=3 then '7' when d.testid=4 then '8' when d.testid=5 then '9' when d.testid=6 then '10' when d.testid=7 then '11' when d.testid=8 then '12' when d.testid=9 then 'Jagran' when d.testid=10 then 'Darpan' else '' end as class_data
FROM datasample d WHERE districtid=$dist_id limit 10001 OFFSET 10001");
        return view('reports.view_full_details_dist_work')->with(["result" => $details]);
    }

    public function download_data_on_excel()
    {
        $details = DB::select("SELECT districtid, school_code, (select schoolname from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schoolname, (select schooladdr from schoolmaster where districtid LIKE d.DISTRICTID and schoolcode=d.SCHOOL_CODE) as schooladdr, (select districtname from district where id=d.DISTRICTID ) as place,
d.f1,d.f2,d.f3,d.f4,d.f5,d.f6,d.f7,d.f8,d.f9,d.f10,d.f11,d.f12,d.f13,d.f14,d.f15,d.f16,d.f17,d.f18,d.f19,d.f20,d.f21,d.f22,d.f23,d.f24,d.f25,d.f26,d.f27,d.f28,d.f29,d.f30,d.f31,d.f32,d.f33,d.f34,d.f35,d.f36,d.f37,d.f38,d.f39,d.f40,d.f41,d.f42,d.f43,d.f44,d.f45,d.f46,d.f47,d.f48,d.f49,d.f50,d.f51,d.f52,d.f53,d.f54,d.f55,d.f56,d.f57,d.f58,d.f59,d.f60,d.f61,d.f62,d.f63,d.f64,d.f65,d.f66,d.f67,d.f68,d.f69,d.f70,d.f71,d.f72,d.f73,d.f74,d.f75,d.f76,d.f77,d.f78,d.f79,d.f80,d.f81,d.f82,d.f83,d.f84,d.f85,d.f86,d.f87,d.f88,d.f89,d.f90,d.f91,d.f92,d.f93,d.f94,d.f95,d.f96,d.f97,d.f98,d.f99,d.f100,frmid as studentnumber, f103 as studentname,f104 as fathername,d.ID as data_id, case when d.testid=1 then '5' when d.testid=2 then '6' when d.testid=3 then '7' when d.testid=4 then '8' when d.testid=5 then '9' when d.testid=6 then '10' when d.testid=7 then '11' when d.testid=8 then '12' when d.testid=9 then 'Jagran' when d.testid=10 then 'Darpan' else '' end as class_data
FROM datasample d WHERE districtid=24");

//        return \Maatwebsite\Excel\Facades\Excel::download($details,'my_file','xlsx');
        // return Excel::download(new $details, 'users.xlsx');
//        return Excel::create('data_contect',function ($excel) use ($details){
//            $excel->sheet('mysheet',function ($sheet) use($details){
//
//                $sheet->fromArray($details);
//            });
//        })->download('xls');
//        return (new UserMaster)->download('invoices.xlsx');
        return $this->exporter->download(new UserMaster);
    }
}
