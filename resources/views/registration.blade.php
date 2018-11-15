<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'registration', 'class' => 'form-horizontal', 'id'=>'user_master', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="container-fluid">
        <div class="col-sm-12">

            <div class='form-group' id="file_link">
                {!! Form::label('Name', 'Name *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="text" placeholder="Name" maxlength="25" name="name"
                           class="form-control required abc textWithSpace"
                           id="name">
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('Username', 'User Name *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="text" placeholder="Username" maxlength="25" name="username"
                           class="form-control required abc"
                           id="username">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('text', 'Password *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="password" placeholder="Password" maxlength="25" name="password"
                           class="form-control required abc" id="password">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('text', 'Contact *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="text" placeholder="Contact" maxlength="10" name="contact"
                           class="form-control contact required abc numberOnly" id="contact">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('text', 'Paytm No *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="text" placeholder="Paytm No" maxlength="10" name="paytm_no"
                           class="form-control contact required abc numberOnly" id="p_contact">
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('text', 'Email *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <input type="text" placeholder="Email" maxlength="50" name="email"
                           class="form-control required email" id="email">
                </div>
            </div>

            <div class='form-group' id="file_link">
                {!! Form::label('file_path', 'Select Profile', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    {!! Form::file('file_path', null, ['class' => 'form-control input-sm' ,'id'=>'file_path']) !!}
                </div>
            </div>

            <div class='form-group'>
                <div class='col-sm-offset-2 col-sm-10'>
                    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
    $("form").attr('autocomplete', 'off');
</script>

