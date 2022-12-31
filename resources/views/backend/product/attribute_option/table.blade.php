@foreach($datas as $data)
    <tr>

        <td>
            {{ $data->name }}   
        </td>
 
        <td>   
            {{ $data->attribute }}
        </td>
        <td>
            {{ $data->price == 0 ? __('0') : PriceHelper::adminCurrencyPrice($data->price) }}
        </td>
        <td class="{{$data->stock < 10 && $data->stock != 'unlimited' ? 'bg-danger text-white'  :''}} ">
            @if ($data->stock == '0')
            {{__('Out of Stock')}}
            @else
            {{$data->stock}}
            @endif
        </td>
        <td>
            <div class="action-list">
                <a class="btn btn-secondary btn-sm "
                    href="{{ route('admin.option.edit',[$product->id, $data->id]) }}">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('admin.option.destroy',[$product->id, $data->id]) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
