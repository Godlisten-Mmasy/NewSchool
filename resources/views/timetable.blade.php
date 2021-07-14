@extends('layouts.app')

@section('title','Timetable | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp><samp class="glyphicon glyphicon-time"></samp> Time Table</samp>

			@if(!empty(Auth::user()->role))
			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_timetable')}}">Add Timetable</a>
			</samp>
			@endif
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
			<center>
				<br>
				<table width="100%" class="table-striped" border="1">
					<tr>
						<th>No</th>
						<th>Name of Teacher</th>
						<th>Class</th>
						<th>Subject</th>
						<th>Day</th>
						<th>Time</th>
						@if(!empty(Auth::user()->role))
						<th>Controls</th>
						@endif
					</tr>
					<?php $sn = 0; ?>
					@foreach($timetables as $timetable)
					<?php $sn++; ?>
					<tr>
						<td>{{$sn}}</td>
						<td>{{$timetable->fname}} {{$timetable->sname}} {{$timetable->tname}}</td>
						<td>{{$timetable->name}}</td>
						@foreach($subjects as $subject)
						@if($subject->subject_id==$timetable->subject_id)
						<td>{{$subject->name}}</td>
						@endif
						@endforeach
						<td>{{$timetable->day}}</td>
						<td>{{$timetable->time}}-{{$timetable->to_time}}</td>
						@if(!empty(Auth::user()->role))
						<td>
							<a class="btn btn-sm btn-info" href="{{route('edit_timetable')}}?id={{$timetable->timetable_id}}">Edit</a>
							<a class="btn btn-sm btn-danger" href="{{route('delete_timetable')}}?id={{$timetable->timetable_id}}">Delete</a>
						</td>
						@endif
					</tr>
					@endforeach
				</table>
			</center>
		</div>
	</div>
@endsection		
