<x-layout-app>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sub Category</h4>
                <div class="d-flex justify-content-end">
                    <button onclick="createRecord(this)" class="btn btn-primary"
                        data-url="{{ route('sub-category.create') }}">Add Record
                        +</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Catagory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $sub_category)
                                <tr>
                                    <td>{{ $sub_category->id }}</td>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>{{ $sub_category->category->name }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editRecord(this)"
                                            data-url="{{ route('sub-category.edit', $sub_category) }}"
                                            class="btn btn-inverse-primary btn-rounded btn-icon">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button onclick="removeRecord(this)" data-token="{{ csrf_token() }}"
                                            data-url="{{ route('sub-category.destroy', $sub_category) }}"
                                            class="btn btn-inverse-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalDiv">

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            getCurrentPageData();
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                event.preventDefault();

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                dataLoad(page);
            });
        });

        function getCurrentPageData() {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                dataLoad(1)
            } else {
                dataLoad(page)
            }
        }

        function dataLoad(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html",
                })
                .done(function(data) {
                    $(".table-responsive").empty().html(data);
                    location.hash = page;
                });
        }

        function createRecord(btn) {
            var url = btn.dataset.url;
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                    $('#modalDiv').empty().html(response);
                    $('#createModal').modal('show');
                }
            });
        }

        function saveRecord(btn) {
            url = btn.dataset.url;
            $.ajax({
                url: url,
                type: 'POST',
                data: $('#saveForm').serialize(),
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function(response) {
                    if (response.status === "success") {
                        notyf.success(response.message);
                        $('#saveForm').trigger("reset");
                        $('#createModal').modal('hide');
                        getCurrentPageData();
                    }
                }
            });
        }

        function editRecord(btn) {
            var url = btn.dataset.url;
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                    $('#modalDiv').empty().html(response);
                    $('#editModal').modal('show');
                }
            });
        }

        function updateRecord(btn) {
            url = btn.dataset.url;
            $.ajax({
                url: url,
                type: 'PUT',
                data: $('#editForm').serialize(),
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function(response) {
                    if (response.status === "success") {
                        notyf.success(response.message);
                        $('#editForm').trigger("reset");
                        $('#editModal').modal('hide');
                        getCurrentPageData();
                    }
                }
            });
        }

        function removeRecord(btn) {
            url = btn.dataset.url;
            token = btn.dataset.token;
            if (confirm('Are you sure you want to remove this record?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        '_token': token
                    },
                    cache: false,
                    async: false,
                    success: function(response) {
                        if (response.status === "success") {
                            notyf.success(response.message);
                            getCurrentPageData();
                        }
                    }
                });
            }
        }
    </script>
</x-layout-app>
