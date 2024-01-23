<x-layout-app>
    <x-head title="Catagory"></x-head>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Category</h4>
                <div class="d-flex justify-content-end">
                    {{-- createRecord(this) --}}
                    <button onclick="createRecord(this)" class="btn btn-primary"
                        data-url="{{ route('category.create') }}">Add Record
                        +</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editRecord(this)"
                                            data-url="{{ route('category.edit', $category) }}"
                                            class="btn btn-inverse-primary btn-rounded btn-icon">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button onclick="removeRecord(this)" data-token="{{ csrf_token() }}"
                                            data-url="{{ route('category.destroy', $category) }}"
                                            class="btn btn-inverse-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalDiv"></div> 
</x-layout-app>
