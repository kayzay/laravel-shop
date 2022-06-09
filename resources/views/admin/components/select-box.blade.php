<select
    name="{{$name}}"
    @class([
    'form-control' => !$multiple,
    'select2' => $multiple,
    $class
    ])
    {{($multiple) ? 'multiple ' : ''}}
    style="width: 100%;">
    @if (!empty($data))

        @foreach ($data as $id => $item )
            <option
                value="{{$item['id']}}"
                {{($item['selected'] ? 'selected' : '')}}>
                {{$item['name']}}
            </option>
        @endforeach
    @endif
</select>


