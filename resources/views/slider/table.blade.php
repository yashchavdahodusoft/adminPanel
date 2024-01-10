<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td><img src="{{asset('storage/'.$slider->image)}}" alt="image"></td>
                <td>
                    <a href="javascript:void(0)" onclick="editRecord(this)"
                        data-url="{{ route('slider.edit', $slider) }}"
                        class="btn btn-inverse-primary btn-rounded btn-icon">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <button onclick="removeRecord(this)" data-token="{{ csrf_token() }}"
                        data-url="{{ route('slider.destroy', $slider) }}"
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
