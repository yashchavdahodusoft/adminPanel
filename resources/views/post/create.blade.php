<x-layout-app>
    <style>
        .ck.ck-content {
            height: 50vh;
        }

        .ck-balloon-panel {
            z-index: 9999 !important
        }
    </style>
    <x-head title="Create Post"></x-head>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/mode/javascript/javascript.min.js"></script>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">Add Post</h4>
                <form id="saveForm" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="image">Slider Image</label>
                                <input type="file" name="image" id="image" accept="image/*" class="form-control h-25">
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
                    <div class="my-2 d-flex justify-content-between">
                        <h5 class="card-title">Code Section</h5>
                        <button class="btn btn-primary" type="button" onclick="addCodeSection()">Add Block</button>
                    </div>

                    <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code_title_{{$row_id}}">Code Title</label>
                                <input type="text" name="code_title_{{$row_id}}" id="code_title_{{$row_id}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code_language_{{$row_id}}">Code Language</label>
                                <select name="code_language_{{$row_id}}" id="code_language_{{$row_id}}" class="form-control form-select"
                                    onchange="">
                                    <option selected disabled>Select Language</option>
                                    <option value="html">Html</option>
                                    <option value="css">Css</option>
                                    <option value="javascript">Js</option>
                                    <option value="php">Php</option>
                                    <option value="java">Java</option>
                                    <option value="python">Python</option>
                                    <option value="ruby">Ruby</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="code_description_{{$row_id}}">Code Description</label>
                                <textarea class="form-control" name="code_description_{{$row_id}}" id="code_description_{{$row_id}}" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="code_content_{{$row_id}}">Code</label>
                                <textarea required name="code_content_{{$row_id}}" class="codeInput form-control" id="code_content_{{$row_id}}"></textarea>
                                <input type="hidden" name="code_key_{{$row_id}}" value="{{$row_id}}">
                            </div>
                        </div>
                    </div>
                    <div id="otherRows"></div>

                    <div class="mt-4 d-flex justify-content-between">
                        <h5 class="card-title">Output Section</h5>
                    </div>

                    <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea name="output" class="codeInput form-control" id="output"></textarea>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <input type="hidden" id="row_number" value="1">
                    <button type="button" class="btn btn-primary" onclick="savePost(this)"
                        data-url="{{ route('post.store') }}">Save
                    </button>
                </div>
            </div>


        </div>
        {{-- <script type="text/javascript">
            
        </script> --}}
        <x-custom-script>

            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                    },
    
                })
                .then(editor => {
                    editor.model.document.on('change', () => {
                        const editorContent = editor.getData();
                        $('#description').val(editorContent);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
    
            const codeInput_{{$row_id}} = document.getElementById('code_content_{{$row_id}}');
            const editor_{{$row_id}} = CodeMirror.fromTextArea(codeInput_{{$row_id}}, {
                lineNumbers: true,
                matchBrackets: true,
                mode: 'javascript',
            });
    
            editor_{{$row_id}}.on('change',function(){
                $('#code_content_{{$row_id}}').val(editor_{{$row_id}}.getValue());
            });
    
            const output = document.getElementById('output');
            const editor_output = CodeMirror.fromTextArea(output, {
                lineNumbers: true,
                matchBrackets: true,
                mode: 'javascript',
            });
    
            editor_output.on('change',function(){
                $('#output').val(editor_output.getValue());
            });

           function addCodeSection() {
                $.ajax({
                    url:"{{route('create.code.section')}}",
                    dataType:'html',
                    success: function(html){
                        $('#otherRows').append(html);
                    }
                });
           }
    
           function removeCodeRow(id){
                $('#row_'+id).empty();
           }
           function savePost(btn) {
            url = btn.dataset.url;
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData($('#saveForm')[0]),
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === "success") {
                        notyf.success(response.message);
                        location.reload();
    
                    } else if (response.status === 'error') {
                        notyf.error(response.message);
                    }
                },
                error: function(response) {
                    if (response.status == 422) {
                        showValidationErrors(response);
                    }
                }
            });
        }
        </x-custom-script>
    </div>
</x-layout-app>
