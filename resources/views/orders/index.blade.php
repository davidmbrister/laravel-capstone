@extends('public') 

@section('pagetitle')
All Orders
@endsection

@section('pagename')
Orders
@endsection

@section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Orders {{-- the order number needs to passed from the controller --}}</h1><br /> <br />
    
  </div>
</div>


@foreach ($records as $record)
<h3 style="color:black;">Order #: <a href="{{route('store.singleOrder',['order_id' => $record->order_id])}}"> {{$record->order_id}} </a>  </h3> 
<h3 style="color:black;"">Customer: {{$record->fName}} {{$record->lName}} </h3> <br />
@endforeach  
    </table>


@endsection