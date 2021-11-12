{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);
    //$value = is_array($value) ? json_encode($value) : $value;
    $value = json_decode($value,true);

    //$column['escaped'] = $column['escaped'] ?? true;
    //$column['limit'] = $column['limit'] ?? 40;
    //$column['prefix'] = $column['prefix'] ?? '';
    //$column['suffix'] = $column['suffix'] ?? '';
    //$column['text'] = $column['prefix'].Str::limit($value, $column['limit'], '[...]').$column['suffix'];
@endphp

<span>
    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
    @if(isset($value['color']) && !empty($value['color']))
        <p>- Color: {{ $value['color']['title'] }}</p>
    @endif
    @if(isset($value['size']) && !empty($value['size']))
        <p>- Size: {{ $value['size']['title'] }}</p>
    @endif
    @if(isset($value['type']) && !empty($value['type']))
        <p>- Type: {{ $value['type']['title'] }}</p>
    @endif
    <p></p>
    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
</span>
