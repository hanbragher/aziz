@extends('layouts.layout')

@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col s12">
            @auth
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'Users'])
            @endauth
        </div>
    </div>

    @include('inc.toast-notifications')

    @include('inc.modal-destroy-form')

    <div class="modal moderate">
        <form action="/" method="post" id="moderate_post_form">
            @csrf
            <div class="modal-content">
                <h4>Moderate</h4>
                <p>Do you want to change "moderate" status?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                <button  class="btn blue">Change</button>
            </div>
        </form>
    </div>


    <div class="col s12 m4 l1 hide-on-med-and-down">

    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('admin.inc.adminsidenav', ['active'=>'users'])
        </div>

        <div class="col s12 m12 l8">

            <div class="row">
                @include('admin.inc.users-selector-bar', ['active'=>$active_bar])
            </div>

            <div class="row">
                <form action="{{route('users.index')}}" method="get" enctype="multipart/form-data">
                    <div class="input-field col s5 m4 l3">
                        <select name="search_type" >
                            <option value="id" selected>ID</option>
                            <option value="email" {{($search_type == 'email')?'selected':''}}>Email</option>
                        </select>
                        <label>Search by:</label>
                    </div>
                    <div class="input-field col s5 m4 l3">
                        <input id="text" type="text" class="validate" name="search" value="{{$search}}" required>
                        <label for="text">Search</label>
                    </div>
                    <div class="input-field col ">
                        <button class="btn"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>


            <div class="row">
                <table class="highlight ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>set/unset</th>
                        <th>set/unset</th>
                        <th>user edit</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        @if($active_bar == 'admins' or $active_bar == 'creators')
                            @php $link = $user->user @endphp
                        @else
                            @php $link = $user@endphp
                        @endif
                        <tr>
                            <td >{{$link->id}}</td>
                            <td><img src="{{$link->avatar}}" alt="" class="notification-thumb"> <a href="{{route('profiles.show', $link->id )}}" class="black-text" target="_blank">{{$link->email}}</a></td>
                            <td><a href="#!" data-id='{{$link->id}}' class="set-admin btn {{($link->isAdmin())?'green':''}}" >Admin</a></td>
                            <td><a href="#!" data-id='{{$link->id}}' class="set-creator btn {{($link->isCreator())?'green':''}}">Creator</a></td>
                            <td><a href="{{route('profiles.edit', $link->id)}}" class="btn" target="_blank">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row center">
                {{$users->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">
        </div>
    </div>

    <script src="/js/modal-destroy-form.js"></script>
    <script src="/js/set-favorite.js"></script>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal moderate');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-moderate").click(function () {
                document.getElementById('moderate_post_form').action = $(this).data("actionroute");
                instance.open()
            });


            $('select').formSelect();

            $("a.set-creator").click(function () {
                var btn = $(this);
                $.ajax({
                    method: 'POST',
                    url: '/admin/setcreator',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data :{
                        "id":$(this).data("id"),
                    },
                    success: function(data){
                        console.log(data);
                        if(data.status === "success"){
                            btn.toggleClass("green");
                        }
                    },
                    error: function(xhr, desc, err){
                        console.log(err);
                    }
                });
            });



            $("a.set-admin").click(function () {
                var btn = $(this);
                if(confirm('Do want really change admin status?')){
                    if(confirm('Really real?')){

                        $.ajax({
                            method: 'POST',
                            url: '/admin/setadmin',
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data :{
                                "id":$(this).data("id"),
                            },
                            success: function(data){
                                console.log(data);
                                if(data.status === "success"){
                                    btn.toggleClass("green");
                                }
                            },
                            error: function(xhr, desc, err){
                                console.log(err);
                            }
                        });
                    }
                }

            });


        });
    </script>

@endsection