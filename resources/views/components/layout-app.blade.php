<!DOCTYPE html>
<html lang="en">
<x-head>
    <style>
        .ck.ck-content {
            height: 50vh;
        }

        .ck-balloon-panel {
            z-index: 9999 !important
        }
    </style>
</x-head>

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
</body>

</html>
