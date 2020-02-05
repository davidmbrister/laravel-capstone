@extends('common') 

@section('pagetitle')
Create Category
@endsection

@section('pagename')
Laravel Project
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h1>Add New Category</h1>
			<hr/>

			{!! Form::open(['route' => 'categories.store', 'data-parsley-validate' => '', 
			                'files' => true]) !!}
			    
				{{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'', 
											  'data-parsley-maxlength'=>'100']) }}
        {{ Form::submit('Create Category', ['class'=>'btn btn-success btn-lg btn-block form-spacing-top', 'style'=>'']) }}

			{!! Form::close() !!}

		</div>
	</div>

@endsection