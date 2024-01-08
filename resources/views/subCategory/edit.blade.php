<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" action="javascript:void(0)" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Sub Category Name</label>
                        <input type="text" name="name" value="{{ $sub_category->name }}" id="name"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Catagory</label>
                        <select name="category_id" id="category_id" class="form-control form-select">
                            <option selected disabled>Choose Categories</option>
                            @foreach ($categories as $category)
                                @if ($sub_category->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateRecord(this)"
                    data-url="{{ route('sub-category.update', $sub_category) }}">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
