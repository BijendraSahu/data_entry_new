<?php

namespace App\Http\Controllers;

use App\consumtion;
use App\item_master;
use App\perameter;
use App\purchase_details;
use App\purchase_master;
use App\users;
use App\vendor_master;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class Construction extends Controller
{
    public function addunit()
    {
        if (isset($_SESSION['admin_master']))
            return view('unit');
        else
            return redirect('/access')->with('message', 'Please Login First');
    }

    public function addunitname()
    {
        $data = new perameter();
        $data->name = request('unit_name');
        $data->save();
        return 'success';
    }

    public function delperameter()
    {
        $data = perameter::find(request('mypid'));
        $data->is_active = 0;
        $data->save();
        return 'done';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function report()
    {
        if (isset($_SESSION['admin_master']))
            return view('report');
        else
            return redirect('/access')->with('message', 'Please Login First');

    }

    public function getmyreport()
    {
        if (isset($_SESSION['admin_master'])) {
            $mydateone = Carbon::parse(request('mydateone'))->format('Y-m-d');
            $mydatetwo = Carbon::parse(request('mydatetwo'))->format('Y-m-d');

//            $myallitems= item_master::where(['is_active'=>1])->get();
            $myallitems = item_master::get();
            return view('reportload', ['myallitems' => $myallitems, 'mydateone' => $mydateone, 'mydatetwo' => $mydatetwo]);
        } else
            return redirect('/access')->with('message', 'Please Login First');


    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consumtion()
    {
        if (isset($_SESSION['admin_master'])) {
            return view('consumtion');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public function postconsumtion()
    {
        $count = count(request('unit')) / 5;
        $item_unit = request('unit');
        $u = 0;
        $k = 1;
        $cp = 2;
        $p = 3;
        $s = 4;
        for ($i = 0; $i < $count; $i++) {
            $item = new consumtion();
            $item->date = Carbon::parse(request('date'))->format('Y-m-d');
            $item->item_id = $item_unit[$u];
            $item->qty = $item_unit[$k];
            $item->unit = $item_unit[$cp];
            $item->unit_perameter = $item_unit[$p];
            $item->remark = $item_unit[$s];
            $item->save();
            $u = $s + 1;
            $k = $s + 2;
            $cp = $s + 3;
            $p = $s + 4;
            $s = $s + 5;
        }
        return redirect('/consumtion')->with('message', 'Consumtion has been added');

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function login()
    {
        $_SESSION['admin_master'] = null;
        return view('login.login');
    }

    public function logincheck()
    {
        $username = request('username');
        $password = request('password');
        $user = users::where(['username' => $username, 'password' => $password])->first();
        if ($user != null) {
            $_SESSION['admin_master'] = $user;
            return 'success';
        } else {
            /*return redirect('/adminlogin')->withInput()->withErrors(array('message' => 'UserName or password Invalid'));*/
            return 'fail';

        }
    }

    public function changemypass()
    {
        if (isset($_SESSION['admin_master'])) {
            $oldpass = request('oldp');
            $newpass = request('newp');
            $user = users::where(['id' => $_SESSION['admin_master']['id'], 'password' => $oldpass])->first();
            if (isset($user)) {
                $data = users::find($_SESSION['admin_master']['id']);
                $data->password = $newpass;
                $data->save();
                return 'done';

            } else {
                return 'fail';
            }
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }


    }

    public function addusers()
    {
        if (isset($_SESSION['admin_master'])) {
            return view('adduser');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public function addmyuser()
    {
        $data = new users();
        $data->name = request('name');
        $data->username = request('username');
        $data->password = request('password');
        $data->number = request('contact');
        $data->type = 'user';
        $data->save();
        return 'done';
    }

    public function deletemyuser()
    {
        $data = users::find(request('myid'));
        $data->delete();
        return 'done';
    }

//////////////////////////////////////////////////////////////////////////////


    public function viewpurchase($id)
    {
        if (isset($_SESSION['admin_master'])) {

            $dpurchase = purchase_master::find($id);
            $vendordetails = vendor_master::find($dpurchase->vendor_id);

            $dpurchasedetails = purchase_details::where(['purchase_master_id' => $id])->get();
            return view('addmore', ['dpurchase' => $dpurchase, 'dpurchasedetails' => $dpurchasedetails, 'vendordetails' => $vendordetails]);
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public
    function purchase()
    {
        if (isset($_SESSION['admin_master'])) {

            return view('purchase');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public
    function getdata()
    {
        $findidd = request('i_id');
        $data = item_master::find(request('i_id'));
        $dataone = perameter::find($data->unit_perameter);
        $purchasitem = purchase_details::where(['is_active' => 1, 'item_id' => $findidd])->sum('qty');
        $consumitem = consumtion::where(['is_active' => 1, 'item_id' => $findidd])->sum('qty');
        $availitem = $purchasitem - $consumitem;
        $returnarry = ['u_qty' => $data->unit, 'unit' => $dataone->name, 'availitem' => $availitem];
        return $returnarry;
    }

    public
    function postmybill()
    {
        $mdata = new purchase_master();
        $mdata->vendor_id = request('myvender');
        $mdata->date = Carbon::parse(request('date'))->format('Y-m-d');
        $mdata->invoice = request('invoice');
        $mdata->amount = request('g_amount');
        $mdata->disscount = request('g_disscount');
        $mdata->total = request('g_total');
        $mdata->save();


        $count = count(request('unit')) / 7;
        $item_unit = request('unit');
        $u = 0;
        $k = 1;
        $cp = 2;
        $p = 3;
        $s = 4;
        $q = 5;
        $pr = 6;
        for ($i = 0; $i < $count; $i++) {
            $item = new purchase_details();
            $item->purchase_master_id = $mdata->id;
            $item->date = Carbon::parse(request('date'))->format('Y-m-d');
            $item->item_id = $item_unit[$u];
            $item->unit = $item_unit[$k];
            $item->unit_perameter = $item_unit[$cp];
            $item->qty = $item_unit[$p];
            $item->amount = $item_unit[$s];
            $item->discount = $item_unit[$q];
            $item->total = $item_unit[$pr];
            $item->save();
            $u = $pr + 1;
            $k = $pr + 2;
            $cp = $pr + 3;
            $p = $pr + 4;
            $s = $pr + 5;
            $q = $pr + 6;
            $pr = $pr + 7;
        }
        return redirect('/purchase')->with('message', 'Purchase has been added');

    }

    public
    function getvendorde()
    {
        $vdata = vendor_master::find(request('myvendor'));
        return $vdata;
    }


/////////////////////start vendor section///////////////////////////////////////////////////////////////////////////
    public
    function addvender()
    {
        if (isset($_SESSION['admin_master'])) {
            return view('vendor');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public
    function vendorpost()
    {
        try {
            $data = new vendor_master();
            $data->vendor_name = request('v_name');
            $data->mobile = request('v_contact');
            $data->address = request('v_address');
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


    public
    function deletevendor()
    {
        try {
            $data = vendor_master::find(request('myidd'));
            $data->is_active = 0;
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public
    function updatevendor($id)
    {
        if (isset($_SESSION['admin_master'])) {
            $data = vendor_master::find($id);
            return view('update_vendor', ['data' => $data, 'fid' => $id]);
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }

    }

    public
    function vendorupdatepost()
    {

        try {
            $data = vendor_master::find(request('vfind'));
            $data->vendor_name = request('v_name');
            $data->mobile = request('v_contact');
            $data->address = request('v_address');
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

/////////////////////////////////////////////// End vendor section   ////////////////////////////////////////


/////////////////////////////////////////////// item section   //////////////////////////////////////////////////////////
    public
    function dashboard()
    {
        if (isset($_SESSION['admin_master'])) {
            return view('dashboard');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public
    function additem()
    {
        if (isset($_SESSION['admin_master'])) {
            return view('add_item');
        } else {
            return redirect('/access')->with('message', 'Please Login First');
        }
    }

    public
    function additempost()
    {
        try {
            $data = new item_master();
            $data->item_name = request('i_name');
            $data->unit = request('i_unit');
            $data->unit_perameter = request('i_unit_pera');
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public
    function deleteitem()
    {
        try {
            $data = item_master::find(request('myidd'));
            $data->is_active = 0;
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public
    function updateitem($id)
    {

        $data = item_master::find($id);
        return view('update_item', ['data' => $data, 'fid' => $id]);

    }

    public
    function updatepost()
    {
        try {
            $data = item_master::find(request('fid'));
            $data->item_name = request('i_name');
            $data->unit = request('i_unit');
            $data->unit_perameter = request('i_unit_pera');
            $data->save();
            return 'done';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
///////////////////////////////////item section end////////////////////////////////////////////////////////////////////////
}
