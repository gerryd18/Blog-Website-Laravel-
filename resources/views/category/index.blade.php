@extends('layouts.app')

@section('title')
    Manage Category | GBI JELTIM 
@endsection


@section('content')
{{-- @vite('resources/css/category.css'); --}}
    <div class="container">
        <div class=" col-md-6 p-3 rounded shadow">
            <h4>Manage Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga velit quaerat, accusantium suscipit nobis officia id consequuntur doloribus omnis voluptates?</p>
            <hr>

            {{-- Create Form Modal --}}
            {{-- panggil modal --}}
            @include('category/create')
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createCategoryModal" id="createCategoryBtn">Create Category</button>

            {{-- success message --}}
            @if (session('success_message'))
                <div class="alert alert-success">{{ session('success_message')}}</div>
            @endif

            {{-- Content --}}
            <table class="table table-striped mt-3 border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="fw-bold" scope="row">{{$loop->iteration}}</td>
                        <td>{{$category->title}}</td>
                        <td>
                            <a href="{{route('editCategory' , $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{route('deleteCategory', $category->id)}}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-category{{$category->id}}').submit()">Delete</a>

                            <form action="{{route('deleteCategory', $category->id)}}" class="d-none" id="delete-category{{$category->id}}" method="POST">
                                @csrf
                                @method('delete');
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div> 
    </div>
@endsection