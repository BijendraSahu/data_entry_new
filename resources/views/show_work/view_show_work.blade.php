@extends('admin_master')

@section('title','List of Show Work')

@section('content')
    <style>
        .ads_img {
            height: 100px;
            width: 100px;
        }
    </style>
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
                         List of Show Work
                        {{--<button onclick="add_ads()" class="btn btn-default pull-right"><i--}}
                        {{--class="mdi mdi-plus"></i>Add</button>--}}
                      </span>
                    <table id="example" class="table table-bordered dataTable table-striped" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th class="hidden">Id</th>
                            <th class="options">Options</th>
                            <th>District</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($work_data)>0)
                            @foreach($work_data as $noti)
                                <tr>
                                    <td class="hidden">{{$noti->id}}</td>
                                    <td id="{{$noti->id}}">
                                        <a href="#" id="{{$noti->id}}" onclick="edit_district(this)"
                                           class="btn btn-sm btn-default edit-user_"
                                           title="Edit Show District Data" data-toggle="tooltip" data-placement="top">
                                            <span class="fa fa-pencil"></span></a>
                                    </td>

                                    <td>
                                        {{$noti->districtid == null ? "-" : $noti->districtid}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <script type="text/javascript">
        function edit_district(dis) {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Show District Data');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/images/loading.gif')}}"/>');

            var id = $(dis).attr('id');
            var editurl = '{{ url('edit_show_work') }}';
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }
    </script>
@stop
