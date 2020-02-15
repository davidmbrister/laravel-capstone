@extends('public')

@section('pagetitle')
Laravel Storefront 
@endsection

@section('pagename')
Public Store
@endsection

@section('content')

  <div class = "row">
      <div class="col-md-8">
        <h1>{{ $item->title }}</h1> <!-- bracket-bang-bang does not echo the contents -->
        <p class="lead">{{ $item->description }}</p>
        <hr>
    
      </div>

      <div class="col-md-4">
          <div class="card card-body bg-light">

            <dl class="dl-horizontal">
              hihihihih
              <div class="item"><div class = "product-card"><img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" alt="thumbnail"/> <h3><a href="{{ route('store.single', $item->slug) }}">{{$item->title}}</a></h3><br /> <p class = "price">${{$item->price}}</p><br /> <button>Buy Now</button></div></div>
              <p><a href="{{ url('store/'.$item->slug) }}"> {{url('store/'.$item->slug)}}</a></p>
            </dl>

            <hr>

            <div class="row">
                <div class="col-md-6">
                  <!-- https://laravel.com/api/4.2/Illuminate/Html/HtmlBuilder.html#method_linkRoute -->
                   Hi1
                </div>
                <div class="col-md-6">
                    Hi2
                </div>
            </div>
            <div class="row">
                  <div class="col-md-12">
                      {!! Html::linkRoute('store.index', '<< Back to store', [], array('class' => 'btn btn-outline-secondary btn-block')) !!}
                  </div>
            </div>
          </div>
      </div>

  </div>

@endsection

