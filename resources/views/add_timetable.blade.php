@extends('layouts.app')

@section('title','Timetable | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
		<samp><samp class="glyphicon glyphicon-scale"></samp> Add Timetable</samp>
		</div>
		
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
		<div class="panel-body">

		
		@if (!empty($alerts['error']))
				<div class="alert alert-danger">
					{{ $alerts['error'] }}
				</div>
			@endif
		
		@if (!empty($alerts['success']))
			<div class="alert alert-success">
				{{ $alerts['success'] }}
			</div>
		@endif
		<div>
			<form method="post" name="myforms" action="{{route('add_timetable_submit')}}" class="inner-form">
				@csrf

				
				<div>
					<label>Teachers: </label>
					<select class="form-control" name="teacher_id" required>
						<option value="">Choose Teacher</option>
						@foreach($teachers as $teacher)
						@if($teacher->teacher_id==@$_POST['teacher_id'])
						<option value="{{$teacher->teacher_id}}" selected>{{$teacher->fname}} {{$teacher->sname}} {{$teacher->tname}}</option>
						@else
						<option value="{{$teacher->teacher_id}}">{{$teacher->fname}} {{$teacher->sname}} {{$teacher->tname}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div>
				
					<label>Subject: </label>
					<select class="form-control" name="subject_id" required>
						<option value="">Choose Subject</option>
						@foreach($subjects as $subject)
						@if($subject->subject_id==@$_POST['subject_id'])
						<option value="{{$subject->subject_id}}" selected>{{$subject->name}}</option>
						@else
						<option value="{{$subject->subject_id}}">{{$subject->name}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div>
					<label>Day: </label>
					<select class="form-control" name="day" required>
						<option value="">Choose Day</option>
						<?php 
						$days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
						for($x=0;$x<count($days);$x++){ ?>
							@if($days[$x]==@$_POST['day'])
							<option value="<?php echo $days[$x]; ?>" selected><?php echo $days[$x]; ?></option>
							@else
							<option value="<?php echo $days[$x]; ?>"><?php echo $days[$x]; ?></option>
							@endif
						<?php } ?>
					</select>
				</div>
				<div>
					<label>Class: </label>
					<select class="form-control" name="class_id" required>
						<option value="">Choose Class</option>
						@foreach($classes as $class)
						@if($class->class_id==@$_POST['class_id'])
						<option value="{{$class->class_id}}" selected>{{$class->name}}</option>
						@else
						<option value="{{$class->class_id}}">{{$class->name}}</option>
						@endif
						@endforeach
						
					</select>
				</div>
				<div id="time">
					<label>From: </label><br>
					<select class="form-control" name="time_hours" onchange="funcTime();" required>
						<option value="">Hour</option>
						<?php for($x=8;$x<=18;$x++){ if(strlen($x)==1){?>
							<option value="<?php echo "0".$x; ?>"><?php echo "0".$x; ?></option>
							<?php }else{ ?>
							<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
						<?php  }} ?>
					</select>
					<select class="form-control" name="time_minutes"onchange="funcTime();" required>
						<option value="">Minutes</option>
						<?php for($x=0;$x<=59;$x++){ if(strlen($x)==1){?>
							<option value="<?php echo "0".$x; ?>"><?php echo "0".$x; ?></option>
							<?php }else{ ?>
							<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
						<?php  }} ?>
					</select>
				</div>
				<div id="time">
				<label>To: </label><br>
				<div id="">
					<b>Hour: <span id="to_hours" class="btn btn-default"></span></b>
					<input type="hidden" class="form-control" name="to_hours" value="00">
					<b style="float:right;">Minute: <span id="to_minutes" class="btn btn-default"></span></b>
					<input type="hidden" class="form-control" name="to_minutes" value="00">
				</div>
				<script>
				if(parseInt(document.forms['myforms']['time_hours'].value)<0){
				document.getElementById('to_hours').innerHTML=document.forms['myforms']['time_hours'].value;
				document.getElementById('to_minutes').innerHTML=document.forms['myforms']['time_minutes'].value;
				}else{
					funcTime();
				}

				if(document.getElementById('to_hours').innerHTML=='NaN'){
					document.getElementById('to_hours').innerHTML = '';
				}
				if(document.getElementById('to_minutes').innerHTML=='NaN'){
					document.getElementById('to_minutes').innerHTML = '';
				}
				function funcTime(){
					to_hours = parseInt(document.forms['myforms']['time_hours'].value)+2;
					to_minutes = document.forms['myforms']['time_minutes'].value;
					document.forms['myforms']['to_hours'].value=to_hours;
					document.getElementById('to_hours').innerHTML=to_hours;
					document.forms['myforms']['to_minutes'].value=to_minutes;
					document.getElementById('to_minutes').innerHTML=to_minutes;
				}
				</script>
				</div>
				<style type="text/css">
					#time select{
						display: inline-block;
						width:49.0%;
					}
					#time input{
						display: inline-block;
						width:49.2%;
					}
				</style>
				<div>
					<input class="btn btn-primary" type="submit" value="Submit">
				</div>
				</form>
		</div>
		</div>
	</div>
@endsection			
