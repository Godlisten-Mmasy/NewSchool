@extends('layouts.app')

@section('title','Students | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Students</samp>

			<!-- <samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgstudents')}}">Update Students</a>
			</samp> -->
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


				@foreach($students as $student)
					<?php 
					if (!empty($_REQUEST["id"])) {
					$id = $student->student_id; 
					$fname = $student->fname; 
					$sname = $student->sname; 
					$tname = $student->tname; 
					$class = $student->class; 
					$phone = $student->phone; 
					}else{
						$fname = ''; 
						$sname = ''; 
						$tname = ''; 
						$class = ''; 
						$phone = ''; 
					}
					?>
				@endforeach
				<form class="inner-form" action="{{route('edit_mgstudents_submit')}}" method="post">
					@csrf
					<input type="hidden" name="id" value="{{$id}}" id="">
					<div>
						<label for="">First Name: </label>
						<input class="form-control" type="text" name="fname" value="{{$fname}}" placeholder="First Name" required>
					</div>
					<div>
						<label for="">Second Name: </label>
						<input class="form-control" type="text" name="sname" value="{{$sname}}" placeholder="Second Name" required>
					</div>
					<div>
						<label for="">Third Name: </label>
						<input class="form-control" type="text" name="tname" value="{{$tname}}" placeholder="Third Name" required>
					</div>
					<div>
						<label for="">Class: </label>
						<select name="class" class="form-control" id="" required>
							<option value="">Choose Class/Form</option>
							@foreach($classes as $classx)
							@if($class==$classx->class_id)
							<option value="{{$classx->class_id}}" selected>{{$classx->name}}</option>
							@else
							<option value="{{$classx->class_id}}">{{$classx->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div>
						<label for="">Parent Phone: </label>
						<input class="form-control" type="number" min="0600000000" max="0799999999" name="phone" value="{{$phone}}" placeholder="Phone" required>
					</div>
					<div>
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
