@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My Messeges'])
        </div>
    </div>

    @include('inc.toast-notifications')

    <div class="modal delete">
        <form action="/" method="post" id="delete_message_form" enctype="multipart/form-data">
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
            @include('inc.mysidenav', ['active'=>$active_menu])
        </div>

        <div class="col s12 m12 l8">
            <div class="row">

                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s6"><a target="_self" class="{{($active == 'inbox' )?'active':''}}" href="{{route('messages.index', ['inbox'])}}">inbox</a></li>
                        <li class="tab col s6"><a target="_self" class="{{($active == 'outbox')?'active':''}}" href="{{route('messages.index', ['outbox'])}}">outbox</a></li>
                    </ul>
                </div>

                    @php
                       if($active == 'inbox'){$show='from';}else{$show='to';};
                    @endphp

                    @if($messages->first())

                        <ul class="collection">
                                @foreach($messages as $message)
                                    @include('inc.message',
                                    [
                                    'hasAttachments'=>$message->hasAttachments(),
                                    'id'=>$message->id,
                                    'avatar'=>$message->$show->thumb,
                                    'show'=>$show,
                                    'name'=>$message->$show->first_name.' '.$message->$show->last_name,
                                    'title'=>($message->title)?$message->title:'no title',
                                    'time'=>$message->created_at,
                                    'is_read'=>$message->is_read
                                    ])
                                @endforeach
                        </ul>
                    @else
                        <p class="flow-text center">No Messages</p>
                        @if($active == 'inbox')
                            <p class="center"><a href="{{route('messages.create')}}" class="btn-flat">create a new</a></p>
                        @endif
                    @endif

            </div>

            <div class="row center">
                {{$messages->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script>
        $(document).ready(function(){
            var elems = document.getElementsByClassName('modal delete');;
            var instance = M.Modal.init(elems[0]);
            $("a.modal-open-delete").click(function () {
                document.getElementById('delete_message_form').action = $(this).data("messageaction");
                instance.open()
            })
        });

    </script>

@endsection




