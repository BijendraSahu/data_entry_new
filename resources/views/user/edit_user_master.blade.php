<script src="{{ url('assets/js/validation.js') }}"></script>

@if(!is_null($user_master))
    {!! Form::open(['url' => 'user_master/'.$user_master->id, 'class' => 'form-horizontal', 'id'=>'user_master', 'method'=>'put', 'files'=>true]) !!}
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('role', 'Role *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-8'>
                    @if($_SESSION['admin_master']['role'] == 'Super Admin')
                        <select name="role" id="role_master_id" class="form-control requiredDD">
                            <option value="0">Select Role</option>
                            <option {{$user_master->role == "Group Admin"?'selected':''}} value="Group Admin">Group Admin</option>
                            <option {{$user_master->role == "Quality Control"?'selected':''}} value="Quality Control">Quality Control</option>
                            <option {{$user_master->role == "Data Entry User"?'selected':''}} value="Data Entry User">Data Entry User</option>
                        </select>
                    @else
                        <select name="role" id="role_master_id" class="form-control requiredDD">
                            <option value="0">Select Role</option>
                            <option {{$user_master->role == "Data Entry User"?'selected':''}} value="Data Entry User">Data Entry User</option>
                        </select>
                    @endif
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('name', 'Name *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('name', $user_master->name, ['class' => 'form-control input-sm required','placeholder'=>'Name']) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('contact', 'Contact *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('contact', $user_master->contact, ['class' => 'form-control input-sm contact required', 'placeholder'=>'Contact','maxlength'=>10]) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('contact', 'Paytm No *', ['class' => 'col-sm-4 control-label']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('paytm', $user_master->paytm_no, ['class' => 'form-control input-sm contact required', 'placeholder'=>'Paytm No','maxlength'=>10]) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('contact', 'Email *', ['class' => 'col-sm-4 control-label']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('email', $user_master->email, ['class' => 'form-control input-sm email', 'placeholder'=>'Email','maxlength'=>50]) !!}
                </div>
            </div>
            <div class='form-group'>
                <div class='col-sm-offset-2 col-sm-8'>
                    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@else
    <h4>UserMaster not found !</h4>
@endif
<script>
    $(function () {
        $('.dtp').datepicker({
            format: "dd-M-yyyy",
            maxViewMode: 2,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>