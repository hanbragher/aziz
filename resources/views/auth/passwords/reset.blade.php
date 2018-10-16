@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col s12">
            @include('widgets.home_slider')
        </div>
    </div>

    <div class="row center">
        <div class="col s2 m3 l4"></div>

        <div class="col s8 m6 l4">

            <div class="row">
                @if ($errors->has('email'))
                    <span class="flow-text red-text">{{ $errors->first('email') }}</span>
                @endif

                @if ($errors->has('password'))
                    <span class="flow-text red-text">{{ $errors->first('password') }}</span>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-field">
                        <i class="material-icons prefix">mail</i>
                        <input value='{{ old('email') }}' id="email_inline" type="email" class="validate" name="email" required>
                        <label for="email_inline">Email</label>
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">dialpad</i>
                        <input id="password" type="password" class="validate" name="password" required>
                        <label for="password">New password</label>
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">dialpad</i>
                        <input id="password" type="password" class="validate" name="password_confirmation" required>
                        <label for="password">Password confirmation</label>
                    </div>

                    <button type="submit" class="btn">
                        Reset Password
                    </button>
                    <a class="btn" href="{{ route('password.request') }}">
                        {{ __('Send link again') }}
                    </a>
                </form>

            </div>

        </div>

        <div class="col s2 m3 l4"></div>
    </div>

    <script src="/js/slider_script.js"></script>


@endsection