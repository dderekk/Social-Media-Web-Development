@foreach($commentALL as $CM2)
    @if($CM2->AppliedID == $CM->CommentID)
        <div class="subcommentBlock" id="subcommentBlock">
            <div class="commentBlock" id="img">
                <img src="https://cdn-icons-png.flaticon.com/128/10766/10766639.png"  />
            </div>
            <div class = "commentBlock" id = "subcommentBlock">
                @include('layouts/showComment',['CM' => $CM2])
            </div>
            @include('layouts/commentLoop',['CM' => $CM2])
        </div>
    @endif
@endforeach