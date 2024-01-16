<x-layout-app>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Posts</h4>
                <div class="d-flex justify-content-end">
                    <a class="text-decoration-none text-white" href="{{ route('post.create') }}"><button class="btn btn-primary">Add
                        Record
                        +</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Catagory</th>
                                <th>Sub Catagory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->sub_category->name }}</td>
                                    <td>
                                        <a 
                                           href="{{ route('post.edit', $post) }}"
                                            class="btn btn-inverse-primary btn-rounded btn-icon">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button onclick="removeRecord(this)" data-token="{{ csrf_token() }}"
                                            data-url="{{ route('post.destroy', $post) }}"
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
    
    
</x-layout-app>
