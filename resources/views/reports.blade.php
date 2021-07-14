@extends('layouts.app')

@section('title','Reports | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-envelope"></samp> Reports
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
		<?php if(empty($_REQUEST["class_name"])): ?>
		<ul class="list-group">
			@foreach($classes as $class)
			@if(strtolower($class->name))
			<li class="list-group-item"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?class_name={{strtoupper($class->name)}}&class_id={{strtolower($class->class_id)}}">{{strtoupper($class->name)}}</a></li>
			@endif
			@endforeach
		</ul>
		<?php else: ?>
		<div style="padding:10px;">
			<font size="3">
				<a href="?#">Reports</a>
			> <samp><?php echo $_REQUEST["class_name"]; ?></samp>
			</font>
		</div>

		

			<table width="100%" class="table-striped" border="1">
				<tr>
					<th>SN</th>
					<th>Name</th>
					@foreach($subjects as $subject)
					<td>{{$subject->name}}</td>
					@endforeach
					<td>Total Score</td>
				</tr>
				

				<?php $sn = 0; ?>
				@foreach($students as $student)
				<?php $sn++; ?>
				<tr>
					<td>{{$sn}}</td>
					<td>{{$student->fname}} {{$student->sname}} {{$student->tname}}</td>

					@foreach($subjects as $subject)
					<td>

					@foreach($results as $result)
					@if($subject->subject_id==$result->subject_id && $result->student_id==$student->student_id)
					@if($result->result_status!="null")
					{{$result->score}}
					@endif
					@endif
					@endforeach

					</td>
					@endforeach
					<td>{{$student->total_score}}</td>
					
				</tr>
				@endforeach
				@if(count($students)>0)
				@endif
			</table>

			<center style="margin-top:10px;">
				<table>
				<tr>
				<td>
				<form action="{{route('send_reports')}}" method="post">
					@csrf
					<input type="text" name="class_id" value="{{$_REQUEST['class_id']}}" id="" hidden>
					<div>
					<button class="btn btn-primary">SEND REPORTS TO PARENTS</button>
					</div>
				</form>
				</td>
				<td>
				<form action="{{route('export_excel_results')}}" method="get">
					@csrf
					<input type="text" name="class_name" value="{{@$_REQUEST['class_name']}}" id="" hidden>
					<input class="btn btn-primary" type="submit" value="DOWNLOAD EXCEL RESULTS">
				</form>
				</td>
				</tr>
				</table>
			</center>
		<?php endif ?>
		</div>
	</div>
@endsection
