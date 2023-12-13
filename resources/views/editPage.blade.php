@extends('layouts.master')

@section('title')
  Edit Post Detail
@endsection

@section('topbar')
    Edit Post Detail
@endsection

@section('content')
    <div class="detail">
        <div class = "addComment" id = "addComment">
            <form method="post" action="{{url("postEdit/$detail->POSTID")}}">
                @CSRF 
                    <div class = "addComment">
                        <br>
                        Title:
                        <input class="Change" value="{{$detail->Title}}" type="text" name="changeTitle">
                        <br>
                        <br>
                        Name:
                        @if(session()->exists('userName'))
                            <input disabled class="Change" name="InpUser" value="{{$authorname->Name}}">
                            <input type="hidden" name="postName" value="{{$authorname->Name}}">
                        @else
                            <input class="Change" placeholder="name" type="text" name="InpUser">
                        @endif
                        <br>
                        <br>
                        <div class="changeText">
                            <textarea type="text" name="changePost" id="changePost">{{$detail->Message}}</textarea>
                            <br>
                            <br>
                            <button class="Change" type="submit">Submit Changes</button>
                        </div>
                    </div>
            </form>
            <div class = "ErrorM" name = "ErrorM">
                @if ($errorM)
                    @foreach($errorM as $error)
                        <p>
                            <strong> - {{$error}} </strong>
                        </p>
                    @endforeach
                @endif
        
            <div>
        </div>
    
    </div>
@endsection