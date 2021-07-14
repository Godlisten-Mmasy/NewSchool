@extends('layouts.app')

@section('title','Teachers | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Teachers</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgteachers')}}">Update Teachers</a>
			</samp>
		</div>
		<div class="panel-body">
			<div>
				<a href="{{route('management')}}">Management</a> /
				<a href="{{route('mgteachers')}}">Teachers</a>
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


				@foreach($teachers as $teacher)
					<?php 
					if (!empty($_REQUEST["id"])) {
					$id = $teacher->teacher_id; 
					$fname = $teacher->fname; 
					$sname = $teacher->sname; 
					$tname = $teacher->tname; 
					$email = $teacher->email; 
					$phone = $teacher->phone; 
					}else{
						$fname = ''; 
						$sname = ''; 
						$tname = ''; 
						$email = ''; 
						$phone = ''; 
					}
					?>
				@endforeach
				<form class="inner-form" action="{{route('edit_mgteachers_submit')}}" method="post">
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
						<label for="">Email: </label>
						<input class="form-control" type="text" name="email" value="{{$email}}" placeholder="Email" required>
					</div>
					<div>
						<label for="">Phone: </label>
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
