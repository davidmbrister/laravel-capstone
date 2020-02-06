@extends('public')

@section('content')

<div class = "row" >
    <div class = "col-md-3">
       
        <div class = "card storeNav">
            <a class="dropdown-item" href="{{route('categories.index')}}">Categories</a>
     {{--        <div class="dropdown-divider"></div> --}}
        </div>

    </div>

</div>


@stop