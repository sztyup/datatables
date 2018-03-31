"columns": [
    @foreach($datatable->columnBuilder->getColumns() as $column)
        @include($column->getOptionsTemplate())
    @endforeach
]