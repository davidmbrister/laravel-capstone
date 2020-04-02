@extends('public')

@section('pagetitle')
Laravel Storefront 
@endsection

@section('pagename')
Public Store
@endsection


@section('content')

  <div class = "row">
      
    <div class="col-md-4">
          <div class="card card-body bg-light">

            <dl class="dl-horizontal">
              <div class="item" style="text-align: center;">
                <div class = "product-card" style="display: inline-block;"><img src="{{ Storage::url('images/items/'.'lrg_'.$item->picture) }}" alt="thumbnail"/>
                 <a href="{{ route('store.single', $item->slug) }}">
                  <h3>{{$item->title}}</h3>
                </a>
                 <br /> 
                 <p class = "price">${{$item->price}}</p>
                 <br /> 
                 {!!Form::open(['route' => ['store.addToCart', $item->id, 1]])!!}
                 {{ Form::button('Buy Now', ['type' => 'submit', 'class' => 'button', 'style' => 'float: inline-end;'] )  }}
                {!! Form::close() !!}
                </div>
              </div>
              <hr>
              <p>URL: <a href="{{ url('store/product/'.$item->slug) }}">{{url('store/product/'.$item->slug)}}</a></p>
            </dl>

            <hr>

            <div class="row">
                <div class="col-md-6">
                  <!-- https://laravel.com/api/4.2/Illuminate/Html/HtmlBuilder.html#method_linkRoute -->
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                  <div class="col-md-12">
                      {!! Html::linkRoute('store.index', '<< Back to store', [], array('class' => 'btn btn-outline-secondary btn-block')) !!}
                  </div>
            </div>
          </div>
      </div>

      <div class="col-md-8">
        <h1>{{ $item->title }}</h1> <!-- bracket-bang-bang does not echo the contents -->
        <p style="font-size: 1.75em; max-width: 75%;" class="lead">{!! $item->description !!}</p>
        <hr>
    
      </div>

      

  </div>

@endsection

