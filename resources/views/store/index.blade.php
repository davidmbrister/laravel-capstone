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
        
      </div>

    </div>
    
    <div class="col-md-9">
      <div class="grid">
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
        <div class="item"><div class = "product-card"><img src="http://placehold.it/200x200" alt="thumbnail"><h3>Title: </h3><br /> <p class = "price">Price: </p><br /> <button>Buy Now</button></div></div>
      </div>
    </div>

  </div>

@endsection

