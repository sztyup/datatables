"searchCols": [
@foreach ($datatable->columnBuilder->getColumns() as $column)
    @if (isset($column->filter->initialSearch) && count($column->filter->initialSearch) > 0)
        {"search" : "{{ $column->filter->initialSearch }}"}
    @else
    null
    @endif
@endforeach
]
