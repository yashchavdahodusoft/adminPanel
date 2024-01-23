<!DOCTYPE html>
<html lang="en">
<x-head title="Dashboard"></x-head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <x-navbar />
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

            <!-- partial:partials/_sidebar.html -->
            <x-side-bar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    {{$slot}}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <x-scripts></x-scripts>
    <script type="text/javascript">
        var notyf = new Notyf({
            duration: '3000',
            position: {
                x: 'right',
                y: 'top'
            }
        });

        $("document").ready(function() {
            getCurrentPageData();
            setTimeout(function() {
                $("div.alert").remove();
            }, 3000);

            $(document).on('click', '.pagination a', function(event) {
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                event.preventDefault();

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                dataLoad(page);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(window).on('hashchange', function() {
            getCurrentPageData();
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
                data: new FormData($('#saveForm')[0]),
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === "success") {
                        notyf.success(response.message);
                        $('#saveForm').trigger("reset");
                        $('#createModal').modal('hide');
                        getCurrentPageData();
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
                type: 'POST',
                data: new FormData($('#editForm')[0]),
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === "success") {
                        notyf.success(response.message);
                        $('#editForm').trigger("reset");
                        $('#editModal').modal('hide');
                        getCurrentPageData();
                    } else if (response.status === 'error') {
                        notyf.error(response.message);
                    }
                }, error: function(response) {
                    if (response.status == 422) {
                        showValidationErrors(response);
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
                        } else if (response.status === 'error') {
                            notyf.error(response.message);
                        }
                        getCurrentPageData();
                    }
                });
            }
        }

        function getSubCategories(catid) {
            $.ajax({
                url: "{{url('sub-category/getSubCategoryByCategoryId')}}/"+catid,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#sub_category_id').html(response);
                }
            });
        }

        function showValidationErrors(response) {
            var errors = response.responseJSON.errors;
            $('*').filter(':input').each(function() {
                $('#error_' + this.id).html('');
            });
            $.each(errors, function(i, item) {
                $('#error_' + i).html(item);
            });
        }
    </script>
</body>

</html>
