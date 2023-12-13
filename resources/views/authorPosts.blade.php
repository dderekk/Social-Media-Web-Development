@extends('layouts.master')

@section('title')
  Author Posts
@endsection

@section('topbar')
    Author Posts
@endsection

@section('content')
    <!--Posted Infor-->
    <div class="newPostAll">
        <h3>Author Post</h3>
        <?php foreach($post as $postdetail){ ?>
            @include('layouts/postBlock')
        <?php }?>
        
    </div>
@endsection