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
      <h1>All Categories</h1>
  </div>
  <div class="col-md-2">
  <a href="{{route('categories.create')}}" class="btn btn-small btn-primary btn-h1-spacing">Create New </a>
  <hr>
  </div>
</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Created At</th>
					<th>Last Modified</th>
					<th></th>
        </thead>
        

				<tbody>

					@foreach ($categories as $category)
						<tr>
							<th>{{ $category->id }}</th>
                  <td>{{ $category->name }}</td>
                  <td>{{date('M j, Y',strtotime($category->created_at))}}</td>
                  <td>{{date('M j, Y',strtotime($category->updated_at))}}</td>
                  <td class="btn-group"> <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-block btn-outline-primary min-button-width no-b-radius">Edit</a> 
							
                      @if (!$category->item()->exists())
                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method'=>'DELETE']) !!}
                        {{  Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-block min-button-width no-b-radius ml-1', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
                        {!! Form::close() !!}	
                      @endif
              
                  </td>
						</tr>
          @endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-12 -->
  </div>
 

@endsection