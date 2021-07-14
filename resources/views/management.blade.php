@extends('layouts.app')

@section('title','Management | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-dashboard"></samp> Management</samp>
		</div>

		<div class="items">
		<div class="panel panel-default">
			<div class="panel-body"><center><img width="170" height="170" src="/images/student.png" alt="No Image"></center></div>
			<div class="panel-heading" id="panel_heading" style="border:none; border-top:1px solid rgba(0,0,0,0.1); border-radius:none;"><center><a href="{{route('mgstudents')}}">Students</a></center>
			</div>
		</div>

		
		<div class="panel panel-default">
			<div class="panel-body"><center><img width="170" height="170" src="/images/teacher.png" alt="No Image"></center></div>
			<div class="panel-heading" id="panel_heading" style="border:none; border-top:1px solid rgba(0,0,0,0.1); border-radius:none;"><center><a href="{{route('mgteachers')}}">Teachers</a></center>
			</div>
		</div>

				
		<div class="panel panel-default">
			<div class="panel-body"><center><img width="170" height="170" src="/images/class.png" alt="No Image"></center></div>
			<div class="panel-heading" id="panel_heading" style="border:none; border-top:1px solid rgba(0,0,0,0.1); border-radius:none;"><center><a href="{{route('mgclasses')}}">Classes/Forms</a></center>
			</div>
		</div>

						
		<div class="panel panel-default">
			<div class="panel-body"><center><img width="170" height="170" src="/images/subject.png" alt="No Image"></center></div>
			<div class="panel-heading" id="panel_heading"><center><a href="{{route('mgsubjects')}}">Subjects</a></center>
			</div>
		</div>
<!-- 
						
		<div class="panel panel-default">
			<div class="panel-body"><center><img width="170" height="170" src="/images/tanzania.jpeg" alt="No Image"></center></div>
			<div class="panel-heading" id="panel_heading"><center><a href="{{route('mgsubjects')}}">Teachers-Subjects</a></center>
			</div>
		</div> -->
		</div>

		<style>
			.items .panel-default{
				width: 210px; 
				padding:0px; 
				margin: 10px;
				display:inline-block;
			}

			.items #panel_heading{
				border:none; 
				border-top:1px solid rgba(0,0,0,0.1); 
				border-radius:none;
			}

			.items .panel-default img{
				opacity: 0.2;
			}
		</style>
	</div>
@endsection
