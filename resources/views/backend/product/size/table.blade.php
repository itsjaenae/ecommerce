@foreach($datas as $data)
    <tr>
        <td>
            {{ $data->size}}
        </td>
        <td>
            <div class="action-list">
                <a class="btn btn-secondary btn-sm "
                    href="{{ route('admin.size.edit',[$data->id]) }}">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('admin.size.destroy',[$data->id]) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
  
@endforeach
{{-- <tr class="text-center">
    <td colspan="3">
        <a class="btn btn-secondary btn-sm "
        href="{{ route('admin.option.index',$datas->id) }}">
        <i class="fas fa-tasks"></i> {{ __('Manage Options') }}
    </a>
    </td>
</tr> --}}