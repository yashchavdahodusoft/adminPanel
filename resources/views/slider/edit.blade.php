<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <label for="image">Slider Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control h-25">
                        </div>
                        <div class="justify-content-center mt-4">
                            <div class="col-md-8 ">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateRecord(this)"
                    data-url="{{ route('slider.update', $slider) }}">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
