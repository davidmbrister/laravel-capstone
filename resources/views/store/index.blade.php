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
        <hr>
        @foreach ($categories as $category)
        <a href="{{ route('store.category', $category->id) }}" class="">{{ $category->name }}</a>
        <hr>
        @endforeach
      </div>

    </div>
    
    <div class="col-md-9">
      <div class="grid">
      @foreach ($items as $item)
      <div class="item"><div class = "product-card"><a href="{{ route('store.single', $item->slug) }}"><img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" alt="thumbnail"/></a><h3><a href="{{ route('store.single', $item->slug) }}">{{$item->title}}</a></h3><br /> <p class = "price">${{$item->price}}</p><br /> <a href="{{ route('store.updateCart', ['id' => $item->id, 'amount' => 1])}}"><button>Buy Now </button></a></div></div>
      @endforeach
      <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>[product name]</h3><br /> <p class = "price">$[price]]</p><br /> <button>Buy Now</button></div></div>
      </div>
    </div>

  </div>

@endsection

