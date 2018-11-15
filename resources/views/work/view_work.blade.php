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
                         List of Works
                        {{--<button class="btn btn-default pull-right btn-sm" onclick="exporttoexcel();"><i--}}
                        {{--class="mdi mdi-download"></i> Download Excel</button>--}}
                        {{--<a href="#" class="btn btn-default btnSet add-user pull-right">--}}
                        {{--<span class="fa fa-plus"></span>&nbsp;Create New User</a>--}}
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
                                        <a href="#" id="{{$work_dat->SRID}}" onclick="view_work(this)"
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
                                        <?php
                                             $output='';
                                             if(isset($_SESSION['admin_master']['id'])){
                                               $iid=$_SESSION['admin_master']['id'];
                                               }else{
                                                 $iid=$work_dat->WORK_DONE_BY;
                                             }
                                               if($iid!=''){

                                                   $row = DB::table('users')->where('id', $iid)->first();
                                                   if(isset($row)){
                                                  $a_id=$row->activated_by;

                                               //$actvated=DB::table('users')->where('id', $a_id)->first();
                                               $actvated=DB::table('users')->where('id', $a_id)->get();

                                            $output=$actvated;
                                            }
//                                                   }
                                              
                                            }else{
                                                   $output="self";
                                               }
                                       ?>

                                        @if(isset($row))
                                    <span id="name">
                                        {{$row->name}}
                                        @else
                                            self
                                            @endif
                                    </span>

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
