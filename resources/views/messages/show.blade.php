@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col s12">
            @include('widgets.parallax', ['cover'=>$user->cover])
            @include('inc.middlemenu', ['avatar'=>$user->avatar, 'header'=>'My Messeges'])
        </div>
    </div>

    @include('inc.notifications')

    <div class="col s12 m4 l1 hide-on-med-and-down"></div>
    </div>

    <div class="row">
        <div class="col s12 m12 l1 hide-on-med-and-down"></div>

        <div class="col s12 m12 l2 hide-on-med-and-down">
            @include('inc.mysidenav', ['active'=>'messeges'])
        </div>



        <div id="message_delete" class="modal delete">
            <form action="{{route('messages.destroy', $message->id)}}" method="post" id="form1" enctype="multipart/form-data">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <h4>Delete confirmation</h4>
                    <p>Do you want to delete messege?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                    <button class="btn red">Delete</button>
                </div>
            </form>
        </div>



        <div class="col s12 m12 l8">
            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="{{($user->id == $message->to->id )?$message->from->thumb:$message->to->thumb}}" alt="" class="circle materialboxed">
                    <p class="title">From: <a class="black-text" href="{{route('profiles.show', $message->from->id)}}">{{$message->from->first_name}} {{$message->from->last_name}} <i class="material-icons tiny">open_in_new</i></a></p>
                    <p class="title">To: {{$message->to->first_name}} {{$message->to->last_name}}</p>
                    <p>Time: {{$message->created_at}} </p>
                    <a href="#message_delete" class="grey-text btn-flat modal-trigger" >delete</a> | <a href='#!' class="grey-text btn-flat" onclick="show_reply_body()">reply </a>
                </li>

                <li class="collection-item">
                    <p class="truncate">Title: {{$message->title}}</p>
                    <p>{{$message->text}}</p>
                        <p class="center">
                        @if($message->images->first())
                            @foreach($message->images as $image)
                                <img src="{{\Azizner\Http\Controllers\ImageController::showFromSecure($image->thumb)}}" alt="" title="">
                            @endforeach
                        </p>
                            <form action="{{route('messages.downloadAttachments', $message->id)}}" method="post" >
                                @csrf
                                <p class="right-align">
                                    <button  class="btn" type="submit" >download attachments</button>
                                </p>
                            </form>
                        @endif
                </li>

            </ul>

            <ul class="collapsible">
                <li class='{{$errors->all()?"active":''}}' id="!">
                    <div class="collapsible-header" id="reply_header"><i class="material-icons">arrow_drop_down</i>Reply</div>
                    <div class="collapsible-body" id="reply_body">
                        <form action="{{route('messages.store')}}" method="post" id="form" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input value='{{($message->to->id == $user->id)?$message->from->email:$message->to->email}}' id="to" type="email" data-length="100" name="to" required>
                                    <label>TO</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input value='Re:{{old('title')?old('title'):$message->title}}' id="input_text" type="text" data-length="100" name="title" required>
                                    <label>Title:RE</label>
                                </div>
                                <div class="file-field input-field col s12 m6 l6">
                                    <div class="btn">
                                        <span>Attach photos</span>
                                        <input type="file" name="photos[]" multiple accept="image/*">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Attach up to 12 images" >
                                        <label>max 2MB each</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" name="text">{{old("text")}}</textarea>
                                    <label for="textarea1">Textarea</label>
                                </div>
                            </div>

                            <button class="btn" >Reply<i class="material-icons right">send</i></button>

                        </form>

                    </div>
                </li>

            </ul>




        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });



        function show_reply_body() {
            document.getElementById('reply_body').style.cssText = 'display: block;';
            document.getElementById('!').classList.add('active');
        }

    </script>

@endsection




