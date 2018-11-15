<script src="{{ url('assets/js/validation.js') }}"></script>
<style>
    .ads_img {
        height: 100%;
        width: 100%;
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
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
<div class="container-fluid">
    <div class="container-fluid">
        {!! Form::open(['url' => 'save_work', 'class' => 'form-horizontal', 'id'=>'save_work', 'files'=>true]) !!}
        <div class="col-sm-12">
            {{--<img src="{{url('').'/'.$work_data->FILENM}}" alt="" class="ads_img">--}}
            <div class="image_container" id="image_box">
                <img src="{{url('').'/'.$work_data->IMAGE_PATH}}" alt="" class="ads_img">
            </div>
            {{--<div class="textbox_div">--}}
            {{--<div class='form-group'>--}}
            {{--{!! Form::label('Name', 'Stu. Name :', ['class' => 'col-sm-4 control-label']) !!}--}}
            {{--<div class='col-sm-8'>--}}
            {{--{!! Form::label('Name', isset($work_data)?$work_data->f103:'') !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class='form-group'>--}}
            {{--{!! Form::label('Username', "F'Name :", ['class' => 'col-sm-4 control-label']) !!}--}}
            {{--<div class='col-sm-8'>--}}
            {{--{!! Form::label('Username', isset($work_data)?$work_data->f104:'') !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <input type="hidden" value="{{$work_data->ID}}" name="data_id" id="data_id">
            <input type="hidden" value="1" name="edit_data_id" id="data_id">
            <div class="textbox_div">
                <div class='form-group'>
                    {!! Form::label('Name', 'Candidate Name *', ['class' => 'col-sm-4 control-label']) !!}
                    <div class='col-sm-8'>
                        {!! Form::label('Name', isset($work_data)?$work_data->f103:'') !!}
                        <input type="text" placeholder="Candidate Name*" maxlength="50" name="s_name"
                               class="form-control required textWithSpace textUpper" id="s_name"
                               value="{{isset($work_data)?$work_data->f103:''}}">
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('Username', 'Father Name *', ['class' => 'col-sm-4 control-label']) !!}
                    <div class='col-sm-8'>
                        {!! Form::label('Username', isset($work_data)?$work_data->f104:'') !!}
                        <input placeholder="Father Name*" maxlength="50" name="f_name"
                               class="form-control required textWithSpace textUpper"
                               value="{{isset($work_data)?$work_data->f104:''}}" id="f_name">
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
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
    window.onload = function () {
        document.getElementById("s_name").focus();
        $("#image_box").scrollTop(150);
    };
</script>