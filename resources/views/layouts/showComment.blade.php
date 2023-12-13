<div class="postComments" id="show">
    <div class="postComments" id="commentuser">
        <table>
            <tr>
                <th>
                    <strong>{{$CM->Name}}</strong> 
                </th>
                <th>
                    {{$CM->Comment_Date}}
                </th>
                <th>
                    CommentID: {{$CM->CommentID}}
                </th>
                <th>
                    <a href={{url("details/$CM->BelongPostID/$CM->CommentID")}}>reply</a>
                </th>
            </tr>
        </table>
        
        
    </div>
    <div class="postComments" id="postComments">
        {{$CM->Message}}
    </div>
</div>