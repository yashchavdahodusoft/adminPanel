<div>
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

    <script type="text/javascript">
        var notyf = new Notyf({
            duration: '3000',
            position: {
                x: 'right',
                y: 'top'
            }
        });

        $("document").ready(function() {
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
</div>
