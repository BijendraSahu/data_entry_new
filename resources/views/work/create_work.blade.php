@extends('admin_master')

@section('title','Start Work')

@section('content')
    <style>
        .ads_img {
            height: 100%;
            width: 100%;
        }

        .textUpper {
            text-transform: uppercase;
        }

        .image_container {
            width: 100%;
            overflow: auto;
            max-height: 350px;
            margin: 15px 0px;
        }

        .textbox_div {
            width: 100%;
            max-width: 540px;
            margin: 0px auto;
        }
    </style>
    <div class="row box_containner">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="dash_boxcontainner white_boxlist">
                <div class="upper_basic_heading">
                    <span class="white_dash_head_txt">
                         Enter Given Image Details Below
                      </span>
                    @if(isset($work_data))
                        {!! Form::open(['url' => 'save_work', 'class' => 'form-horizontal', 'id'=>'save_work', 'files'=>true]) !!}
                        <div class="col-sm-12">
                            {{--<div class='form-group'>--}}
                            <div class="image_container" id="image_box">
                                {{--                                @if(!file_exists(url('').'/'.$work_data->IMAGE_PATH))--}}
                                <img src="{{url('').'/'.$work_data->IMAGE_PATH}}" alt="" class="ads_img">
                                {{--@else--}}
                                {{--                                    @php(header("Location: /start_work"))--}}
                                {{--@endif--}}
                                {{--<img src="data:image/png;base64,{{ chunk_split(base64_encode($work_data->IMG)) }}" alt="" class="ads_img">--}}
                                <input type="hidden" value="{{$work_data->ID}}" name="data_id" id="data_id">
                            </div>
                            {{--</div>--}}

                            <div class="textbox_div">
                                <div class='form-group'>
                                    {!! Form::label('Name', 'Candidate Name *', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class='col-sm-8'>
                                        <input type="text" placeholder="Candidate Name*" maxlength="50" name="s_name"
                                               class="form-control required textWithSpace textUpper" id="s_name">
                                    </div>
                                </div>
                                <div class='form-group'>
                                    {!! Form::label('Username', 'Father Name *', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class='col-sm-8'>
                                        <input placeholder="Father Name*" maxlength="50" name="f_name"
                                               class="form-control required textWithSpace textUpper" id="f_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @else
                        <div class="col-sm-12">
                            <span>No Data Available</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <br/>
    <script>
        $(".textWithSpace").keypress(function () {
            if (event.keyCode == 8 || event.keyCode == 32) return true;
            if (!((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 97 && event.keyCode <= 122))) return false;
        });

        $('#s_name').keydown(function (e) {
            if (e.keyCode == 13) {
                if ($('#s_name').val() == '') {
                    warning_noti("Please enter candidate name");
                    $(this).focus();
                } else {
                    $('#f_name').focus();
                }
                e.preventDefault();
            }
        });
        $('#f_name').keydown(function (e) {
            if (e.keyCode == 13) {
                if ($('#s_name').val() == '') {
                    warning_noti("Please enter candidate name");
                    $('#f_name').focus();
                } else if ($('#f_name').val() == '') {
                    warning_noti("Please enter father name");
                    $('#f_name').focus();
                } else {
                    $('#save_work').submit();
                }
            }
        });
        //        $(document).keypress(function (event) {
        //            var keycode = (event.keyCode ? event.keyCode : event.which);
        //            if (keycode == '13') {
        ////                alert('You pressed a "enter" key in somewhere');
        //                $('#save_work').submit();
        //            }
        //        });
        window.onload = function () {
            document.getElementById("s_name").focus();
            $("#image_box").scrollTop(150);
        };
        //        $('#someTextBox').keypress(function(event){
        //            var keycode = (event.keyCode ? event.keyCode : event.which);
        //            if(keycode == '13'){
        //                alert('You pressed a "enter" key in textbox');
        //            }
        //        });

    </script>
@stop
