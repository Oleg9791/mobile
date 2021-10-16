@extends('Layouts.master')
@section('title','Все категории')
@section('content')

    @foreach($category as $categories)

        <div class="panel">
            <a href="{{ route('categories', $categories->code) }}">
                <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                <h2>{{$categories->name}}</h2>
            </a>
            <p>
                {{$categories->description}}
            </p>

            @endforeach
        </div>
@endsection
