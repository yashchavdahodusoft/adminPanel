<x-layout-app>
    <x-head title="Dashboard"></x-head>
    @if ($message = Session::get('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-3 col-lg-3 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                            <div>
                                <p class="text-small mb-2">Total
                                    Categories</p>
                                <h4 class="mb-0 fw-bold">{{ $categoryCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                            <div>
                                <p class="text-small mb-2">Total
                                    Sub Categories</p>
                                <h4 class="mb-0 fw-bold">{{ $subCategoryCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                            <div>
                                <p class="text-small mb-2">Total
                                    Posts</p>
                                <h4 class="mb-0 fw-bold">{{ $postCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</x-layout-app>
