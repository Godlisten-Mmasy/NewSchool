@extends('layouts.app')

@section('title','Students | SCHOOL MANAGEMENT SYSTEM(SMS)')

@section('content')
<div class="panel panel-default">
		<div class="panel-heading" id="panel_heading">
			<samp class="glyphicon glyphicon-education"></samp> Students</samp>

			<samp style="float:right; margin-top:-5px;">
				<a class="btn btn-success" href="{{route('add_mgstudents')}}">Add Students</a>
			</samp>
			<!-- <samp style="float:right; margin-top:-5px;">
				<div class="btn btn-success" onClick="  var el =document.getElementById('importExcelForm'); el.style.hidden = false; ">import file</div>
			</samp> -->
		</div>
		<div class="panel-body">
			<div class="panel">
				<a href="{{route('management')}}">Management</a> /
				<a href="{{route('mgstudents')}}">Students</a>
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
			<div id="importExcelForm">
			<form method="POST" action="{{route('import_student')}}"
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
                <input type="submit" name="upload" onmouseover="//validate()" onclick="validate()" class="btn btn-primary" value="upload">
                </td>
                </tr>
                <tr>
                    <td width="40%" align="right"></td>
                    <td width="30%"><span class="text-muted">
                    .xls, .xslx</span></td>
                    <td width="40%" align="right"></td>
                </tr>
            </table>

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
        </div>
    </form>
			</div>
				<div>
					<table class="table table-striped">
						<tr>
							<th>Sn</th>
							<th colspan="3">Names</th>
							<th>Class</th>
							<th>Parent phone</th>
							<th>Controls</th>
						</tr>
						<?php $sn = 0; ?>
						@foreach($students as $student)
						<?php $sn+=1; ?>
						<tr>
							<td>{{$sn}}</td>
							<td>{{$student->fname}}</td>
							<td>{{$student->sname}}</td>
							<td>{{$student->tname}}</td>
							<td>{{$student->name}}</td>
							<td>{{$student->phone}}</td>
							<td>
								<a class="btn btn-sm btn-info" href="{{route('edit_mgstudents')}}?id={{$student->student_id}}">Edit</a>
								<a class="btn btn-sm btn-danger" href="{{route('delete_mgstudents')}}?id={{$student->student_id}}">Delete</a>
							</td>
						</tr>
						@endforeach
					</table>
					{{$students->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
