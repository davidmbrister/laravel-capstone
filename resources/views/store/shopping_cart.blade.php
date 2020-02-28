@extends('public')

@section('pagetitle')
Laravel Storefront 
@endsection

@section('pagename')
Public Store
@endsection

@section('content')

  <div class = "row">

    <div class="col-md-3">
      <div class="card card-body categories">
        <h3 class="category-query-title">Categories</h3>
        <hr>
        <a href="{{ route('store.index') }}" class="">All</a>
      </div>

    </div>
    
    <div class="col-md-9">
      <div class="grid">
      <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>[product name]</h3><br /> <p class = "price">$[price]]</p><br /> <button>Buy Now</button></div></div> {{-- <a href="{{ route('store.addToCart', javascript var that gets amount from textField, dropDown, whatever interactive element) }}" class=""> Buy Now </a> --}}
      </div>
    </div>

  </div>

@endsection

