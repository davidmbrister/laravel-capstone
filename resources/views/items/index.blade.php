@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')


<div class="row">
  <div class="col-md-10">
      <h1>All Items</h1>
  </div>
  <div class="col-md-2">
  <a href="{{route('items.create')}}" class="btn btn-small btn-primary btn-h1-spacing">Create New</a>
  <hr>
  </div>
</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
          <th>Name</th>
          <th>Image</th>
					<th>Created At</th>
					<th>Last Modified</th>
					<th></th>
        </thead>
        
				<tbody>

					@foreach ($items as $item)
						<tr>
							<th>{{ $item->id }}</th>
                  <td>{{ $item->title }}</td>
                  <td>{{date('M j, Y',strtotime($item->created_at))}}</td>
                  <td>{{date('M j, Y',strtotime($item->updated_at))}}</td>
                  <td><img src="{{ Storage::url('images/items/'.$item->picture) }}" height="75" width="75" /></td>
                  <td class="btn-group"> <a href="{{ route('items.edit', $item->id)}}" class="btn btn-block btn-outline-primary min-button-width no-b-radius">Edit</a> 
							
                      {!! Form::open(['route' => ['items.destroy', $item->id], 'method'=>'DELETE']) !!}
                      {{  Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-block min-button-width no-b-radius ml-1', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
                      {!! Form::close() !!}	    
              
                  </td>
						</tr>
          @endforeach

				</tbody>
			</table>
      	<div class="text-center">
          {!! $items->links(); !!}
        </div>
		</div> <!-- end of .col-md-12 -->
  </div>
  
  @endsection