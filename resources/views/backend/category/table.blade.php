@foreach($datas as $data)
<tr>
    <td>
        <img src="{{ $data->photo ? asset('images/category_images/'.$data->photo) : asset('assets/images/placeholder.png') }}" alt="Image Not Found">
    </td>
    <td>
        {{ $data->name_en }}
    </td>
    <td>
        {{ $data->name_hin }}
    </td>
    <td>
        {{ $data->name_frn }}
    </td>
    <td>

        <div class="dropdown">
            <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{  $data->status == 1 ? __('Enabled') : __('Disabled')  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('admin.category.status',[$data->id,1]) }}">{{ __('Enable') }}</a>
              <a class="dropdown-item" href="{{ route('admin.category.status',[$data->id,0]) }}">{{ __('Disable') }}</a>
            </div>
          </div>

        </div>

    </td>
    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="{{ route('admin.category.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('admin.category.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
