@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 ">


        <div class="w-25">

             <div class="mb-3 text-center">
                <img src="{{ asset('assets/image/chattoapps.png') }}" class="img-fluid w-25" alt="image">
             </div>
            <div class="rounded shadow p-3 bg-white ">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class=" mb-3 ">
                        <label for="email">{{ __('Email Address') }}</label>


                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class=" mb-3">
                        <label for="password">{{ __('Password') }}</label>


                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class=" mb-3">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>

                    <div class=" mb-0">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
