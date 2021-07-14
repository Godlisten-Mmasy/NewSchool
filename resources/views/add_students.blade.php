@extends('layouts.app')

@section('title','Students | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Students</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgstudents')}}">Add Students</a>
			</samp>
		</div>
		<div class="panel-body">
			<div>
				<a href="{{route('management')}}">Management</a> /
				<a href="{{route('mgstudents')}}">Students</a>
			</div>
			<div>
			
		
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
				<form class="inner-form" action="{{route('add_mgstudents_submit')}}" method="post">
					@csrf
					<div>
						<label for="">First Name: </label>
						<input class="form-control" type="text" name="fname" value="" placeholder="First Name" required>
					</div>
					<div>
						<label for="">Middlename: </label>
						<input class="form-control" type="text" name="sname" value="" placeholder="Middlename" required>
					</div>
					<div>
						<label for="">Surnameame: </label>
						<input class="form-control" type="text" name="tname" value="" placeholder="Surnameame" required>
					</div>
					
					
					<div>
						<label for="">Class: </label>
						<select name="class_id" class="form-control" id="">
							<option value="">Choose Class/Form</option>
							@foreach($classes as $class)
							<option value="{{$class->class_id}}">{{$class->name}}</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="">Parent Phone: </label>
						<input class="form-control" type="number" name="phone" min="0600000000" max="0799999999" value="" placeholder="Phone Example[0760222333]" required>
					</div>
					<div>
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
