@extends('layouts.app')

@section('title','Informations Searched | GBI JELTIM')

@section('content')
@vite("resources/css/app.css")

<div class="container">

    @if ($informations->count() == 0)
    <div class="alert alert-warning">There is no information!</div>
    @else

    <form action="{{route('searchInfo')}}" class="col-md-6 mb-4" method="POST">
        @csrf
        <input type="text" name="searchInput" class="form-control" placeholder="Search Blog">
    </form>
    
      <div class="row">
        @foreach ($informations as $info)
        <div class="col-md-3">
            <div class="col-md-12 rounded shadow mb-3 information">
                <img src="{{'/storage/images/cover/'. $info->cover}}" alt="{{$info->title}}" class="w-100 rounded-top">
                <div class="p-3">
                    <div class="badge bg-info">{{$info->category->title}}</div>
                    <h4>{{$info->title}}</h4>
                    <p>{{$info->description}}</p>
                    <b>Author: <span>{{$info->user->name}}</span></b>
                </div>
            </div>
        </div>
        @endforeach
      </div>

    @endif
</div>
@endsection