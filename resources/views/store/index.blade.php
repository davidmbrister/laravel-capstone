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
        <div class="item">
        {!!Form::open(['route' => ['store.addToCart', $item->id, 1]])!!}
                <div class = "product-card">
                <a href="{{ route('store.single', $item->slug) }}">
                  <img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" alt="thumbnail"/>
                </a>
                <a href="{{ route('store.single', $item->slug) }}">
                 <h5 class="product-title"> {{substr($item->title, 0, 17)}}{{strlen($item->title) > 17?"...":""}}</h3> 
                 {{-- <td>{{substr($item->title, 0, 14)}}{{strlen($item->title) > 14?"...":""}}</td> --}}
                </a>
                
                <br /> 
                <p class = "price">${{$item->price}}</p>
                <br /> 
                {{-- Change this href to a submit, don't forget to close the form --}}
                {{-- <a href="{{ route('store.addToCart', ['id' => $item->id, 'amount' => 1])}}"><button>Buy Now </button></a> --}}

                {{ Form::button('Buy Now', ['type' => 'submit', 'class' => 'button'] )  }}
                {!! Form::close() !!}
                
              </div>
              
            </div>
            @endforeach
          {{-- TEST PLACEHOLDER BELOW IF THEREZ NO IMAGES --}}
         {{--  <div class="item">
            <div class = "product-card">
              <img src="http://placehold.it/200x200" alt="thumbnail"><h3>[product name]</h3><br /> 
              <p class = "price">$[price]]</p><br /> 
              <button>Buy Now</button>
            </div>
          </div> --}}
      </div> {{-- grid --}}
    </div> {{-- col-md --}}

  </div>

@endsection

