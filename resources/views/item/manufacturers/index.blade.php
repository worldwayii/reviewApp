@extends('layouts.master')
@section('title', 'Manufacturers')
@section('body')
<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
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
    </div>
    @component('components.sidebar')
    @endcomponent
    <!-- /.col-lg-3 -->
    
    <div class="col-lg-9">
      <div class="row" style="margin-top: 60px;">
        {{-- Loop through the item object and display all of them --}}
        @foreach($manufacturers as $manufacturer)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <a href="{{url('manufacturer/item/'.$manufacturer->sku)}}">
                <h4 class="card-title">
                  {{$manufacturer->name}}
                
                </h4>
                </a>
                
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
@endsection