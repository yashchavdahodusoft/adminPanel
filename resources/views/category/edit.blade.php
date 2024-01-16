<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" action="javascript:void(0)" method="post">
                    @csrf
                    @method('PUT')
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}"
                        class="form-control">
                        <span class="text-danger" id="error_name"></span>
                        <input type="text" name="cat" id="cat" class="form-control">
                    <span class="text-danger" id="error_cat"></span>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateRecord(this)"
                    data-url="{{ route('category.update', $category) }}">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
