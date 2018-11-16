@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My announcements'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="modal delete">
        <form action="/" method="post" id="delete_announcement_form" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Delete confirmation</h4>
                <p>Do you want to delete this message?</p>
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
            @include('inc.mysidenav', ['active'=>'favoritesindex'])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">
                @foreach($announcements as $announcement)
                    <div class="col s12 m12 l6 ">
                        @include('inc.announcement', [
                                    'starable' => true,
                                    'star'=> $user->favoriteAnnouncements->contains($announcement->id),
                                    'announcement' => $announcement,
                                    'editable'=>false
                                    ])
                    </div>
                @endforeach
            </div>

            <div class="row center">

                {{$announcements->appends($_GET)->links()}}
            </div>


        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script src="/js/set-favorite.js"></script>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal delete');
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {
                document.getElementById('delete_announcement_form').action = $(this).data("announcementaction");
                instance.open()
            })
        });

    </script>

@endsection




