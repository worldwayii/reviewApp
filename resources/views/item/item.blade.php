@extends('layouts.master')
@section('title','View Item')
@section('body')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#"> View Item</a></li>
      </ol> 
    </div>
    @component('components.sidebar')
    @endcomponent
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      {{-- Displays error message --}}
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{Session::get('success')}}
      </div>
      @elseif(Session::has('fail'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{Session::get('fail')}}
      </div>
      @endif
      <div class="card mt-4">
        <img class="card-img-top img-fluid" src="{{Storage::url('public/'.$item->image_path)}}" alt="">
        <div class="card-body">
          <h3 class="card-title">{{$item->name}}</h3>
          <h4>AUD ${{$item->price}}</h4>
          <h4>Manufactured By: {{$manufacturer->name}}</h4>
          <h4> Total Reviews: {{$totalReview}} </h4>
          <p class="card-text">{{$item->about}}</p>
          
        </div>
        <div class="card-footer">
                <a href="{{url('item/delete/'.$item->sku)}}" class="btn btn-danger btn-sm" style="float: left; margin:0 0 0 2px;">Delete</a>
                <a href="{{url('item/edit/'.$item->sku)}}" class="btn btn-success btn-sm" style="float: right; margin:0 2px 0 0;"> Edit </a>
              </div>
      </div>
      <!-- /.card -->
      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Item Reviews
        </div>
        @if($reviews == null)
        <div class="card-body">
          <p>No reviews yet.</p>
          <a href="{{url('item/review/'.$item->sku)}}" class="btn btn-success">Leave a Review</a>
        </div>
        @else
        {{-- Show review --}}
        @foreach($reviews as $review)
        <div class="card-body">
          <div class="">
            @if($review->rating == 1)
            <small class="text-muted">&#9733; </small>
            @elseif($review->rating == 2)
            <small class="text-muted">&#9733; &#9733; </small>
            @elseif($review->rating == 3)
            <small class="text-muted">&#9733; &#9733; &#9733; </small>
            @elseif($review->rating == 4)
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; </small>
            @elseif($review->rating == 5)
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733; </small>
            @endif
          </div>
          <p>{{$review->comment}}</p>
          <small class="text-muted">Posted by {{$review->user_id}} on {{$review->created_at}}</small>
        </div>
        <div >
          <a href="{{url('item/review/edit/'.$review->id)}}" class="btn btn-success" style="float: right; margin:0 15px 0 0;">Edit</a>
        </div>
        @endforeach
        <div style="padding: 5px;">
          <hr>
          <a href="{{url('item/review/'.$item->sku)}}" class="btn btn-success">Leave a Review</a>
        </div>
        @endif
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-lg-9 -->
  </div>
</div>
<!-- /.container -->
@endsection