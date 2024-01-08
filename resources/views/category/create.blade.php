<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        
                    </div>
                    <div class="modal-body">
                        <form id="saveForm" action="javascript:void(0)" method="post">
                            @csrf
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary" onclick="saveRecord(this)"
                            data-url="{{ route('category.store') }}">Save
                            </button>
                    </div>
                </div>
            </div>
        </div>