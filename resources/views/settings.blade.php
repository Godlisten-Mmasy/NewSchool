@extends('layouts.app')

@section('title','Settings | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-lock"></samp> Change Password
		</div>
		<div class="panel-body">

		
		@if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
		<form class="inner-form" method="post" action="{{ route('passwordchange') }}">
		{{ csrf_field() }}
			<div>
				<input class="form-control" type="password" name="current-password" value="<?php echo @$_REQUEST['current-password']; ?>" placeholder="Enter Old Password">
			

				@if ($errors->has('current-password'))
                <span class="help-block">
                    <strong>{{ $errors->first('current-password') }}</strong>
                </span>
            	@endif
			</div>
			<div>
				<input class="form-control" type="password" name="new-password" placeholder="Enter New Password">
			

				@if ($errors->has('new-password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                @endif
			</div>
			<div>
				<input class="form-control" type="password" name="new-password_confirmation" placeholder="Retype New Password">
				
			</div>
			<div>
				<input class="btn btn-success" type="submit" value="Save Changes">
			</div>
		</form>
	</div>
	</div>
@endsection