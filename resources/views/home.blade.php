@extends('layouts/app')

@section('title')
    Home Page | GBI JelTim
@endsection

@section('content')

<div class="container-fluid bg-light p-5">
  <h3>Welcome To GBI JelTim</h3>
  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, ut recusandae eaque ipsa voluptatibus in iusto et dicta. Velit, est.</p>
  <hr>
  <a href="{{url('blog/all')}}" class="btn btn-primary">Explore All Blog</a>
</div>

  {{-- kalo user blm login
  @guest
    <h4 class="text-center mt-4">Welcome To GBI</h4>   --}}

  {{-- validasi user --}}
    {{-- @else
      @if (Auth::user()->role == 'Admin')
        <h4 class="text-center mt-4">Hello, Admin {{Auth::user()->name}}</h4>
      @else 
        <h4 class="text-center mt-4">Hello, Member {{Auth::user()->name}}</h4> 
      @endif
  @endguest --}}

@endsection