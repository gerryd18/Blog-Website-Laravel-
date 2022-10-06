<!-- Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        
            {{-- form --}}
            <div class="modal-body">
                <form action="{{route('storeCategory')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="categoryTitle" class="form-label">Category Title</label>
                        <input  type="text" name="categoryTitle"  class="form-control @error('categoryTitle') is-invalid @enderror" placeholder="Input category title"  value="{{old('categoryTitle')}}">
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
    </div>
</div>

