@extends('layouts.app')

@section('title','Teachers | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp><samp class="glyphicon glyphicon-education"></samp> Teachers</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgteachers')}}">Add Teachers</a>
			</samp>
		</div>
		<div class="panel-body">
			<div class="panel">
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

				<div>
					<table class="table table-striped">
						<tr>
							<th>Sn</th>
							<th colspan="3">Names</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Controls</th>
							<th>Last Login</th>
						</tr>
						<?php $sn = 0; ?>
						@foreach($teachers as $teacher)
						<?php $sn+=1; ?>
						<tr>
							<td>{{$sn}}</td>
							<td>{{$teacher->fname}}</td>
							<td>{{$teacher->sname}}</td>
							<td>{{$teacher->tname}}</td>
							<td>{{$teacher->email}}</td>
							<td>{{$teacher->phone}}</td>
							<td>
								<a class="btn btn-sm btn-info" href="{{route('edit_mgteachers')}}?id={{$teacher->teacher_id}}">Edit</a>
								<a class="btn btn-sm btn-danger" href="{{route('delete_mgteachers')}}?id={{$teacher->email}}">Delete</a>
							</td>
							<td>{{$teacher->last_login}}</td>
						</tr>
						@endforeach
					</table>
					{{$teachers->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
