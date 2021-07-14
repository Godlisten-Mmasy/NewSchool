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
			<div class="panel">
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

				<div>
					<table class="table table-striped">
						<tr>
							<th>Sn</th>
							<th colspan="3">Subject Names</th>
						</tr>
						<?php $sn = 0; ?>
						@foreach($subjects as $subject)
						<?php $sn+=1; ?>
						<tr>
							<td>{{$sn}}</td>
							<td>{{$subject->name}}</td>
							<td>
								<a class="btn btn-sm btn-info" href="{{route('edit_mgsubjects')}}?id={{$subject->subject_id}}">Edit</a>
								<a class="btn btn-sm btn-danger" href="{{route('delete_mgsubjects')}}?id={{$subject->subject_id}}">Delete</a>
							</td>
						</tr>
						@endforeach
					</table>
					{{$subjects->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
