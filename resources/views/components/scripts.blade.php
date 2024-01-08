<div>
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>
    <script type="text/javascript">
        var notyf = new Notyf();
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
    <!-- End custom js for this page-->
</div>
