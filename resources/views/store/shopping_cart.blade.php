@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Shopping Cart
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}

@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')

<div class="row">

  <div class="col-md-10">
    <table class="table">

  <tr>
    <th>Name</th>
    <th>Adjust Quantity</th>
    <th>Price</th>
    <th>Actions</th>
  </tr>
  </div>

</div>

<div class="row">


    @foreach ($records as $record)
    <tr>
      {{-- ITEM ONE --}}
      <td>{{ $record->title }}</td>
      
     

      {{-- ITEM TWO - THE INPUT FIELD --}}
      <td>
        {!! Form::model($record , ['route' => 'shopping_cart.update_cart', 'method'=>'PUT', 'data-parsley-validate' => '']) !!}
        {{ Form::hidden('cart_id', $record->item_id)}}
        {{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
                        'data-parsley-required'=>'']) }}
          
      </td>   

      {{-- ITEM THREE - THE PRICE --}}
      <td>
        ${{ $record->price * $record->quantity }}
      </td>
      
      {{-- ITEM FOUR - THE BUTTONS FOR BOTH FORMS --}}
      <td>      
        {{ Form::submit('Update', ['class'=>'btn btn-block btn-outline-primary min-button-width max-button-height no-b-radius', 'style'=>'margin-top:0px']) }}  
        {!! Form::close() !!}   
      </td>       

      <td>
        {!! Form::open(['route' => ['shopping_cart.remove_item', $record->item_id], 'method'=>'DELETE']) !!}
        {{  Form::submit('Remove', ['class'=>'btn btn-outline-danger btn-block min-button-width max-button-height no-b-radius ml-1', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
        {!! Form::close() !!}  
      </td>
         
    </tr>
        
    @endforeach  
  </div> {{-- end second row --}}
  
</table>

<h1>Total: ${{$total}}</h2> 



@endsection