@extends('layouts.app')

@section('title','Edit Information | GBI JELTIM')


@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <div class="container">
        <div class=" col-md-8 p-3 rounded shadow">
            <h4>Edit Information</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga velit quaerat, accusantium suscipit nobis officia id consequuntur doloribus omnis voluptates?</p>
            <hr>
            
            {{-- Content --}}
            <form action="{{route('updateInformation', $info->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="categoryTitle" class="form-label">Cover</label>
                    <input  type="file" name="cover"  class="form-control @error('cover') is-invalid @enderror" >
                    @error('cover') 
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input  type="text" name="title"  class="form-control @error('title') is-invalid @enderror" placeholder="input information title" value="{{old('title') != null ? old('title') : $info->title}}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="category" class="form-label @error('category') is-invalid @enderror">Select Category</label>
                    <select name="category" class="form-control">
                        {{-- pilihan kategori --}}
                        <option selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option> 
                        @endforeach
                    </select>
                   
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input  type="text" name="description"  class="form-control @error('description') is-invalid @enderror" value="{{old('description') != null ? old('description') : $info->description}}" placeholder="input information description">
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label">Content</label>

                    <textarea name="content" cols="30" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="input content" value="{{old('content')}}"> {{{ old('content')!= null ? old('content') : $info->content }}}</textarea>

                    @error('content')
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