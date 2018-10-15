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

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if ($errors->has('email') or $errors->has('password'))
                        <span class="flow-text red-text">sxal tvyalner</span>
                    @endif

                    <div class="input-field">
                        <i class="material-icons prefix">mail</i>
                        <input value='{{ old('email') }}' id="email_inline" type="email" class="validate" name="email" required>
                        <label for="email_inline">Email</label>
                        <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">dialpad</i>
                        <input id="password" type="password" class="validate" name="password" required>
                        <label for="password">Password</label>
                    </div>



                    <p>
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <span>{{ __('Remember Me') }}</span>
                    </label>
                    </p>
                    <button type="submit" class="btn">
                        {{ __('Login') }}
                    </button>
                    <a class="btn" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>


                </form>

                <p>
                <a class="btn" href="{{ route('register') }}">
                    der grancvac cheq
                </a>
                </p>

            </div>

        </div>

        <div class="col s2 m3 l4"></div>
    </div>

    <script src="/js/slider_script.js"></script>


@endsection