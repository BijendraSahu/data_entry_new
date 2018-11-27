@extends('admin_master')

@section('title', 'Date Wise Report')

@section('head')
    <style>

        .btn_center {
            text-align: center;
            margin-top: 10px;
        }

        .update_btn {
            display: none;
        }

        .hidealways {
            display: none;
        }

        .label_checkbox {
            display: inline-block;
        }

        .label_checkbox .cr {
            margin: 0px 5px;
        }

        .newrow {
            background: #1e81cd52 !important;
        }

        .border_none {
            border: none !important;
        }

    </style>
@stop
@section('content')
    <section class="box_containner">
        <div class="container-fluid">
            <div class="row">

                <section id="menu2">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       Work Done Report
                                    {{--<button class="btn btn-default pull-right btn-sm" onclick="exporttoexcel();"><i--}}
                                    {{--class="mdi mdi-download"></i> Download Excel</button>--}}

                    </span>
                                <section id="user_table" class="table_main_containner">
                                    <form action="{{url('search_date_wise_report')}}" method="post"
                                          enctype="multipart/form-data" id="search_date_wise_report">
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <label for="">Start End</label>
                                                <input type="text" placeholder="Start Date"
                                                       data-format="dd/MM/yyyy hh:mm:ss" autocomplete="off"
                                                       class="form-control dtp required"
                                                       name="start_date"
                                                       value="{{isset($start_date)?date_format(date_create($start_date), "d-M-Y"):''}}"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="">End Date</label>
                                                <input type="text" placeholder="End Date"
                                                       class="form-control dtp required"
                                                       autocomplete="off" name="end_date"
                                                       value="{{isset($e_date)?date_format(date_create($e_date), "d-M-Y"):''}}"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="">Select Users</label>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="0">All</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" {{$user->id==$user_id?'selected':''}} >{{$user->name}}{{"-".$user->contact}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <div class="col-sm-3">
                                                <span></span>
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <a href="{{url('date_wise_report')}}"
                                                   class="btn btn-success">Refresh</a>
                                            </div>
                                        </div>
                                    </form>
                                    <br>


                                    {{--<button type="button"--}}
                                    {{--onclick="ShowConformationPopupMsg('Are you sure you want to delete this loaded Item');"--}}
                                    {{--class="btn btn-xs btn-danger btnDelete"--}}
                                    {{--title="Inactivate"><span class="fa fa-trash-o"--}}
                                    {{--aria-hidden="true"></span>--}}
                                    {{--Delete--}}
                                    {{--</button>--}}

                                    <div class="table-scroll style-scroll">
                                        <table class="table table-bordered dataTable table-striped scroll_table"
                                               id="{{isset($group)?'example':''}}">
                                            <thead>
                                            <tr>
                                                <th class="hidden">Id</th>
                                                <th class="width_10">OPTION</th>
                                                <th>WORK ID</th>
                                                <th>WORK_DATE</th>
                                                <th>FRMID</th>
                                                <th>S NAME</th>
                                                <th>F NAME</th>
                                                <th>FILENM</th>
                                                <th>WORK_DONE_BY</th>
                                                <th>GROUP ADMIN</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($work_data)>0)
                                                @foreach($work_data as $work_dat)
                                                    <tr>
                                                        <td class="hidden">{{$work_dat->id}}</td>
                                                        <td id="{{$work_dat->ID}}">
                                                            {{--<a href="#" id="{{$work_dat->id}}" onclick="edit_user(this)"--}}
                                                            {{--class="btn btn-sm btn-default edit-user_"--}}
                                                            {{--title="Edit User" data-toggle="tooltip" data-placement="top">--}}
                                                            {{--<span class="fa fa-pencil"></span></a>--}}
                                                            {{--@if($work_dat->is_active == 1)--}}
                                                            {{--<a href="#" id="{{$work_dat->id}}" onclick="inactive_user(this)"--}}
                                                            {{--class="btn btn-sm btn-danger"--}}
                                                            {{--title="Mark as inactive" data-toggle="tooltip"--}}
                                                            {{--data-placement="top">--}}
                                                            {{--<span class="mdi mdi-delete"></span></a>--}}
                                                            {{--@else--}}
                                                            <a href="#" id="{{$work_dat->ID}}" onclick="view_work(this)"
                                                               class="btn btn-sm btn-primary"
                                                               title="View Details" data-toggle="tooltip"
                                                               data-placement="top">
                                                                <span class="mdi mdi-eye"></span></a>

                                                            {{--@endif--}}
                                                        </td>
                                                        <td>{{$work_dat->ID}}</td>
                                                        {{--<td>{{$work_dat->rc}}</td>--}}
                                                        <td> {{ date_format(date_create($work_dat->READTIME), "d-M-Y")}}</td>
                                                        <td>{{$work_dat->FRMID}}</td>
                                                        <td>{{$work_dat->f103}}</td>
                                                        <td>{{$work_dat->f104}}</td>
                                                        <td>{{$work_dat->IMAGE_PATH}}</td>
                                                        <td>
                                                            @if(!isset($group))
                                                                {{$work_dat->WORK_DONE_BY != 0?$work_dat->work_by->name.'-'.$work_dat->work_by->contact:'-'}}

                                                            @else
                                                                @php
                                                                    $wo = \App\SchoolData::find($work_dat->ID);
                                                                @endphp
                                                                {{$wo->WORK_DONE_BY != 0?$wo->work_by->name.'-'.$wo->work_by->contact:'-'}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                if ($work_dat->WORK_DONE_BY != 0)
                                                                    $work_done_by = \App\UserMaster::find($work_dat->WORK_DONE_BY);
                                                            @endphp
                                                            @if(isset($work_done_by))
                                                                {{isset($work_done_by->activated_by)?$work_done_by->activate_by_name->name:'-'}}
                                                            @else

                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4">
                                                        <span class="list_no_record">< No Record Available ></span>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        @if(!isset($group))
                                            {{$work_data->links()}}
                                        @endif
                                    </div>
                                </section>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function view_work(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('View Work');
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('view_work_done') }}';
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {work_id: id},
                success: function (data) {
                    $('#mybody').html(data);
                },
                error: function (xhr, status, error) {
                    $('#mybody').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }


    </script>

@stop