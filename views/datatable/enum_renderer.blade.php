var enums = {
@foreach($datatable->columnBuilder->getColumns() as $key => $column)
    @if($column->getColumnType() == 'enum' && count($column->getEnums()) > 0)
        {{ $key }}: {
        @foreach ($column->getEnums() as $key => $value)
            {{ $key }}: "{{ $value }}",
        @endforeach
        }
    @endif
@endforeach
};

var renderer = function (data, type, row, meta) {
    return enums[meta.col][data];
}