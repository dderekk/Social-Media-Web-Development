@extends('layouts.master')

@section('title')
  Post Detail
@endsection

@section('topbar')
    Post Detail
@endsection

@section('content')
    <div class="detail">
        <div class = "changeButton">
            <table>
                    <tr>
                        
                            <th>
                                <form method="post" action="{{url("showPostEdit/$detail->POSTID")}}">
                                    @csrf  
                                    @if(session()->get('userName'))
                                        <button class="postEdit" type="submit">Edit Title&Message</button>
                                    @endif
                                </form> 
                            </th>
                            <th>
                                <form method="post" action="{{url("DEL/$detail->POSTID")}}">
                                    @csrf  
                                    @if(session()->get('userName'))
                                        <button class="postDle" type="submit">Delete</button>
                                    @endif
                                </form>
                            </th> 
                    </tr>
            </table>
        </div>
        <div class = "postTitle" id = "postTitle">
            <h3> {{$detail->Title}} </h3>
        </div>
        <table>
            <tr>
                <th>
                    <strong> written by {{$authorname->Name}} </strong>
                </th>
                <th>
                    <p>Post On:  {{$detail->Post_Date}}</p>
                </th>
                @if($detail->Update_Date!=NULL)
                    <th>
                        <p>Last Edit:  {{$detail->Update_Date}}</p>
                    </th>
                @endif
            </tr>
        </table>
        
        <div class = "postArticle" id = "postArticle">
            {{$detail->Message}}
        </div>
        
        <?php $stateL=$stateLike ?>
        <div class = "postLike" id = "postLike">
            <form method="post" action="{{url("likes/$detail->POSTID")}}">
                @csrf   
                @if($stateL==1)
                    <div class = "likebutton">
                        <button> </button>
                        <strong>{{$likes->likes}}</strong>
                    </div>  
                @elseif($stateL==0) 
                    <div class = "likebutton2">
                        <button> </button>
                        <strong>{{$likes->likes}}</strong>
                    </div>
                @else
                    <div class = "likebutton2">
                        <button> </button>
                        <strong>{{$likes->likes}}</strong>
                        <div class = "InputlikeName">
                            <input class="InputlikeName" name="likeInpName" placeholder="Your Name" type="text" required>
                        </div>
                    </div>
                    
                @endif
            </form>
            
        </div>

        <!-- POST INPUT add Comment -->
        <div class = "addComment" id = "addComment">
            <form method="post" action="{{url("addComment/$detail->POSTID/$replyCommentID")}}" id="commentForm">
                {{csrf_field()}}
                    <div class = "addComment">
                        <strong>
                            Commenter Name: 
                        </strong>
                        <input class="addComment" placeholder="name" type="text" name="InpUser" id="commentName">
                        <br>
                        <textarea class="addComment" placeholder="Write Your Comment" type="text" name="InpComment" id="commentMessage"></textarea>
                        <br>
                        @if($replyCommentID!=0)
                            <div class="replyblock">
                                <div class="replyblock" id="img">
                                    <img src="https://cdn-icons-png.flaticon.com/128/10766/10766639.png" />
                                </div>
                                <div class="replyblock" id="repCom">
                                    @foreach($commentALL as $RplyC)
                                        @if($replyCommentID == $RplyC->CommentID)
                                            @include('layouts/showComment',['CM' => $RplyC])
                                        @endif
                                    @endforeach
                                </div>
                                <div class="replyblock" id="link">
                                    <a href="{{url("details/$detail->POSTID/0")}}">
                                        reply to article
                                    </a>
                                </div>
                            </div>
                        @endif
                        <br>
                        
                        <button class="addComment" type="submit">Submit Comment</button>
                    </div>
            </form>
            <div class="CommentError" name="CommentError" id="commentError"></div>
            
        </div>
        @foreach($commentALL as $CM)
        <!-- Include the postComments view -->
                @if($CM->AppliedID == Null)
                    <div class = "commentBlock" name = "commentBlock">
                        @include('layouts/showComment')
                        @include('layouts/commentLoop')
                    </div>
                @endif
        @endforeach
    
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cForm = document.getElementById('commentForm');
        const cName = document.getElementById('commentName');
        const cMessage = document.getElementById('commentMessage');
        const cError = document.getElementById('commentError');

        cForm.addEventListener('submit', function (event) {
            let isValid = true;
            let errorMessages = [];

            // Validate comment/message
            const words = cMessage.value.split(/\s+/).filter(word => word.trim() !== '');
            if (words.length < 5) {
                isValid = false;
                errorMessages.push('  - The comment message must be at least 5 words.');
            }

            // Validate commenter's name
            if (cName.value.replace(/\s/g, '').length < 4 || /\d/.test(cName.value)) {
                isValid = false;
                errorMessages.push('  - Commenter\'s name must be at least 4 characters long and must not contain numeric characters.');
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission
                cError.innerHTML = errorMessages.join('<br>');
            }
        });
    });
</script>
