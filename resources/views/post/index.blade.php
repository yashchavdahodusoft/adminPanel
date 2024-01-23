<x-layout-app>
    <x-head title="Post"></x-head>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Posts</h4>
                <div class="d-flex justify-content-end">
                    <a class="text-decoration-none text-white" href="{{ route('post.create') }}"><button
                            class="btn btn-primary">Add
                            Record
                            +</button></a>
                </div>
                <div class="table-responsive">
                  
                </div>
            </div>
        </div>
    </div>
</x-layout-app>
