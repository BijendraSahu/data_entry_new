<?php

namespace App\Http\Controllers;

use App\SchoolData;
use App\SchoolValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class WorkController extends Controller
{
    public function works()
    {
        $work_data = SchoolData::paginate(8);
        return view('work.view_work')->with(['work_data' => $work_data]);
    }

    public function work_done()
    {
        if ($_SESSION['admin_master']->role == 'Super Admin') {
            $work_data = SchoolData::where(['IS_WORK_DONE' => 1])->paginate(8);
            return view('work.view_work')->with(['work_data' => $work_data]);
        } else {
            $login_id = $_SESSION['admin_master']->id;
            $work_data = DB::select("SELECT * FROM `datasample` WHERE WORK_DONE_BY in (SELECT id from users WHERE users.activated_by = '$login_id')");
            return view('work.view_work')->with(['work_data' => $work_data, 'group' => '1']);
        }
    }

    public function my_works()
    {
        $work_data = SchoolData::where(['IS_WORK_DONE' => 1, 'WORK_DONE_BY' => $_SESSION['admin_master']['id']])->paginate(8);
        return view('work.view_work')->with(['work_data' => $work_data]);
    }

    public function view_work_done()
    {
        $work_id = request('work_id');
        $work_data = SchoolData::find($work_id);
        if (isset($work_data)) {
//            $work_value_s_name = SchoolValue::where(['SRID' => $work_data->SRID, 'BLKNM' => 103])->first();
//            $work_value_f_name = SchoolValue::where(['SRID' => $work_data->SRID, 'BLKNM' => 104])->first();
            return view('work.view_work_details')->with(['work_data' => $work_data]);
        } else {
            return view('work.view_work_details')->with([$work_data => []]);
        }
    }

    public function start_work()
    {
//        $work_data = SchoolData::where(['IS_OPEN' => 0, 'IS_WORK_DONE' => 0])->get();
//
//        foreach ($work_data as $work_datum)
//        {
//            $d = '_';
//            $work_datum->IMAGE_PATH = "BSGP_2018/1001/$work_datum->TESTID$d$work_datum->FRMID.jpg";
//            $work_datum->save();
//        }
//        echo "Done";
        $work_data = SchoolData::where(['IS_OPEN' => 0])->first();
        if (isset($work_data)) {
            $data = SchoolData::find($work_data->ID);
            $data->IS_OPEN = 1;
            $data->save();
            if (file_exists($work_data->IMAGE_PATH)) {
                return view('work.create_work')->with(['work_data' => $work_data]);
            } else {
                $this->start_work();
            }
        } else {
            return view('start_work');
        }
    }

    public function save_work()
    {
        $data_id = request('data_id');
        $data = SchoolData::find($data_id);
        $data->IS_OPEN = 1;
        $data->IS_WORK_DONE = 1;
        $data->WORK_DONE_BY = (request('edit_data_id') == null) ? $_SESSION['admin_master']->id : $data->WORK_DONE_BY;
        $data->f103 = strtoupper(request('s_name'));
        $data->f104 = strtoupper(request('f_name'));
        $data->READTIME = Carbon::now('Asia/Kolkata');
        $data->save();
//        return redirect('start_work')->with('message', 'Details has been saved');
        if (request('edit_data_id') == null) {
            return redirect('start_work');
        } else {
            return redirect('work_done')->with('message', 'Work has been updated');
        }
    }
}
