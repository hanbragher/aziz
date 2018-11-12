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

        <div class="col s12 m12 l8">
            <div class="row">

                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s6"><a target="_self" class="{{!empty($outbox)?'':'active'}}" href="{{route('messages.index', ['inbox'])}}">inbox</a></li>
                        <li class="tab col s6"><a target="_self" class="{{!empty($outbox)?'active':''}}" href="{{route('messages.index', ['outbox'])}}">outbox</a></li>
                    </ul>
                </div>


                    @if($messages->first())
                        @php
                            !empty($outbox)?$show='to':$show='from'
                        @endphp
                        <ul class="collection">
                                @foreach($messages as $message)
                                    @include('inc.message',
                                    [
                                    'hasAttachments'=>$message->hasAttachments(),
                                    'id'=>$message->id,
                                    'avatar'=>$message->$show->thumb,
                                    'show'=>$show,
                                    'name'=>$message->$show->first_name.' '.$message->$show->last_name,
                                    'title'=>$message->title,
                                    'time'=>$message->created_at,
                                    'is_read'=>$message->is_read
                                    ])
                                @endforeach
                        </ul>
                    @else
                        <p class="flow-text center">No Messages</p>
                    @endif




            </div>

            <div class="row center">
                {{$messages->appends($_GET)->links()}}
            </div>
        </div>

        <div class="col s12 m6 l1">

        </div>
    </div>

@endsection




