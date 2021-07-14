@extends('layouts.app')

@section('title','Results | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Results
		</div>
		<div class="panel-body">
		
			<?php
			function grade($grade){
				if ($grade>=80) {
					echo "A";
				}else if ($grade>=70) {
					echo "B";
				}else if ($grade>=60) {
					echo "C";
				}else if ($grade>=40) {
					echo "D";
				}else if ($grade>=30) {
					echo "E";
				}else {
					echo "F";
				}
			}
			?>
			<center>
				<form class="inner-form" name="Form">
				<div>
					<!-- <label>Subject: </label> -->
					<!-- Dont delete this line of subject -->
					<select name="subject" class="form-control" id="" style="display:none;" onchange="redirectFuncSubject()" >
						<option value="">Choose Subject</option>
						@foreach($subjects as $subject)
						@if($subject->subject_id==@$_REQUEST["subject_id"])
						<option value="{{$subject->subject_id}}" selected>{{$subject->name}}</option>
						@else
						<option value="{{$subject->subject_id}}">{{$subject->name}}</option>
						@endif
						@endforeach
					</select>
					<label>Class: </label>
					<select name="class" class="form-control" id="" onchange="redirectFuncClass()">
						<option value="">Choose Subject</option>
						@foreach($classes as $class)
						@if($class->class_id==@$_REQUEST["class_id"])
						<option value="{{$class->class_id}}" selected>{{$class->name}}</option>
						@else
						<option value="{{$class->class_id}}">{{$class->name}}</option>
						@endif
						@endforeach
					</select>
					<label>Student: </label>
					<select name="student" class="form-control" id="" onchange="redirectFuncStudent()">
						<option value="">Choose Student</option>
						@foreach($students as $student)
						@if($student->student_id==@$_REQUEST["student_id"])
						<option value="{{$student->student_id}}" selected>{{$student->id}} | {{$student->fname}} {{$student->sname}} {{$student->tname}}</option>
						@else
						<option value="{{$student->student_id}}">{{$student->id}} | {{$student->fname}} {{$student->sname}} {{$student->tname}}</option>
						@endif
						@endforeach
					</select>
						<script>
						function redirectFuncSubject(){
							var subject_id = document.forms["Form"]["subject"].value;
							var class_id = document.forms["Form"]["class"].value;
							var student_id = document.forms["Form"]["student"].value;
							window.location.replace("<?php echo $_SERVER["PHP_SELF"]; ?>?subject_id="+subject_id+
							"&class_id="+class_id+
							"&student_id="+student_id);
						}
						function redirectFuncClass(){
							var subject_id = document.forms["Form"]["subject"].value;
							var class_id = document.forms["Form"]["class"].value;
							var student_id = document.forms["Form"]["student"].value;
							window.location.replace("<?php echo $_SERVER["PHP_SELF"]; ?>?class_id="+class_id+
							"&class_id="+class_id+
							"&student_id=");
						}
						function redirectFuncStudent(){
							var subject_id = document.forms["Form"]["subject"].value;
							var class_id = document.forms["Form"]["class"].value;
							var student_id = document.forms["Form"]["student"].value;
							window.location.replace("<?php echo $_SERVER["PHP_SELF"]; ?>?subject_id="+subject_id+
							"&class_id="+class_id+
							"&student_id="+student_id);
						}
						</script>
				</div>
				</form><br>
				@if(!empty($_REQUEST["class_id"]) && !empty($_REQUEST["student_id"]))
				<table width="100%" class="table-striped" border="1">
						<tr>
							<th colspan="5"><b> 
							<?php if(count($results)>0){ ?>
							@foreach($results as $result)
							@endforeach
							<p>Name: {{$result->fname}} {{$result->sname}} {{$result->tname}}</p>
							<p>Phone: {{$result->phone}}</p>
							@foreach($students as $student)
							@if($student->student_id==$_REQUEST["student_id"])
							<p>Student ID {{$student->id}}</p>
							@endif
							@endforeach
							<?php
							}else{
							?>
							<p class="text-warning">No results this student</p>
							<?php
							} ?>
							</b>
							</th>
						</tr>
						<tr>
							<th>Subject</th>
							<th>Score</th>
							<th>Grade</th>
						</tr>
						<?php $sum = 0; $count = 0; ?>
						@foreach($results as $result)
						@foreach($subjects as $subject)
						@if($result->subject_id==$subject->subject_id)
						<?php $sum+=$result->score; $count++; ?>
						<tr>
							<td>{{$subject->name}}</td>
							<td>{{$result->score}}</td>
							<td><?php echo grade($result->score); ?></td>
						</tr>
						@endif
						@endforeach
						@endforeach

						<tr>
						<th>Average</th>
						<td>
						<?php echo (round($sum/$count)); ?>
						</td>
						</tr>
				</table>
				@endif
			</center>
		</div>
	</div>
@endsection