

@foreach($datas as $data)
    <tr>
       
        <td>
            {{ $data->name}}
        </td>
        {{-- <td>
            {{ $data->size }}
        </td> --}}

         {{--  @foreach($pdatas as $datas)--}}
        <td>
            <div class="action-list">
                <a class="btn btn-secondary btn-sm "
                    href="{{ route('admin.attribute.edit',[$product->id,$data->id]) }}">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
              {{-- <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('admin.attribute.destroy',[$data->id]) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>  --}}
            </div>
        </td>  
       {{--    @endforeach
        <td>
       
                <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('admin.attribute.destroy',[$product->id]) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td> --}}
        
    </tr>
  
@endforeach
<tr class="text-center">
    <td colspan="3">
        <a class="btn btn-secondary btn-sm "
        href="{{ route('admin.option.index',$product->id) }}">
        <i class="fas fa-tasks"></i> {{ __('Manage Options') }}
    </a>
    </td>
</tr>