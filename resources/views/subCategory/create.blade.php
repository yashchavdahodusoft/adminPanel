<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>

            </div>
            <div class="modal-body">
                <form id="saveForm" action="javascript:void(0)" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Sub Category Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Catagory</label>
                        <select name="category_id" id="category_id" class="form-control form-select">
                            <option selected disabled>Choose Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="saveRecord(this)"
                    data-url="{{ route('sub-category.store') }}">Save
                </button>
            </div>
        </div>
    </div>
</div>
