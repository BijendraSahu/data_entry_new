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
                    <table id="" class="table table-bordered dataTable table-striped"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th>S.No</th>
                            <th class="options">District Name</th>
                            <th>Total Work</th>
                            <th>Work Done</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $index=>$obj )
                            <tr>
                                <th>{{$index+1}}</th>
                                <td>{{$obj->districtname}} </td>
                                <td>{{$obj->totalwork}}</td>
                                <td>{{$obj->totalworkdone }}</td>
                                <td>
                                    {{--<button class="btn btn-info" onclick="get_full_report(this,'{{$obj->id}}')"><i--}}
                                    {{--class="mdi mdi-view-module"></i></button>--}}

                                    <a target="_blank" class="btn btn-info"
                                       href="{{url("export_data.php?district_name=$obj->districtname&district_id=$obj->id")}}"><i
                                                class="mdi mdi-view-module"></i></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

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

        function get_full_report(dis, id) {
            alert('work');
            debugger;
            var url = "{{url('/')}}" + "/view_full_work_report/" + id + "/view_full_work_report";
            window.location.href = url;
// $.get('',function(result_data){


// });
        }
    </script>
@stop
