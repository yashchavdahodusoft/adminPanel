<x-layout-app>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.3/mode/javascript/javascript.min.js"></script>
    <style>
        .highlight {
            color: blue;
        }
    </style>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">Edit Post</h4>
                <form id="saveForm" action="javascript:void(0)" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $post->title }}">
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
                                        @if ($category->id === $post->category_id)
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
                                        @if ($sub_category->id === $post->sub_category_id)
                                            <option selected value="{{ $sub_category->id }}">{{ $sub_category->name }}
                                            </option>
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
                                <textarea name="description" id="description" class="form-control form-control-lg">{{ $post->description }}</textarea>

                            </div>
                        </div>
                    </div>
                    <div class="my-2 d-flex justify-content-between">
                        <h5 class="card-title">Code Section</h5>

                    </div>
                    <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="button" onclick="addCodeSection()">Add Block</button>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code_title_{{ $row_id }}">Code Title</label>
                                <input type="text" name="code_title_{{ $row_id }}"
                                    id="code_title_{{ $row_id }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code_language_{{ $row_id }}">Code Language</label>
                                <select name="code_language_{{ $row_id }}"
                                    id="code_language_{{ $row_id }}" class="form-control form-select"
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
                                <label for="code_description_{{ $row_id }}">Code Description</label>
                                <textarea class="form-control" name="code_description_{{ $row_id }}"
                                    id="code_description_{{ $row_id }}" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="code_content_{{ $row_id }}">Code</label>
                                <textarea required name="code_content_{{ $row_id }}" class="codeInput form-control"
                                    id="code_content_{{ $row_id }}"></textarea>
                                <input type="hidden" name="code_key_{{ $row_id }}"
                                    value="{{ $row_id }}">
                            </div>
                        </div>
                    </div>
                    @foreach ($codes as $code)
                        @php
                            $rowUniqId = uniqid($code->id);
                        @endphp
                        <div id="row_{{ $rowUniqId }}">
                            <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger" type="button"
                                        onclick="deleteCodeRow('{{ $rowUniqId }}',this)" data-url="{{route('code.delete',$code)}}">Remove</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="code_title_{{ $rowUniqId }}">Code Title</label>
                                        <input type="text" name="code_title_{{ $rowUniqId }}"
                                            value="{{ $code->title }}" id="code_title_{{ $rowUniqId }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="code_language_{{ $rowUniqId }}">Code Language</label>
                                        <select name="code_language_{{ $rowUniqId }}"
                                            id="code_language_{{ $rowUniqId }}" class="form-control form-select"
                                            onchange="">
                                            <option selected disabled>Select Language</option>
                                            <option {{ $code->language == 'html' ? 'selected' : '' }} value="html">
                                                Html
                                            </option>
                                            <option {{ $code->language == 'css' ? 'selected' : '' }} value="css">Css
                                            </option>
                                            <option {{ $code->language == 'javascript' ? 'selected' : '' }}
                                                value="javascript">Js</option>
                                            <option {{ $code->language == 'php' ? 'selected' : '' }} value="php">Php
                                            </option>
                                            <option {{ $code->language == 'java' ? 'selected' : '' }} value="java">
                                                Java
                                            </option>
                                            <option {{ $code->language == 'python' ? 'selected' : '' }} value="python">
                                                Python
                                            </option>
                                            <option {{ $code->language == 'ruby' ? 'selected' : '' }} value="ruby">
                                                Ruby
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="code_description_{{ $rowUniqId }}">Code Description</label>
                                        <textarea class="form-control" name="code_description_{{ $rowUniqId }}" id="code_description_{{ $rowUniqId }}"
                                            cols="30">{{ $code->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="code_content_{{ $rowUniqId }}">Code</label>
                                        <textarea name="code_content_{{ $rowUniqId }}" class="form-control" id="code_content_{{ $rowUniqId }}">{{ $code->content }}</textarea>
                                        <input type="hidden" name="code_key_{{ $rowUniqId }}"
                                            value="{{ $rowUniqId }}">
                                            <input type="hidden" name="code_id_{{$rowUniqId}}" value="{{$code->id}}">
                                    </div>
                                </div>
                            </div>
                            <script>
                                const codeInput_{{ $rowUniqId }} = document.getElementById('code_content_{{ $rowUniqId }}');
                                const editor_{{ $rowUniqId }} = CodeMirror.fromTextArea(codeInput_{{ $rowUniqId }}, {
                                    lineNumbers: true,
                                    matchBrackets: true,
                                    mode: 'javascript',
                                });

                                editor_{{ $rowUniqId }}.on('change', function() {
                                    $('#code_content_{{ $rowUniqId }}').val(editor_{{ $rowUniqId }}.getValue());
                                });
                            </script>
                        </div>
                    @endforeach
                    
                    <div id="otherRows"></div>

                    <div class="mt-4 d-flex justify-content-between">
                        <h5 class="card-title">Output Section</h5>
                    </div>

                    <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea name="output" class="codeInput form-control" id="output">{{ $post->output }}</textarea>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <input type="hidden" id="row_number" value="1">
                    <button type="button" class="btn btn-primary" onclick="savePost(this)"
                        data-url="{{ route('post.update',$post) }}">Save
                    </button>
                </div>
            </div>


        </div>
        {{-- <script type="text/javascript"> --}}
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

            const codeInput_{{ $row_id }} = document.getElementById('code_content_{{ $row_id }}');
            const editor_{{ $row_id }} = CodeMirror.fromTextArea(codeInput_{{ $row_id }}, {
                lineNumbers: true,
                matchBrackets: true,
                mode: 'javascript',
            });

            editor_{{ $row_id }}.on('change', function() {
                $('#code_content_{{ $row_id }}').val(editor_{{ $row_id }}.getValue());
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
                    url: "{{ route('create.code.section') }}",
                    dataType: 'html',
                    success: function(html) {
                        $('#otherRows').append(html);
                    }
                });
            }

            function removeCodeRow(id) {
                $('#row_'+id).remove();
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
                           // location.reload();

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
            function deleteCodeRow(id,btn){
                url = btn.dataset.url;
                if(confirm()){
                    $.ajax({
                        url: url,
                        method:'DELETE',
                        success:function(response){
                            if (response.status === "success") {
                                notyf.success(response.message);
                                $('#row_'+id).remove();
                            }
                        }
                    });
                }
            }
            </x-custom-script>
            {{-- </script>  --}}
                </div>
             </x-layout-app>
