<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
                        
                    </div>
                    <div class="modal-body">
                        <form id="saveForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="image">Slider Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control h-25">
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary" onclick="saveRecord(this)"
                            data-url="{{ route('slider.store') }}">Save
                            </button>
                    </div>
                </div>
            </div>
        </div>