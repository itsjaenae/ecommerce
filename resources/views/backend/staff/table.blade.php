@foreach($datas as $data)
<tr>
    <td>
        <img class="admin-img"
        src="{{ $data->photo ? asset('images/admin_images/'.$data->photo) : asset('assets/images/placeholder.png') }}"
        alt="No Image Found">
    </td>
    <td>
        {{ $data->name }}
    </td>
    <td>
        {{ $data->role->name }}
    </td>
    <td>
        {{ $data->email }}
    </td>
    <td>
        {{ $data->phone }}
    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="{{ route('admin.staff.edit',$data->id) }}">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('admin.staff.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
