@foreach($datas as $data)
<tr>
    <td>
        {{ $data->name_en }}
    </td>
    <td>
        <img src="{{ $data->photo ? asset('images/brand_images/'.$data->photo) : asset('assets/images/placeholder.png') }}" alt="Image Not Found">
    </td>
    <td>
        {{ $data->slug_en }}
    </td>
    <td>
        <div class="dropdown">
            <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{  $data->status == 1 ? __('Enabled') : __('Disabled')  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('admin.brand.status',[$data->id,1,'status']) }}">{{ __('Enable') }}</a>
              <a class="dropdown-item" href="{{ route('admin.brand.status',[$data->id,0,'status']) }}">{{ __('Disable') }}</a>
            </div>
        </div>
    </td>
    <td>
        <div class="dropdown">
            <button class="btn btn-{{  $data->is_popular == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{  $data->is_popular == 1 ? __('Enabled') : __('Disabled')  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('admin.brand.status',[$data->id,1,'is_popular']) }}">{{ __('Enable') }}</a>
              <a class="dropdown-item" href="{{ route('admin.brand.status',[$data->id,0,'is_popular']) }}">{{ __('Disable') }}</a>
            </div>
        </div>

    </td>
    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="{{ route('admin.brand.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('admin.brand.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
