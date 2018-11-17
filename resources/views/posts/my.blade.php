@extends('layouts.layout')

@section('links')

@endsection

@section('content')
    <div class="fixed-action-btn ">
        <a class="btn-floating btn-large red" href="{{route('posts.create')}}">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>


    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My posts'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="modal delete">
        <form action="/" method="post" id="delete_post_form" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Delete confirmation</h4>
                <p>Do you want to delete this post?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                <button class="btn red">Delete</button>
            </div>
        </form>
    </div>

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'myposts'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col s6 m4 l3">
                        @include('inc.post', [
                         'editable' => true,
                         'blog_name'=> 'hide',
                         'post'=> $post
                         ])
                    </div>

                @endforeach

            </div>

            <div class="row center">

                {{$posts->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal delete');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {
                document.getElementById('delete_post_form').action = $(this).data("postaction");
                instance.open()
            })
        });

    </script>



@endsection




