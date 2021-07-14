<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
	    @include('layouts.links')
	</head>
    <body class="font-sans antialiased">
	<div class="">
		<div class="row-1">
			<center>
				<font size="45">
					<samp class="glyphicon glyphicon-user main-icon"></samp>
				</font> 
				<br><samp>{{ strtoupper(Auth::user()->name) }}</samp> |
				@if(!empty(Auth::user()->role))
				<samp class="text-default" style="color:rgba(255,255,255,0.5);">{{ strtoupper(Auth::user()->role) }}</samp>
				<!-- <br><span class="text-default" style="color:rgba(255,255,255,0.5);">Last Login {{Auth::user()->last_login}}</span> -->
				@else
				<samp class="text-default" style="color:rgba(255,255,255,0.5);">Teacher</samp>
				@endif
			</center>
			<div class="main-top">
				<a href="/settings/passwordchange"><samp class="glyphicon glyphicon-cog"></samp> Settings</a>
			</div>
		</div>
		<div class="row-2">
		<div class="row-2 menu">
			<nav>
				<ul>
					<a href="/dashboard"><li><samp class="glyphicon glyphicon-home"></samp> Home</li></a>

					<li onclick="hide_show_attendance()" style="color:white;"><samp class="glyphicon glyphicon-file"></samp> Attendances <span id="menu_item1_class" class="glyphicon glyphicon-chevron-down"  style="float:right; font-size:13px;"></span></li>

					<div id="menu_item1" style="display:none;">
					@if(Auth::user()->role!="Head Master")
					<a href="/attendance/?user=#"  class=""> <li style="margin-left:5%; color:white;"><samp class="glyphicon glyphicon-chevron-right"></samp> Roll Call</li></a>
					@endif
					<a href="/attendance/?user=report"  class=""><li style="margin-left:5%; color:white;"><samp class="glyphicon glyphicon-chevron-right"></samp> Report Attendance</li></a>
					</div>
					<script>
						function hide_show_attendance(){

							menu_item1 = document.getElementById('menu_item1');
							if(menu_item1.style.display!='none'){
								menu_item1 = document.getElementById('menu_item1');
								menu_item1.style.display = 'none';
								document.getElementById('menu_item1_class').className = 'glyphicon glyphicon-chevron-down';
							}else{
								menu_item1 = document.getElementById('menu_item1');
								menu_item1.style.display = 'block';	
								document.getElementById('menu_item1_class').className = 'glyphicon glyphicon-chevron-up';
							}
						}
					</script>

				
					@if(Auth::user()->role!="Head Master")
					<a href="/marks/"><li><samp class="glyphicon glyphicon-scale"></samp> Marks/Score</li></a>
					@endif
					@if(!empty(Auth::user()->role))
					<a href="/management"><li><samp class="glyphicon glyphicon-sunglasses"></samp> Management</li></a>
					@endif
					
				
					<li onclick="hide_show_result()" style="color:white;"><samp class="glyphicon glyphicon-envelope"></samp> Results <span id="menu_item2_class" class="glyphicon glyphicon-chevron-down"  style="float:right; font-size:13px;"></span></li>

					<div id="menu_item2" style="display:none;">
					<a href="/results/"  class=""> <li style="margin-left:5%; color:white;"><samp class="glyphicon glyphicon-chevron-right"></samp> View Results</li></a>
					<a href="/reports/"  class=""><li style="margin-left:5%; color:white;"><samp class="glyphicon glyphicon-chevron-right"></samp> Report Results</li></a>
					</div>
					<script>
						function hide_show_result(){

							menu_item2 = document.getElementById('menu_item2');
							if(menu_item2.style.display!='none'){
								menu_item2 = document.getElementById('menu_item2');
								menu_item2.style.display = 'none';
								document.getElementById('menu_item2_class').className = 'glyphicon glyphicon-chevron-down';
							}else{
								menu_item2 = document.getElementById('menu_item2');
								menu_item2.style.display = 'block';	
								document.getElementById('menu_item2_class').className = 'glyphicon glyphicon-chevron-up';
							}
						}
					</script>

					<a href="/timetable/"><li><samp class="glyphicon glyphicon-time"></samp> Timetable</li></a>

					<a href="/profile/"><li><samp class="glyphicon glyphicon-user"></samp> Profile</li></a>
					
					<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <li><samp class="glyphicon glyphicon-user"></samp></samp>
										{{ __('Log Out')}}</li></a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
				</ul>
			</nav>
		</div>
		<div class="row-2 main">

        <div class="min-h-screen bg-gray-100">
            
            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

		
    </body>
</html>
