@section('html')
    <select
            @if($column->filter->multiple)
                multiple="multiple"
            @endif
            id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}"
            class="sg-datatables-individual-filtering@if($column->filter->classes) {{ $column->filter->classes }}@endif"
            @if($column->width)style="width:{{ $column->width }};"@endif
            data-search-column-index="{{ $search_column_index }}"
            @if($column->name)name="{{ $column->name }}"@endif
    >
        @foreach ($column->filter->selectOptions as $key => $name)
            @if($column->filter->initialSearch || $column->filter->initialSearch == $key)
                <option value="{{ $key }}" selected="selected">{{ $name }}</option>
            @else
                <option value="{{ $key }}">{{ $name }}</option>
            @endif
        @endforeach
    </select>

    @if($column->filter->cancelButton)
        <button type="button"
                id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}"
                class="btn btn-default btn-xs"
        >&times;</button>
    @endif
@endsection

@section('javascript')
    @if($column->filter->cancelButton)
        <script type="text/javascript">
            $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}").click(function() {
                if ('' != $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val()) {
                    $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}")
                        .val('')
                        .change();
                }
            });
        </script>
    @endif
@endsection