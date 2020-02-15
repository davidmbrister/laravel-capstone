@extends('common') 

@section('pagetitle')
Create Item
@endsection

@section('pagename')
Laravel Project
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector:'textarea',
		plugins: 'link code',
		menubar: 'false'
	});
</script>
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}

@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h1>Add New Item</h1>
			<hr/>

			  {!! Form::open(['route' => 'items.store', 'data-parsley-validate' => '', 
			                  'files' => true]) !!}
			    
				{{ Form::label('title', 'Name:') }}
			  {{ Form::text('title', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'', 
											  'data-parsley-maxlength'=>'255']) }}
				{{ Form::label('category_id', 'Category:', ['style'=>'margin-top:20px']) }}
				<select name='category_id' class='form-control' data-parsley-required="true">
					<option value="">Select Category</option>
					@foreach ($categories as $category)
						<option value='{{ $category->id }}'>{{ $category->name }}</option>
					@endforeach
				</select>

        {{ Form::label('description', 'Description:', ['class'=>'form-spacing-top']) }}
        {{ Form::textarea('description', null, ['class'=>'form-control ']) }}

				{{ Form::label('price', 'Price:', ['class'=>'form-spacing-top']) }}
        {{ Form::text('price', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'']) }}

				{{ Form::label('quantity', 'Quantity:', ['class'=>'form-spacing-top']) }}
        {{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
											  'data-parsley-required'=>'']) }}
											  
				{{ Form::label('sku', 'SKU:', ['class'=>'form-spacing-top']) }}
        {{ Form::text('sku', null, ['class'=>'form-control', 'style'=>'', 
                        'data-parsley-required'=>'']) }}
                        
        {{ Form::label('slug', 'Slug:', ['class'=>'form-spacing-top']) }}
        {{ Form::text('slug', null, ['class'=>'form-control', 'style'=>'', 
                        'data-parsley-required'=>'', 'minlength' => '5', 'maxlength' => '255']) }}
                        
				{{ Form::label('picture', 'Picture:', ['class'=>'form-spacing-top']) }}
        {{ Form::file('picture', null, ['class'=>'form-control', 
				                                       'style'=>'',
                             'data-parsley-required'=>'']) }}
                             
        

        {{ Form::submit('Create Item', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'']) }}

			{!! Form::close() !!}

		</div>
	</div>

@endsection