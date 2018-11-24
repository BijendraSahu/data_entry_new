<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'paynow/'.$user_id, 'class' => 'form-horizontal', 'id'=>'user_master']) !!}
<div class="container-fluid">
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class='form-group'>
                {!! Form::label('name', 'Paytm No', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    <b class="txt">{{isset($user->paytm_no)?$user->paytm_no:'N/A'}}</b>
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('name', 'Work Done', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    <b class="txt">{{$work_count}}</b>
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('pay_for', 'Pay For *', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    <input type="text" name="pay_for" class="form-control input-sm numberOnly required"
                           onkeyup="getrateamt()" value="{{$work_count}}" maxlength="6" placeholder="Pay For"
                           id="pay_for">
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('rate', 'Rate *', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    {{--                    {!! Form::text('rate', null, ['class' => 'form-control input-sm amount required', 'placeholder'=>'Rate','maxlength'=>6]) !!}--}}
                    <input type="text" name="rate" class="form-control input-sm amount required"
                           onkeyup="getrateamt()" id="rate" placeholder="Rate" value="0.25">
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('contact', 'Payable Amount *', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('payable_amount', null, ['class' => 'form-control hidden input-sm','id'=>'payable_amt','placeholder'=>'payable','maxlength'=>6]) !!}
                    <label for="payable" id="payable">0</label>
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('remark', 'Remark *', ['class' => 'col-sm-3 text-right']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('remark', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Remark']) !!}
                </div>
            </div>
            <div class='form-group'>
                <div class='col-sm-offset-3 col-sm-8'>
                    {!! Form::submit('Paid', ['class' => 'btn btn-sm btn-primary']) !!}
                </div>
            </div>
        </div>
        {{--<div class="col-sm-6">--}}
        {{--<h3 class="bg-danger text-center">Login Info</h3>--}}
        {{--<p class="clearfix"></p>--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('role', 'Role *', ['class' => 'col-sm-3 control-label']) !!}--}}
        {{--<div class='col-sm-8'>--}}
        {{--                    {!! Form::select('role_master_id', $role_masters, null,['class' => 'form-control requiredDD']) !!}--}}
        {{--@if($_SESSION['admin_master']['role'] == 'Super Admin')--}}
        {{--<select name="role" id="role_master_id" class="form-control requiredDD">--}}
        {{--<option value="0">Select Role</option>--}}
        {{--<option value="Group Admin">Group Admin</option>--}}
        {{--<option value="Quality Control">Quality Control</option>--}}
        {{--<option value="Data Entry User">Data Entry User</option>--}}
        {{--</select>--}}
        {{--@else--}}
        {{--<select name="role" id="role_master_id" class="form-control requiredDD">--}}
        {{--<option value="0">Select Role</option>--}}
        {{--<option value="Data Entry User">Data Entry User</option>--}}
        {{--</select>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class='form-group'>--}}
        {{--{!! Form::label('username', 'Username *', ['class' => 'col-sm-2 control-label']) !!}--}}
        {{--<div class='col-sm-8'>--}}
        {{--{!! Form::text('username', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Username']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class='form-group'>--}}
        {{--{!! Form::label('password', 'Password *', ['class' => 'col-sm-2 control-label']) !!}--}}
        {{--<div class='col-sm-8'>--}}
        {{--{!! Form::text('password', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Password']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class='form-group'>--}}
        {{--<div class='col-sm-offset-4 col-sm-8'>--}}
        {{--{!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
    $(document).ready(function () {
        getrateamt();
    });
    function getrateamt() {
        gAmount = 0;
        var pay_for = $('#pay_for').val();
        var amount = $('#rate').val();
        gAmount = (parseFloat(pay_for) * parseFloat(amount)).toFixed(2);
        $('#payable').text(parseFloat(gAmount));
        $('#payable_amt').val(parseFloat(gAmount));
    }
</script>
