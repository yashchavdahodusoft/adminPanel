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
