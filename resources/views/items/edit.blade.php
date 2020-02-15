@extends('common') 

@section('pagetitle')
Edit Item
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
		<div class=" col-md-7 offset-md-1">
			{!! Form::model($item, ['route' => ['items.update', $item->id], 'method'=>'PUT', 'data-parsley-validate' => '', 'files' => true]) !!}

			<h1>Edit Post</h1>
			<hr/>

			{{ Form::label('title', 'Name:') }}
			{{ Form::text('title', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'', 
											  'data-parsley-maxlength'=>'255']) }}

				{{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
					<select name='category_id' class='form-control' data-parsley-required="true">
						<option value="">Select Category</option>
						@foreach ($categories as $category)
							<option value='{{ $category->id }}' {{ ($category->id == $item->category_id) ? " selected " : "" }}>{{ $category->name }}</option>
						@endforeach
					</select>

			   {{ Form::label('description', 'Description:', ['class' => 'form-spacing-top']) }}
			    {{ Form::textarea('description', null, ['class'=>'form-control']) }}

				{{ Form::label('price', 'Price:', ['class' => 'form-spacing-top']) }}
			    {{ Form::text('price', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'']) }}

				{{ Form::label('quantity', 'Quantity:', ['class' => 'form-spacing-top']) }}
			    {{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
											  'data-parsley-required'=>'']) }}
											  
				{{ Form::label('sku', 'SKU:', ['class' => 'form-spacing-top']) }}
			    {{ Form::text('sku', null, ['class'=>'form-control', 'style'=>'', 
                        'data-parsley-required'=>'']) }}

        {{ Form::label('slug', 'Slug:', ['class'=>'form-spacing-top']) }}
        {{ Form::text('slug', null, ['class'=>'form-control', 'style'=>'', 
                        'data-parsley-required'=>'', 'minlength' => '5', 'maxlength' => '255']) }}

				@if ($item->picture != "")
				    <p style='margin-top:20px'>Current Image:<br><img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" style='height:100px;' ></p>
        @endif

				{{ Form::label('picture', 'Picture:', ['class' => 'form-spacing-top']) }}
			    {{ Form::file('picture', null, ['class'=>'form-control', 
				                                       'style'=>'',
													   'data-parsley-required'=>'']) }}
		
		</div>
		<div class="col-md-4">
			<div class="card card-body bg-light form-spacing-top">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($item->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($item->updated_at)) }}</dd>
				</dl>
				<hr />
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('items.index', 'Cancel', [$item->id], ['class'=>'btn btn-danger btn-block']) !!}
					</div>
					<div class="col-sm-6">
					    {{ Form::submit('Save Changes', ['class'=>'btn btn-success btn-block', 'style'=>'margin-top:0px']) }}
					</div>
				</div>
			</div>		
		</div>
		{!! Form::close() !!}
	</div>


@endsection