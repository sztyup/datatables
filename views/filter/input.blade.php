@section('html')
    <input type="{{ $column->filter->type }}"
           id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}"
           class="sg-datatables-individual-filtering@if($column->filter->classes){{ $column->filter->classes }}@endif
           @if($column->width)style="width:{{ $column->width }};"@endif
            @if($column->filter->placeholder)
                placeholder="@if($column->filter->placeholderText){{ $column->filter->placeholderText }}@else{{ $column->title }}@endif
            @endif
           data-search-column-index="{{ $search_column_index }}"
            @if($column->name)name="{{ $column->name }}"@endif
            @if('number' == $column->filter->type || 'range' == $column->filter->type)
                min="{{ $column->filter->min }}" max="{{ $column->filter->max }}" step="{{ $column->filter->step }}"
                @if($column->filter->datalist)
                    list="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-datalist"
                @endif
            @endif
            @if($column->filter->initialSearch)value="{{ $column->filter->initialSearch }}"@endif
    />
    @if('number' == $column->filter->type || 'range' == $column->filter->type)
        @if($column->filter->datalist)
            <datalist id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-datalist">
                @foreach ($column->filter->datalist as $name)
                    <option>{{ $name }}</option>
                @endforeach
            </datalist>
        @endif
    @endif
    @if ($column->filter->cancelButton)
        <button type="button"
                id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}"
                class="btn btn-default btn-xs"
        >&times;</button>
    @endif
    @if('number' == $column->filter->type || 'range' == $column->filter->type)
        @if($column->filter->showLabel)
            <span id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-range-label"></span>
        @endif
    @endif
@endsection

{% block javascript %}
@if ($column->filter->cancelButton)
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

    @if('number' == $column->filter->type || 'range' == $column->filter->type)
        @if($column->filter->showLabel)
            <script type="text/javascript">
                var interval;

                $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-range-label").html($("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val());

                $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").mousedown(function(event) {
                    interval = setInterval(function() {
                        $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-range-label").html($("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val());
                    }, 15);
                });

                $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").mouseup(function(event) {
                    clearInterval(interval);
                });

                $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").change(function(event) {
                    $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}-range-label").html($("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val());
                });
            </script>
        @endif
    @endif
{% endblock %}
