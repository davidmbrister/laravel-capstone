@extends('public')

@section('pagetitle')
Shopping Cart 
@endsection

@section('pagename')
Shopping Cart
@endsection

@section('scripts')
<script>
  window.ParsleyConfig = {
      errorsWrapper: '<div></div>',
      errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
      errorClass: 'has-error',
      successClass: 'has-success'
  };
</script>
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')

<div class="row">
  <div class="col-md-10">
      <h1>Items in Cart</h1>
  </div>
</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>Name</th>
          <th>Adjust Quantity</th>
          <th>Price</th>
					<th>Actions</th>
					<th></th>
        </thead>
        

				<tbody>

					@foreach ($records as $record)
						<tr>
              {{-- {{ dd(request()) }} --}}
              {{-- {!! Form::model($record, ['route' => ['shopping_cart.update_cart'], 'method' => 'PUT', 'data-parsley-validate' => '', 'data-parsley-pattern' => '/[1-9]/'])!!} --}}
              {!! Form::open(['route' => 'shopping_cart.update_cart', 'data-parsley-validate' => '', 'method' => 'PUT'])!!}
              {{ Form::hidden('cart_id', $record->item_id)}}
              <th>{{ $record->title }}</th>
              
              <td>
                {{ Form::text('quantity', $record->quantity, ['class' => 'form-control', 
                'data-parsley-required' => '',   
                'style'=>''])}} 
              {{-- <input type="text" class="form-control" name="quantity" data-parsley-required="true" value=""> --}}
              {{-- {{ dd(request()) }} --}}
                 
              </td>
              <td>${{ $record->price * $record->quantity }}</td>
                 
              <td class="btn-group"> 
                {{-- The update button will need to use the patch method and go the update_cart route --}} 
                {{ Form::submit('Update', ['class'=>'btn btn-block btn-outline-primary min-button-width max-button-height no-b-radius', 'style'=>'']) }}
               {{--  {{  Form::button('Update', ['type' => 'submit', 'class'=>'btn btn-block btn-outline-primary min-button-width max-button-height no-b-radius', 'style'=>'']) }} --}}
                {!! Form::close() !!}	

                {!! Form::open(['route' => ['shopping_cart.remove_item', $record->item_id], 'method'=>'DELETE']) !!}
                {{  Form::submit('Remove', ['class'=>'btn btn-outline-danger btn-block min-button-width max-button-height no-b-radius ml-1', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
                {!! Form::close() !!}	
              
          
              </td>
						</tr>
          @endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-12 -->
  </div>
@endsection

