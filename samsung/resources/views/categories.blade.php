@extends('master')

@section('title','Категория'.$categories->name)

@section('content')
    <div class="starter-template">
        <h1>
            {{$categories->name}} {{$categories->products->count()}}
        </h1>
        <p>
            {{$categories->description}}
        </p>
        <div class="row">
            @foreach($categories->products as $product)
                @include('card',compact('product'))
            @endforeach
        </div>
    </div>
@endsection
