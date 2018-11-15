@extends('admin_master')

@section('title','List of Open Works')

@section('content')

    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         List of Open Works
                            <a href="{{url('re_open_work')}}"
                               class="btn btn-default btnSet add-user pull-right" {{count($work_data)>0?'':'disabled="disabled"'}}>
                         <span class="fa fa-plus"></span>&nbsp;Re-Open ALL</a>
                      </span>
                    <table id="" class="table table-bordered dataTable table-striped"
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

                                        <a href="#" id="{{$work_dat->SRID}}" onclick="view_work(this)"
                                           class="btn btn-sm btn-primary"
                                           title="View Details" data-toggle="tooltip" data-placement="top">
                                            <span class="mdi mdi-eye"></span></a>
                                    </td>
                                    <td>{{$work_dat->ID}}</td>
                                    <td>{{$work_dat->FRMID}}</td>
                                    <td>{{$work_dat->f103}}</td>
                                    <td>{{$work_dat->f104}}</td>
                                    <td>{{$work_dat->IMAGE_PATH}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <span>No Record Available</span>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    {{$work_data->links()}}
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
