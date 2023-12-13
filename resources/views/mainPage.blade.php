@extends('layouts.master')

@section('title')
  DEREK WEB
@endsection


@section('topbar')
    SOSO Media
@endsection

@section('content')
    <!-- a post form for user -->
    <div class = "postForm" id="Form">
        <div class = "postForm" id="Formstyle">
            <form method="post" action="{{url("addPost")}}">
                {{csrf_field()}}
                    <div class = "leftPost">
                        <strong>Title:</strong>  
                        <br><input class="inputPost" id="inputTitle" placeholder="title" type="text" name="InpTitle">
                        <br>
                        <strong>Author:</strong>
                        <br> 
                        @if(session()->exists('userName'))
                            <input disabled class="inputPost" type="text" name="InpA" value="{{session()->get('userName')}}">
                            <input type="hidden" name="InpAuthor" value="{{session()->get('userName')}}">
                        @else
                            <input class="inputPost" id="inputName" placeholder="name" type="text" name="InpAuthor">
                        @endif
                        
                        <br>
                        <button class="inputPost" type="submit">Submit Post</button>
                    </div>
                    <div class = "rightPost">
                        <textarea class="inputPost" id="inputText" placeholder="Write Your Message" type="text" name="InpMessage"></textarea>
                    </div>
            </form>
        </div>
        
        <div class = "ErrorM" name = "ErrorM">
            @if ($errorM)
                @foreach($errorM as $error)
                    <p>
                        <strong> - {{$error}} </strong>
                    </p>
                @endforeach
            @endif
        </div>
    </div>
    

    <!--Posted Infor, only 7 posts for main page-->
    <div class="newPostAll">
        <h3>Newest Post</h3>
        <?php $count = 0; ?>
        <?php foreach($post as $postdetail){ ?>
            @include('layouts/postBlock')
            <?php $count++; ?>
            @if($count >= 7)
                @break
            @endif
        <?php }?>
        
    </div>
@endsection

