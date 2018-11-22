@extends('admin_master')

@section('title','List of Advertisement')

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
                         List of Notifications
                        {{--<button onclick="add_ads()" class="btn btn-default pull-right"><i--}}
                        {{--class="mdi mdi-plus"></i>Add</button>--}}
                      </span>
                    <table id="example" class="table table-bordered dataTable table-striped" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th class="hidden">Id</th>
                            <th class="options">Options</th>
                            <th>Notification</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($Notifications)>0)
                            @foreach($Notifications as $noti)
                                <tr>
                                    <td class="hidden">{{$noti->id}}</td>
                                    <td id="{{$noti->id}}">
                                        <a href="#" id="{{$noti->id}}" onclick="edit_ads(this)"
                                           class="btn btn-sm btn-default edit-user_"
                                           title="Edit Notification" data-toggle="tooltip" data-placement="top">
                                            <span class="fa fa-pencil"></span></a>
                                        @if($noti->is_active == 1)
                                            <button type="button"
                                                    id="{{ $noti->id }}"
                                                    class="btn btn-sm btn-danger btnDelete" onclick="inactive_noti(this)"
                                                    title="Inactivate Notification" data-toggle="tooltip"
                                                    data-placement="top"><span
                                                        class="fa fa-trash-o" aria-hidden="true"></span>
                                            </button>
                                        @else
                                            <button type="button"
                                                    id="{{ $noti->id }}" onclick="active_noti(this)"
                                                    class="btn btn-sm btn-success btnactive"
                                                    title="Activate Notification" data-toggle="tooltip"
                                                    data-placement="top"><span
                                                        class="fa fa-align-center"
                                                        aria-hidden="true"></span></button>
                                        @endif
                                    </td>

                                    <td>
                                        {{$noti->notification == null ? "-" : $noti->notification}}
                                    </td>
                                    <td>
                                        {{$noti->is_active == null ? 'Inactivated' : 'activated'}}
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
    <script>
        $(".create-add").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Notification');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('notificn/create') }}",
                success: function (data) {
                    $('.modal-body').html(data);
//            $('#modelBtn').visible(disabled);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });

        });

        function edit_ads(dis) {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Notification');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/notificn/" + id + "/edit";
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

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/notification/" + id + "/delete";
            $('#ConfirmBtn').attr("href", append_url);
        });

        function inactive_noti(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/images/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Inactivation');
            $('#mybody').html('<h5>Are you sure want to Inactivate this Notification<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('notification') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }
        function active_noti(dis) {
            var id = $(dis).attr('id');
            $('#myModal').modal('show');
            $('#mybody').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#modal_title').html('Confirm Activation');
            $('#mybody').html('<h5>Are you sure want to activate this Notification<h5/>');
            $('#modalBtn').removeClass('hidden');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('notification') }}/' + id +
                '/active"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }

    </script>
@stop
