@extends('layouts.app')

@section('title','Profile | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-user"></samp> Profile | <samp class="text-warning">
				@if(!empty(Auth::user()->role))
				{{ strtoupper(Auth::user()->role) }}
				@else
				Teacher
				@endif
			</samp>
		</div>
		<div class="panel-body">
			<center>
			<samp class="text-warning badge">
				@if(!empty(Auth::user()->role))
				{{ strtoupper(Auth::user()->role) }}
				@else
				Teacher
				@endif
			</samp>
			<p class="text-primary"><font size="6"><b>{{ strtoupper(Auth::user()->name) }}</b></font></p>
			</center>
		</div>
	</div>
@endsection		
