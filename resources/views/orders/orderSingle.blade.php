@extends('common') 

@section('pagetitle')
Single Order
@endsection

@section('pagename')
Order
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
    <h1 style="color:black;">Order Number: {{ $customer->order_id }}</h1><br /> <br />
    
</div>
</div>

<div class="row">
  <div class="col-md-10">
      <h1>Order Details</h1>
  </div>
</div>

<div class="row">

  <div class="col-md-10">
    <table class="table">

    <tr>
      <th>Item</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
  </div>

</div>


@foreach ($records as $record)
  <div class="row">
    <div class="col-md-10">
      <tr>
        {{-- ITEM ONE --}}
        <td>{{ $record->title }}</td>
        {{-- ITEM TWO - THE INPUT FIELD --}}
        <td>
          {{$record->quantity}}
            
        </td>   
        {{-- ITEM THREE - THE PRICE --}}
        <td>
          ${{ number_format($record->price * $record->quantity, 2, '.', '.') }}
        </td>       
      
      </tr>
          
    </div>
  </div> {{-- end second row --}}
      @endforeach  
    </table>
    
    
    
    <div class="row">
      <div class="col-md-10">
        <h3 style = "float:left;color:black;">Total: ${{ number_format($total, 2, '.', '.') }}</h3> <br /> <br />
        <h1>Customer Information</h1>
    </div>
  </div>
 
<div class="row">
  <div class="col-md-8">
    <hr/>
   
    <h3 style="color:black;">First Name: {{$customer->fName}} </h3> <br />
    <h3 style="color:black;"">Last Name: {{$customer->lName}} </h3> <br />
    <h3 style="color:black;"">Phone: {{$customer->phone}} </h3> <br />
    <h3 style="color:black;"">Email: {{$customer->email}} </h3> <br />

  </div>
</div>


@endsection
