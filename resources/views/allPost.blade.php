@extends('layouts.master')

@section('title')
  ALL POST
@endsection

@section('topbar')
    ALL POST
@endsection

@section('content')
<!--Posted Infor-->
 <div class="newPostAll">
        <h3>All Post</h3>
        <?php foreach($post as $postdetail){ ?>
            @include('layouts/postBlock')
        <?php }?>
        
    </div>
@endsection
