@extends('public') 

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
      <h1>Shopping Cart</h1>
  </div>
</div>

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
          ${{ number_format($record->price * $record->quantity, 2, '.', '.') }}
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

<h1 style = "float:right;color:black;">Total: ${{ number_format($total, 2, '.', '.') }}</h2> 

<div class="row mt-3">
  <div class="col-md-8">
    <h1>Customer Information</h1>
    <hr/>
    
    {!! Form::open(['route' => ['shopping_cart.check_order'], 'data-parsley-validate' => '']) !!}
        
      {{ Form::label('fName', 'First Name:') }}
      {{ Form::text('fName', null, ['class'=>'form-control', 'style'=>'','data-parsley-required'=>'']) }}

      {{ Form::label('lName', 'Last Name:') }}
      {{ Form::text('lName', null, ['class'=>'form-control', 'style'=>'','data-parsley-required'=>'','data-parsley-maxlength'=>'255']) }} 
       
      {{ Form::label('phone', 'Phone:') }}
      {{ Form::text('phone', null, ['class'=>'form-control', 'style'=>'','data-parsley-required'=>'','data-parsley-maxlength'=>'255']) }}

      {{ Form::label('email', 'Email:') }}
      {{ Form::text('email', null, ['class'=>'form-control', 'style'=>'','data-parsley-required'=>'','data-parsley-type'=>'email', 'data-parsley-maxlength'=>'255']) }}  

      {{ Form::submit('Submit', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'']) }}

    {!! Form::close() !!}

  </div>
</div>





@endsection