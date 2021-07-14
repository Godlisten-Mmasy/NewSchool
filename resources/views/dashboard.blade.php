@extends('layouts.app')

@section('title','Dashboard | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-dashboard"></samp> Dashboard</samp>
			<span id="txt" style="float:right;"></span>
		</div>
		<div class="panel-body">
			<div class="row">
			@if(Auth::user()->role!="Head Master")
				<div class="col-sm-6">
					<table class="table striped well">

					<tr>
					<th colspan="4"><samp class="text-primary">Timetables</samp></th>
					</tr>
					@foreach($timetables as $timetable)
					<tr>
					<td>{{$timetable->name}}</td>
					@foreach($subjects as $subject)
						@if($subject->subject_id==$timetable->subject_id)
						<td>{{$subject->name}}</td>
						@endif
					@endforeach
					<td>{{$timetable->day}}</td>
					<td>{{$timetable->time}}</td>
					</tr>
					@endforeach
					</table>
				</div>
				<div class="col-sm-6">
					<table class="table striped well">
					<tr>
					<th colspan="4"><samp class="text-primary" style="float:right; margin-right:20%;">Your Subjects</samp></th>
					</tr>
					@foreach($timetables as $timetable)
					<tr>
					<td>{{$timetable->name}}</td>
					@foreach($subjects as $subject)
						@if($subject->subject_id==$timetable->subject_id)
						<td>{{$subject->name}}</td>
						@endif
					@endforeach
					<!-- <td>{{$timetable->day}}</td>
					<td>{{$timetable->time}}</td> -->
					</tr>
					@endforeach
					</table>
				</div>
			@else
			<!-- <div class="col-sm-2 well">
			Admin
			</div> -->
			@endif
			</div>
			<style>
			.mypan{
				margin:1px;
			}
			</style>
			<script>
			window.onload=function(){getTime();}  
				function getTime(){  
				var today=new Date();  
				var h=today.getHours();  
				var m=today.getMinutes();  
				var s=today.getSeconds();  
				var day=today.getDate();  
				var month=today.getMonth()+1;  
				var year=today.getFullYear(); 
				// add a zero in front of numbers<10  
				m=checkTime(m);  
				s=checkTime(s);  
				document.getElementById('txt').innerHTML=day+'/'+month+'/'+year+'	'+h+":"+m+":"+s;  
				setTimeout(function(){getTime()},1000);  
				}  
				//setInterval("getTime()",1000);//another way  
				function checkTime(i){  
				if (i<10){  
				i="0" + i;  
				}  
				return i;  
			} 
			</script>

		</div>
	</div>
@endsection
