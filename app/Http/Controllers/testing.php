<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\UsersExport;

class testing extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    function  get_download_in_excel(){
        return $this->excel->download(new UsersExport, 'users.xlsx');
    }
}
