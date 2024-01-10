<x-layout-app>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">

                <h4 class="card-title">Add Post</h4>
                <form id="saveForm" action="javascript:void(0)" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="category_id">Catagory</label>
                                <select name="category_id" id="category_id" class="form-control form-select"
                                    onchange="getSubCategories(this.value)">
                                    <option selected disabled>Choose Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="sub_category_id">Sub Catagory</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control form-select">
                                    <option selected disabled>Choose Sub Categories</option>
                                    @foreach ($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control form-control-lg"></textarea>

                            </div>
                        </div>
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#description'), {
                                ckfinder: {
                                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                                }
                            })
                            .then(editor => {
                                editor.model.document.on('change', () => {
                                    const editorContent = editor.getData();
                                    $('#description').val(editorContent);
                                });
                            })
                            .catch(error => {
                                console.error('Error during initialization of CKEditor', error);
                            });
                    </script>
                </form>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" onclick="saveRecord(this)"
                        data-url="{{ route('post.store') }}">Save
                    </button>
                </div>
            </div>


        </div>

    </div>

</x-layout-app>
