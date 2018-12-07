@extends('layouts.layout')

@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col s12">
            @auth
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Categories'])
            @endauth
        </div>
    </div>

    @include('inc.toast-notifications')


    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('admin.inc.adminsidenav', ['active'=>$active])
        </div>

        <div class="col s12 m12 l8">

            <div class="row">
                @if($categories->first())
                    <ul class="collection">
                    @foreach($categories as $category)
                            <li class="collection-item avatar">
                                <p>NAME: {{$category->name}}</p>
                                <img src="{{$category->image}}" alt="" height="200" class="materialboxed">
                                <p>

                                <form action="{{route('categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Cover File</span>
                                            <input type="file" name="image" accept="image/*">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                    <button class="btn">update</button>

                                </form>
                                </p>
                            </li>

                    @endforeach
                    </ul>
                @else
                    <p class="flow-text center">No places</p>
                    <p class="center"><a href="{{route('places.create')}}" class="btn-flat" target="_blank">create a new</a></p>
                @endif
            </div>

            <div class="row">


            </div>
        </div>

        <div class="col s12 m6 l1">
        </div>
    </div>



@endsection