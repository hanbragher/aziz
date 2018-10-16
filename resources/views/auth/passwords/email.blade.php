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

                @if (session('status'))
                    <span class="flow-text red-text">{{ session('status') }}</span>
                @endif

                @if ($errors->has('email'))
                    <span class="flow-text red-text">sxal tvyalner</span>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-field">
                        <i class="material-icons prefix">mail</i>
                        <input value='{{ old('email') }}' id="email_inline" type="email" class="validate" name="email" required>
                        <label for="email_inline">Email</label>
                        <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                    </div>

                    <button type="submit" class="btn">
                        {{ __('Send Password Reset Link') }}
                    </button>
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