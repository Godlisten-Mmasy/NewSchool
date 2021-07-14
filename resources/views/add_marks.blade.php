@extends('layouts.app')

@section('title','Marks | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-scale"></samp> Marks
		</div>
		
		

		<div class="panel-body">
			@if (count($alerts))
				<div class="alert alert-success">
					{{ $alerts[0] }}
				</div>
			@endif


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
		<?php 
		$sn = 0; 
		foreach($classes as $class){
			$class->name = $class->name;
			$class->class_id = $class->class_id;
		}

		foreach($subjects as $subject){
			$subject->name = $subject->name;
			$subject->subject_id = $subject->subject_id;
		}
		?>

		<div style="padding:10px;">
			<font size="3">
				<a href="{{route('marks')}}">Marks</a>
			/ <samp>{{$class->name}}</samp>
			/ <samp>{{$subject->name}}</samp>
			</font>
		</div>


		<div id="importExcelForm">
			<form method="post" name='myform' action="{{route('import_result')}}"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="well" class="form-group">
            <table class="table">
            <tr>
                <td width="40%" align="right"><label>select file to upload</label></td>
                <td width="30">
                <input type="file" id="upload" name="select file" />
                </td>
                <td width="30%" align="left">
                <input type="submit" name="upload" onmouseover="//validate()"  onclick="validate()" class="btn btn-primary" value="upload">
                </td>
                </tr>
                <tr>
                    <td width="40%" align="right"></td>
                    <td width="30%"><span class="text-muted">
                    .xls, .xslx</span></td>
                    <td width="40%" align="right"></td>
                </tr>
				<script>

				function validate(){
					// alert(document.forms['myform']['select file']['name'].value);
					var fullPath = document.getElementById('upload').value;
					if (fullPath) {
						var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
						var filename = fullPath.substring(startIndex);
						if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
							filename = filename.substring(1);
						}
						ext = filename.split('.').pop();
						if(ext.toLowerCase()!='xls' && ext.toLowerCase()!='xlsx'){
							alert('File not accepted!');
							history.back();
						}
					}else{
						alert('Select File To Upload!');
						history.back();
					}
				}
				</script>
            </table>
        </div>
    </form>
			</div>

		<div>
			<form method="post" action="{{route('marks_students_submit')}}">

			<input type="" value="{{$class->class_id}}" name="class" hidden>
			<input type="" value="{{$subject->subject_id}}" name="subject" hidden>
			@csrf
			<table width="100%" class="table-striped" border="1">
				<tr>
					<th colspan="5"><center>{{$class->name}} | {{$subject->name}}</center></th>
				</tr>
				<tr>
					<td colspan="6">

					<input style="float:right;" class="btn btn-primary" type="submit" value="submit">
					 </td>
				</tr>
				<tr>
					<th>SN.</th>
					<th>Student Name</th>
					<th>Score</th>
				</tr>
				
				<?php
				$result_array = array();
				if (count($results)>0) {
					foreach ($results as $result) {
						$result_array[$result->student_id] = $result->score;
					}
				}
				?>
				@foreach($students as $student)
				<tr>
					<td><?php echo $sn+=1; ?></td>
					<td>
					{{$student->fname}}
					{{$student->sname}}
					{{$student->tname}}
					</td>
					<td>

						<input class="form-control" type="number" min="0" max="100" value="<?php echo @$result_array[$student->student_id]; ?>" name="score_{{$sn}}" placeholder="Score" required>
						<input type="" value="{{$student->student_id}}" name="student_id_{{$sn}}" hidden>
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="6">

					<input name="student_num" type="text" value="{{$sn}}" hidden>
					<input style="float:right;" class="btn btn-primary" type="submit" value="submit">
					 </td>
				</tr>
			</table>
			{{$students->links()}}
			</form>
		</div>
		<hr>
		<!-- <div class="well">
		<a href="#">Download Sample Excel</a>
		</div> -->
		</div>
	</div>
@endsection			
