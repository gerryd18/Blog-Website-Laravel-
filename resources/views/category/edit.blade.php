@extends('layouts.app');


@section('title')
    Edit Category | GBI JELTIM 
@endsection


@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <div class="container">
        <div class=" col-md-6 p-3 rounded shadow">
            <h4>Edit Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga velit quaerat, accusantium suscipit nobis officia id consequuntur doloribus omnis voluptates?</p>
            <hr>


            {{-- Content --}}
            <form action="{{route('updateCategory', $category->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="categoryTitle" class="form-label">Category Title</label>
                    <input  type="text" name="categoryTitle"  class="form-control @error('categoryTitle') is-invalid @enderror" placeholder="Input category title" value="{{old('categoryTitle') != 0 ? old('categoryTitle') : $category->title }}" >
                    @error('categoryTitle')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-primary btn-sm" type="submit"> Submit </button>
                </div>
            </form>

           
        </div> 
    </div>
@endsection