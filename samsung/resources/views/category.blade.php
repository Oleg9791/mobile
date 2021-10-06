@extends('master')
@section('title','Все категории')
@section('content')

    <div class="starter-template">
        @foreach($category as $categories)

            <div class="panel">
                <a href="{{ route('categories', $categories->code) }}">
                    <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                    <h2>{{$categories->name}}</h2>
                </a>
                <p>
                    {{$categories->description}}
                </p>
            </div>

        @endforeach
    </div>
@endsection
