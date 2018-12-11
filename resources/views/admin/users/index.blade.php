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
                    vernagir
            </div>


            <div class="row">
                <table class="highlight ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>set/unset</th>
                        <th>set/unset</th>
                        <th>user edit</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td >{{$user->id}}</td>
                            <td><img src="{{$user->avatar}}" alt="" class="notification-thumb"> {{$user->email}}</td>
                            @if($user->isAdmin())
                                <td>admin</td>
                            @else
                                <td>user</td>
                            @endif
                            <td><a href="#!" data-id='{{$user->id}}' class="set-admin btn {{($user->isAdmin())?'green':''}}" >Admin</a></td>
                            <td><a href="#!" data-id='{{$user->id}}' class="set-creator btn {{($user->isCreator())?'green':''}}">Creator</a></td>
                            <td><a href="{{route('profiles.edit', $user->id)}}" class="btn" target="_blank">Edit</a></td>
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