@extends('admin_master')

@section('title','List of Works')

@section('content')
    {{--@if(session()->has('message'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session()->get('message') }}--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--@if($errors->any())--}}
    {{--<div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>--}}
    {{--@endif--}}


    {{--@php--}}
    {{--$data = DB::selectOne("SELECT * FROM `datasample` WHERE ID = 1");--}}
    {{--@endphp--}}
    {{--<img src="data:image/png;base64,{{ chunk_split(base64_encode($data->IMG)) }}" height="100" width="100">--}}


    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading"><span class="white_dash_head_txt">

                        {{--<button class="btn btn-default pull-right btn-sm" onclick="exporttoexcel();"><i--}}
                        {{--class="mdi mdi-download"></i> Download Excel</button>--}}
                        {{--<a href="#" class="btn btn-default btnSet add-user pull-right">--}}
                        {{--<span class="fa fa-plus"></span>&nbsp;Create New User</a>--}}
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="col-sm-5">
                                List of Works(Total Work : {{isset($work_count)?$work_count:'-'}})
                            </div>
                            @if(isset($users))
                                <div class="col-sm-5">
                        <select name="user_work" class="form-control" id="user_work">
                            <option value="0">All</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" {{isset($user_id)? $user->id==$user_id?'selected':'':''}} >{{$user->name}}{{'-'.$user->contact}}</option>
                            @endforeach
                        </select>
                                </div>
                                <div class="col-sm-2">
                                <button class="btn btn-default pull-right btn-sm" onclick="user_work();"><i
                                            class="mdi mdi-account-search"></i> Search</button>
                            </div>
                            @endif
                        </div>

                      </span>
                    <table id="{{isset($group)?'example':''}}" class="table table-bordered dataTable table-striped"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th class="options">OPTIONS</th>
                            <th>WORK ID</th>
                            <th>FRMID</th>
                            <th>S Name</th>
                            <th>F Name</th>
                            <th>FILENM</th>
                            <th>WORK_DONE_BY</th>
                            <th>GROUP ADMIN</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($work_data)>0)
                            @foreach($work_data as $work_dat)
                                {{--@php--}}
                                {{--$user = DB::selectOne("SELECT * FROM users where id in (select reffer_by from reffer where reffer_to = $user_master->id)");--}}
                                {{--@endphp--}}
                                <tr>
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
                                           title="View Details" data-toggle="tooltip" data-placement="top">
                                            <span class="mdi mdi-eye"></span></a>

                                        {{--@endif--}}
                                    </td>
                                    <td>{{$work_dat->ID}}</td>
                                    {{--<td>{{$work_dat->rc}}</td>--}}

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
                        @endif
                        </tbody>
                    </table>
                    @if(!isset($group))
                        {{$work_data->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function user_work() {
            var user_id = $('#user_work').val();
            if (user_id > 0) {
                window.open('{{url('user_works').'/'}}' + user_id, '_blank');
            } else {
                window.location.href = '{{url('work_done')}}';
            }
        }
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
