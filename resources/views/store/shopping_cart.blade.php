@extends('public')

@section('pagetitle')
Shopping Cart 
@endsection

@section('pagename')
Shopping Cart
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
          <th>Quantity</th>
          <th>Price</th>
					<th>Actions</th>
					<th></th>
        </thead>
        

				<tbody>

					@foreach ($records as $record)
						<tr>
             
              {!! Form::open(['route' => ['shopping_cart.update_cart', $record->item_id], 'method' => 'PATCH', 'data-parsley-validate' => ''])!!}
              <th>{{ $record->title }}</th>
              
              <td>{{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
                'data-parsley-required'=>'']) }}
              </td>
              <td>${{ $record->price * $record->quantity }}</td>
                 
              <td class="btn-group"> 
                {{-- The update button will need to use the patch method and go the update_cart route --}} 
                 
                {{  Form::button('Update', ['type' => 'submit', 'class'=>'btn btn-block btn-outline-primary min-button-width max-button-height no-b-radius', 'style'=>'']) }}
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

