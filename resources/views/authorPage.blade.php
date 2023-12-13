@extends('layouts.master')

@section('title')
  ALL Authors
@endsection

@section('topbar')
    ALL AUTHORS
@endsection

@section('content')
    <div class="AuthorPostAll">
        <h3>
            All Authors
        </h3>
        <table>
            <tr>
                <th>
                    AUTHOR NAME
                </th>
                <th>
                    NUMBER OF POSTS
                </th>
                <th>
                    AUTHOR ID
                </th>
            </tr>
            @foreach($author as $auth)
            <tr>
                <th>
                    <div class="AuthorPostAll" id="authors">
                        <a href="{{url("authorPosts/$auth->UsersID")}}">{{$auth->Name}}</a>
                    </div>
                </th>
                <th>
                    <div class="authorsID">
                        {{$auth->NumPOST}}
                    </div>
                </th>
                <th>
                    <div class="authorsID">
                        {{$auth->UsersID}}
                    </div>
                </th>
            </tr>
            @endforeach
        </table>
    </div>
@endsection