@extends('admin_master')

@section('title','Payment History')

@section('content')

    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         List of Payment History
                     <button class="btn btn-default pull-right btn-sm" onclick="exporttoexcel();"><i
                                 class="mdi mdi-download"></i> Download Excel</button>
                      </span>
                    <table id="example" class="table table-bordered dataTable table-striped" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th style="min-width: 130px">Date</th>
                            <th style="min-width: 130px">User Name</th>
                            <th style="min-width: 10%">Paytm No</th>
                            <th style="min-width: 13%">Payment Entry</th>
                            <th style="min-width: 13%">Rate</th>
                            <th style="min-width: 13%">Payable Amount</th>
                            <th style="min-width: 200px">Remark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($payments)>0)
                            @foreach($payments as $payment)
                                <tr>
                                    <td> {{ date_format(date_create($payment->created_time), "d-M-Y h:i A")}}</td>
                                    <td>{{isset($payment->user->name)? $payment->user->name:"-"}}</td>
                                    <td>{{isset($payment->paytm_no)? $payment->paytm_no:"-"}}</td>
                                    <td>{{isset($payment->pay_for_count)? $payment->pay_for_count:"-"}}</td>
                                    <td>{{isset($payment->rate)? $payment->rate:"-"}}</td>
                                    <td>{{isset($payment->payable_amount)? $payment->payable_amount:"-"}}</td>
                                    <td>{{isset($payment->remark)? $payment->remark:"-"}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
