@extends('admin_master')

@section('title','List of User Works')

@section('content')
    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         List of Works
                      </span>
                    <table id="example" class="table table-bordered dataTable table-striped" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th class="options">OPTIONS</th>
                            <th>WORK ID</th>
                            <th>SHID</th>
                            <th>FRMID</th>
                            <th>FILENM</th>
                            <th>WORK_DONE_BY</th>
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
                                        <a href="#" id="{{$work_dat->SRID}}" onclick="edit_work(this)"
                                           class="btn btn-sm btn-default edit-user_"
                                           title="Edit User" data-toggle="tooltip" data-placement="top">
                                            <span class="fa fa-pencil"></span></a>
                                        {{--                                        @if($work_dat->is_active == 1)--}}
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
                                    <td>{{$work_dat->SHID}}</td>
                                    <td>{{$work_dat->FRMID}}</td>
                                    <td>{{$work_dat->FILENM}}</td>
                                    <td>{{$work_dat->WORK_DONE_BY != 0?$work_dat->work_by->name.'-'.$work_dat->work_by->contact:'-'}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{--                    {{$work_data->links()}}--}}
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
        function edit_work(dis) {
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
