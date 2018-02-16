"columns": [
    @foreach($datatable->columnBuilder->columns as $column)
        @include($column->getOptionsTemplate())
    @endforeach
]