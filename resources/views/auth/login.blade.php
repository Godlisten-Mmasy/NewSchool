<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN | SMS</title>
		@include('layouts.links')
	</head>
	<body>
		<div>
		<form class="form" method="post" action="{{ route('login') }}">
        @csrf
			<div class="logo-index"><center><img style="border:1px solid silver; border-radius:5%;" width="100" height="100" src="/images/tanzania.jpeg"></center></div>
			<div><center><font size="3">School Management System(SMS)</font></center></div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
			<div class="form-group">
				<!-- <label>Username</label> -->
				<input class="form-control" type="email" name="email" placeholder="Username/Email" required>
			</div>
			<div class="form-group">
				<!-- <label>Password</label> -->
				<input class="form-control" type="password" name="password" placeholder="Password" required>
			</div>
			<!-- <div>
				<center><input class="btn btn-success" type="submit" value="LOGIN"></center>
			</div> -->

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div>
                <!-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif -->

                <center>
                <button class="btn btn-success">
                    {{ __('Log in') }}
                </button>
                </center>
            </div>
		</form>
		</div>
	</body>
</html>
