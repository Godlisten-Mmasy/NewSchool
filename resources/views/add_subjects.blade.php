@extends('layouts.app')

@section('title','Subjects | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Subjects</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgsubjects')}}">Add Subjects</a>
			</samp>
		</div>
		<div class="panel-body">
			<div>
				<a href="{{route('management')}}">Management</a> /
				<a href="{{route('mgsubjects')}}">Subjects</a>
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

				<form class="inner-form" action="{{route('add_mgsubjects_submit')}}" method="post">
					@csrf
					<div>
						<label for="">Name: </label>
						<input class="form-control" type="text" name="name" value="" placeholder="Name" required>
					</div>
					<div>
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
