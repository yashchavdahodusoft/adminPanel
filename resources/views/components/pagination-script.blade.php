<script type="text/javascript">
    $('document').ready({
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
</script>
