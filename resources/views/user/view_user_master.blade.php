@extends('admin_master')

@section('title','List of Users')

@section('content')

    {{--@if(session()->has('message'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session()->get('message') }}--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--@if($errors->any())--}}
    {{--<div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>--}}
    {{--@endif--}}
    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         List of All Users
                        {{--<button class="btn btn-default btn-sm" onclick="ListCheckAll(this);"><i--}}
                        {{--class="mdi mdi-download"></i> Check All</button>--}}
                        <a href="#" class="btn btn-default btnSet add-user pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New User</a>
                      </span>
                    <form action="{{url('send_notification')}}" enctype="multipart/form-data" method="post">
                        @if($_SESSION['admin_master']->role == 'Super Admin')
                            <button class="btn btn-primary" type="submit">Update Notify User</button> @endif
                        <table id="example_user" class="table table-bordered dataTable table-striped" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr class="bg-info">
                                <th class="options">Options @if($_SESSION['admin_master']->role == 'Super Admin')
                                        <input type="checkbox" id="chkParent"/> @endif </th>
                                {{--<th>Profile</th>--}}
                                <th>Name</th>
                                {{--<th>Contact</th>--}}
                                <th>Paytm No</th>
                                <th>Username</th>
                                {{--<th style="min-width: 130px">Password</th>--}}
                                <th>Role</th>
                                <th>Work Count</th>
                                <th>Paid Count</th>
                                <th>Group Admin</th>
                                <th>Active Status</th>
                                <th>Joining Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($user_masters)>0)
                                @foreach($user_masters as $user_master)
                                    @if ($user_master->role == 'Group Admin')
                                        @php
                                            $Userswork = DB::selectOne("SELECT COUNT(ID) as work_done FROM `datasample` WHERE
                                            WORK_DONE_BY in (SELECT id from users WHERE users.activated_by =
                                            '$user_master->id')");
                                        $work_count = $Userswork->work_done;
                                        @endphp
                                    @else
                                        @php
                                            $work_count = \App\SchoolData::where(['IS_WORK_DONE' => 1,'WORK_DONE_BY'=>$user_master->id])->count();
                                        @endphp

                                    @endif
                                    @php
                                        $paid_count = \App\PaymentHistory::where(['user_id' => $user_master->id])->sum('pay_for_count');
                                    @endphp
                                    <tr>
                                        <td id="{{$user_master->id}}">
                                            @if($_SESSION['admin_master']->role == 'Super Admin')   <input
                                                    type="checkbox"
                                                    name="user_id[]"
                                                    {{$user_master->is_show_notification == 1 ?'checked':''}} value="{{$user_master->id}}"
                                                    class="list_table"/> @endif
                                            <a href="#" id="{{$user_master->id}}" onclick="edit_user(this)"
                                               class="btn btn-xs btn-default edit-user_"
                                               title="Edit User" data-toggle="tooltip" data-placement="top">
                                                <span class="fa fa-pencil"></span></a>
                                            <a href="#" id="{{$user_master->id}}" onclick="paynow(this)"
                                               class="btn btn-xs btn-primary edit-user_"
                                               title="Paynow" data-toggle="tooltip" data-placement="top">
                                                <span class="fa fa-money"></span></a>
                                            @if($user_master->is_active == 1)
                                                <a href="#" id="{{$user_master->id}}" onclick="inactive_user(this)"
                                                   class="btn btn-xs btn-danger"
                                                   title="Mark as inactive" data-toggle="tooltip"
                                                   data-placement="top">
                                                    <span class="mdi mdi-delete"></span></a>
                                            @else
                                                <a href="#" id="{{$user_master->id}}" onclick="active_user(this)"
                                                   class="btn btn-xs btn-primary"
                                                   title="Mark as active" data-toggle="tooltip" data-placement="top">
                                                    <span class="mdi mdi-check"></span></a>

                                            @endif
                                            {{--<a href="#" id="{{$user_master->id}}" onclick="empty_user(this)"--}}
                                            {{--class="btn btn-sm btn-danger"--}}
                                            {{--title="Mark as empty" data-toggle="tooltip" data-placement="top">--}}
                                            {{--<span class="mdi mdi-thumb-down"></span></a>--}}
                                            {{--<a href="#" id="{{$user_master->id}}" onclick="remind_user(this)"--}}
                                            {{--class="btn btn-sm btn-info"--}}
                                            {{--title="Remind user for payment" data-toggle="tooltip" data-placement="top">--}}
                                            {{--<span class="mdi mdi-remote"></span></a>--}}

                                        </td>
                                        {{--<td>--}}
                                        {{--<div class="post_imgblock_admin">--}}
                                        {{--@if(isset($user_master->profile_img))--}}
                                        {{--<img style="height: 100%; width: 100%"--}}
                                        {{--src="{{url('').'/'.$user_master->profile_img}}"/>--}}
                                        {{--@else--}}
                                        {{--<img style="height: 100%; width: 100%"--}}
                                        {{--src="{{url('assets/images/Male_default.png')}}"/>--}}
                                        {{--@endif--}}

                                        {{--</div>--}}
                                        {{--</td>--}}
                                        <td>{{$user_master->name}}({{$user_master->id}})</td>
                                        <td>{{isset($user_master->paytm_no)?$user_master->paytm_no:'N/A'}}</td>
                                        <td>{{$user_master->username}}</td>
                                                                                {{--<td>{{$user_master->password}}</td>--}}
                                        <td>{{$user_master->role}}</td>
                                        <td>{{$work_count}} {{--<a href="#" class="label label-primary" --}}{{--onclick="pay_now();"--}}{{-->Pay Now</a>--}}</td>
                                        <td>{{$paid_count}}</td>
                                        <td>{{isset($user_master->activated_by)?$user_master->activate_by_name->name:'-'}}</td>
                                        {{--<td>{{$user_master->paytm_contact}}</td>--}}
                                        {{--<td>{{$user_master->points}}</td>--}}
                                        {{--<td>--}}
                                        {{--@if(isset($user))--}}
                                        {{--{{$user->name}} <br> {{$user->rc}}--}}
                                        {{--@else--}}
                                        {{--{{"-"}}--}}
                                        {{--@endif--}}
                                        {{--</td>--}}

                                        <td>
                                            @if($user_master->is_active == 1)
                                                <p class="bg-success">Active</p>
                                            @else
                                                <p class="bg-danger">
                                                    InActive {{$user_master->is_block == 1 ? 'Block' : ''}}</p>

                                            @endif
                                        </td>
                                        <td> {{ date_format(date_create($user_master->created_time), "d-M-Y h:i A")}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        var table = $('#example_user').DataTable({
//            "columnDefs": [
//                {"width": "20px", "targets": 0}
//            ],
            "order": [[0, "desc"]],
            paging: false
        });

        $('.datatable-col').on('keyup change', function () {
            table.column($(this).attr('id')).search($(this).val()).draw();
        });
        $(document).ready(function () {
            $('#chkParent').click(function () {
                var isChecked = $(this).prop("checked");
                $('#example_user tr:has(td)').find('input[type="checkbox"]').prop('checked', isChecked);
            });

//            $('#example tr:has(td)').find('input[type="checkbox"]').click(function () {
//                var isChecked = $(this).prop("checked");
//                var isHeaderChecked = $("#chkParent").prop("checked");
////                if (isChecked == false & amp; & amp; isHeaderChecked)
//                $("#chkParent").prop('checked', isChecked)
//                else
//                {
//                    $('#tblData tr:has(td)').find('input[type="checkbox"]').each(function () {
//                        if ($(this).prop("checked") == false)
//                            isChecked = false;
//                    });
//                    $("#chkParent").prop('checked', isChecked);
//                }
//            });
        });
        function ListCheckAll(dis) {
            $('.list_table').find('input[type="checkbox"]').prop("checked", $(dis).prop("checked"));
        }
        function inactive_user(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Inactivation');
            $('#mybody').html('<h5>Are you sure want to Inactivate this user<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('user_master') }}/' + id +
                '/inactivate"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }

        function active_user(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Inactivation');
            $('#mybody').html('<h5>Are you sure want to activate this user<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('user_master') }}/' + id +
                '/activate"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }

        function empty_user(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Inactivation');
            $('#mybody').html('<h5>Are you sure want to empty points for this user<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('user_master') }}/' + id +
                '/empty"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }

        function remind_user(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Inactivation');
            $('#mybody').html('<h5>Are you sure want to remind this user for payment<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('user_master') }}/' + id +
                '/remind"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }
        $(".add-user").click(function () {
            $('#myModal').modal('show');
            $('#modal_title').html('Add New User');
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
//alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('user_master/create') }}",
                success: function (data) {
                    $('#mybody').html(data);
//            $('#modelBtn').visible(disabled);
                },
                error: function (xhr, status, error) {
                    $('#mybody').html(xhr.responseText);
//$('.modal-body').html("Technical Error Occured!");
                }
            });

        });
        {{--$(".edit-user_").click(function () {--}}
        {{--$('#myModal').modal('show');--}}
        {{--$('.modal-title').html('Edit User');--}}
        {{--$('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');--}}

        {{--var id = $(this).attr('id');--}}
        {{--var editurl = '{{ url('/') }}' + "/user_master/" + id + "/edit";--}}
        {{--$.ajax({--}}
        {{--type: "GET",--}}
        {{--contentType: "application/json; charset=utf-8",--}}
        {{--url: editurl,--}}
        {{--data: '{"data":"' + id + '"}',--}}
        {{--success: function (data) {--}}
        {{--$('.modal-body').html(data);--}}
        {{--},--}}
        {{--error: function (xhr, status, error) {--}}
        {{--$('.modal-body').html(xhr.responseText);--}}
        {{--//$('.modal-body').html("Technical Error Occured!");--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}


        {{--function active_user(dis) {--}}
        {{--var id = $(dis).attr('id');--}}
        {{--$('#myModal').modal('show');--}}
        {{--$('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');--}}
        {{--$('#modal_title').html('Confirm Activation');--}}
        {{--$('#mybody').html('<h5>Are you sure want to activate/paid this user<h5/>');--}}
        {{--$('#modalBtn').removeClass('hidden');--}}
        {{--$('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('user_master') }}/' + id +--}}
        {{--'/activate"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'--}}
        {{--);--}}
        {{--$('#myModal').modal('show');--}}
        {{--$('#modal_title').html('Activate User');--}}
        {{--$('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');--}}

        {{--var id = $(dis).attr('id');--}}
        {{--var editurl = '{{ url('activate_with_key').'/' }}' + id;--}}
        {{--$.ajax({--}}
        {{--type: "GET",--}}
        {{--contentType: "application/json; charset=utf-8",--}}
        {{--url: editurl,--}}
        {{--data: '{"data":"' + id + '"}',--}}
        {{--success: function (data) {--}}
        {{--$('#mybody').html(data);--}}
        {{--},--}}
        {{--error: function (xhr, status, error) {--}}
        {{--$('#mybody').html(xhr.responseText);--}}
        {{--//$('.modal-body').html("Technical Error Occured!");--}}
        {{--}--}}
        {{--});--}}
        {{--}--}}
        function edit_user(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('Edit User');
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/user_master/" + id + "/edit";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#mybody').html(data);
                },
                error: function (xhr, status, error) {
                    $('#mybody').html(xhr.responseText);
//$('.modal-body').html("Technical Error Occured!");
                }
            });
        }

        function paynow(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('Pay Now');
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/paynow/" + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
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
