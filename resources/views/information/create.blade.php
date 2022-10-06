<!-- Modal -->
<div class="modal fade" id="createInformationModal" tabindex="-1" aria-labelledby="createInformationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInformationModalLabel">Create Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        
            {{-- form --}}
            <div class="modal-body">
                <form action="{{route('storeInformation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="categoryTitle" class="form-label">Cover</label>
                        <input  type="file" name="cover"  class="form-control @error('cover') is-invalid @enderror" value="{{old('cover')}}">
                        @error('cover')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input  type="text" name="title"  class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" placeholder="input information title">
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
                        <input  type="text" name="description"  class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" placeholder="input information description">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Content</label>

                        <textarea name="content" cols="30" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="input content" value="{{old('content')}}"> {{{ old('content') }}}</textarea>

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
    </div>
</div>

