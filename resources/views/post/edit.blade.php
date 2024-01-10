<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" action="javascript:void(0)" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" value="{{ $post->title }}" id="title"
                                    class="form-control">
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
                                        @if ($category->id == $post->category_id)
                                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
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
                                        @if ($sub_category->id == $post->sub_category_id)
                                            <option selected value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @else
                                            <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control form-control-lg">{{$post->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#description'),{
                                ckfinder:{
                                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
                                }
                            })
                            .then(error=>{
                                editor.model.document.on('change', () => {
                                    const editorContent = editor.getData();
                                    $('#description').val(editorContent);
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateRecord(this)"
                    data-url="{{ route('post.update', $post) }}">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
