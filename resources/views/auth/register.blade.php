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

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if ($errors->has('email'))
                        <span class="flow-text red-text">ogtater goyutyun uni</span>
                    @endif
                    @if ($errors->has('password') or $errors->has('last_name') or $errors->has('first_name'))
                        <span class="flow-text red-text">sxal tvyalner</span>
                    @endif
                    @if ($errors->has('agree'))
                        <span class="flow-text red-text">ynduneq paymannery</span>
                    @endif


                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input value='{{old('first_name')}}' id="icon_prefix" type="text" class="validate" name="first_name" required>
                            <label for="icon_prefix">First Name</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input value='{{old('last_name')}}' id="icon_telephone" type="tel" class="validate" name="last_name" required>
                            <label for="icon_telephone">Last Name</label>
                        </div>
                    </div>



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
                    <div class="input-field">
                        <i class="material-icons prefix">dialpad</i>
                        <input id="password" type="password" class="validate" name="password_confirmation" required>
                        <label for="password">Password again</label>
                    </div>
                    <p>
                        <label>
                            <input type="checkbox" name="agree" required/>
                            <span><a href="#">agree terms of use</a></span>
                        </label>
                    </p>

                    <button type="submit" class="btn">
                        grancvel
                    </button>
                    <a class="btn" href="{{ route('login') }}">
                        arden grancvac eq
                    </a>

                </form>

            </div>

        </div>

        <div class="col s2 m3 l4"></div>
    </div>

    <script src="/js/slider_script.js"></script>


@endsection