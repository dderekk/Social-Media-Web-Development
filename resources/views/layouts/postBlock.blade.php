<div class="mainNewpost" id="showder">
    <div class="mainNewpost" id = "newpost">
        <div class="PostTitle">
            <a href="{{url("details/$postdetail->POSTID/0")}}">{{$postdetail->Title}}</a>
        </div>
        
        <div class="PostDate">
            <table>
                <tr>
                    <th>
                        <img src="https://cdn-icons-png.flaticon.com/128/6477/6477469.png"  />
                    </th>
                    <th class = "name">
                        <div class = "PostDate" id = "postName">
                            {{$postdetail->Name}}
                        </div>
                    </th>
                    <th>
                        <img src="https://cdn-icons-png.flaticon.com/128/992/992700.png"  />
                    </th>
                    <th>
                        <div class = "PostDate" id = "postDate">
                            <div class = "PostDate" id = "Date">
                                <strong> 
                                    Posted on: 
                                </strong>
                                {{$postdetail->Post_Date}}
                            </div>
                        </div>
                    </th>
                    <th>
                        <img src="https://cdn-icons-png.flaticon.com/128/3114/3114810.png"  />
                    </th>
                    <th>{{$postdetail->comNum}}</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>