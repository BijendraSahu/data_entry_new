<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>

{!! Form::open(['url' => 'update_show_work', 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post']) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="district">Select Districts:</div>
        </div>
        <div class="col-sm-10">
            @php
               $string = "$work_data->districtid";
               $str_arr = explode (",", $string);
            @endphp
            <select name="district_ids[]" class="Glo_autocomplete" style="width:100%" multiple id="district_id">
                @foreach($district as $distri)
                    <option value="{{$distri->id}}" {{in_array($distri->id, $str_arr) ? 'selected':''}} >{{$distri->districtname}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
<link rel="stylesheet" href="{{url('assets/css/Autocomplete.css')}}"/>
<script src="{{url('assets/js/Autocomplete.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.Glo_autocomplete').select2();
    });
</script>