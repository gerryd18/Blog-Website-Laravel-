@extends('layouts.app')

@section('title','Manage Information | GBI JELTIM')


@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    <div class="container">
        <div class=" col-md-8 p-3 rounded shadow">
            <h4>Manage Information</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga velit quaerat, accusantium suscipit nobis officia id consequuntur doloribus omnis voluptates?</p>
            <hr>

            {{-- Create Form Modal --}}
            @if (Auth::user()->role == 'Member')     

                @include('information/create')
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createInformationModal" id="createInformationBtn">Create Information</button>

            @endif

            {{-- success message (dari redirect controller) --}}
            @if (session('success_message'))
                <div class="alert alert-success">{{ session('success_message')}}</div>
            @endif

            
            {{-- Content --}}
            {{-- {{$informations}} --}}
            @if ($informations->count() == 0)
                <div class="alert alert-info">Lets create your information!</div>
            @else
                
                <table class="table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($informations as $info)
                        <tr>
                            <td class="fw-bold" scope="row">{{$loop->iteration}}</td>
                            <td style="width:15% ">
                                <img src="{{asset('storage/images/cover/' . $info->cover)}}" alt="{{$info->title}}" class="w-100 rounded">
                                {{-- karena method asset mengarah ke folder 'public', maka hrs pake php artisan storage:link buat shortcut storage di method public --}}
                            </td>

                            <td>
                                <span class="d-block">{{$info->title}}</span>
                                <span class="badge bg-info">{{$info->category->title}}</span>
                            </td>

                            <td>{{$info->status}}</td>
                            <td>{{$info->description}}</td>
                            <td>{{$info->user->name}}</td>
                            <td class="text-end">
                                @if (Auth::user()->role == 'Member')
                                
                                    <a href="{{route('editInformation' , $info->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                @elseif (Auth::user()->role == 'Admin')

                                    @if ($info->status == 'Pending')
                                        <a href="{{route('acceptInformation' , $info->id)}}" class="btn btn-info btn-sm" onclick="event.preventDefault(); document.getElementById('accept-info{{$info->id}}').submit()">Accept</a>
                                    @endif

                                @endif

                                <a href="{{route('deleteInformation', $info->id)}}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-info{{$info->id}}').submit()">Delete</a>

                                <form action="{{route('deleteInformation', $info->id)}}" class="d-none" id="delete-info{{$info->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <form action="{{route('acceptInformation', $info->id)}}" class="d-none" id="accept-info{{$info->id}}" method="POST">
                                    @csrf
                                    @method('put')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              @endif
            
        </div> 
    </div>
@endsection