"searchCols": [
@foreach ($datatable->columnBuilder->getColumns() as $column)
    @if (method_exists($column, 'getFilter') && isset($column->getFilter()->initialSearch) && count($column->getFilter()->initialSearch) > 0)
        {"search" : "{{ $column->getFilter()->initialSearch }}"}
    @else
        null
    @endif,
@endforeach
]
