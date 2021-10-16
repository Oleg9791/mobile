@extends('Layouts.master')

@section('title','Категория: '.$categories->name)

@section('content')
    <h1>
        {{$categories->name}} {{$categories->products->count()}}
    </h1>
    <p>
        {{$categories->description}}
    </p>
    <div class="row">
        @foreach($categories->products as $product)
            @include('Layouts.card',compact('product'))
        @endforeach
    </div>
@endsection
