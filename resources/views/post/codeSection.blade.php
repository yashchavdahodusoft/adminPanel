<div id="row_{{ $row_number }}">
    <div class="row p-3 rounded" id="createCode" style="background-color:#0000001A;">
        <div class="d-flex justify-content-end">
            <button class="btn btn-danger" type="button" onclick="removeCodeRow('{{ $row_number }}')">Remove</button>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="code_title_{{ $row_number }}">Code Title</label>
                <input type="text" name="code_title_{{ $row_number }}" id="code_title_{{ $row_number }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="code_language_{{ $row_number }}">Code Language</label>
                <select name="code_language_{{ $row_number }}" id="code_language_{{ $row_number }}"
                    class="form-control form-select" onchange="">
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
                <label for="code_description_{{ $row_number }}">Code Description</label>
                <textarea class="form-control" name="code_description_{{ $row_number }}" id="code_description_{{ $row_number }}"
                    cols="30"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="code_content_{{ $row_number }}">Code</label>
                <textarea name="code_content_{{ $row_number }}" class="form-control" id="code_content_{{ $row_number }}"></textarea>
                <input type="hidden" name="code_key_{{ $row_number }}" value="{{ $row_number }}">
            </div>
        </div>
    </div>
    <script>
        const codeInput_{{ $row_number }} = document.getElementById('code_content_{{ $row_number }}');
        const editor_{{ $row_number }} = CodeMirror.fromTextArea(codeInput_{{ $row_number }}, {
            lineNumbers: true,
            matchBrackets: true,
            mode: 'javascript',
        });

        editor_{{ $row_number }}.on('change', function() {
            $('#code_content_{{ $row_number }}').val(editor_{{ $row_number }}.getValue());
        });
    </script>
</div>
