@extends('layouts.app')

@section('title','Classes | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Classes</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgclasses')}}">Add Classes</a>
			</samp>
		</div>
		<div class="panel-body">
			<div class="panel">
				<a href="{{route('management')}}">Management</a> /
				<a href="{{route('mgclasses')}}">classes</a>
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
							<th colspan="1">Class Names</th>
							<th colspan="1">Class Teacher</th>
							<th></th>
							<th></th>
						</tr>
						<?php $sn = 0; ?>
						@foreach($classes as $class)
						<?php $sn+=1; ?>
						<tr>
							<td>{{$sn}}</td>
							<td>{{$class->name}}</td>
							<td>{{$class->fname}} {{$class->tname}}</td>
							<td><a class="" href="{{route('mgclasses_students')}}?search={{$class->name}}">View Students</a></td>
							<td>
								<a class="btn btn-sm btn-info" href="{{route('edit_mgclasses')}}?id={{$class->class_id}}">Edit</a>
								<a class="btn btn-sm btn-danger" href="{{route('delete_mgclasses')}}?id={{$class->class_id}}">Delete</a>
							</td>
						</tr>
						@endforeach
					</table>
					{{$classes->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
