$(".{!! $column_class_editable_selector !!}").editable({
    url: '@route($editable_options->url)',
    params: function (params) {
        params.entityClassName = '{{ $entity_class_name }}';
        params.token = '{{ csrf_token() }}';
        params.originalTypeOfField = '{{ $original_type_of_field }}';
        params.path = $(this).editable().data('path');

        @if ($editable_options->params)
            @foreach ($editable_options->params as $key => $param)
                params.{{ $key }} = '{{ $param }}';
            @endforeach
        @endif

        return params;
    },
    @if ($editable_options->defaultValue)
    defaultValue: '{{ $editable_options->defaultValue }}',
    @endif
    emptyclass: '{!! $editable_options->emptyClass !!}',
    emptytext: '{!! $editable_options->emptyText !!}',
    highlight: '{!! $editable_options->highlight !!}',
    mode: '{{ $editable_options->mode }}',
    @if ($editable_options->name)
    name: '{{ $editable_options->name }}',
    @else
    name: '{{ $column_dql }}',
    @endif
    type: '{{ $editable_options->type }}',
    @if ($editable_options->source)
    source: {!! $editable_options->source !!},
    @endif
    @if ($editable_options->clear)
    clear: {{ $editable_options->clear }},
    @endif
    @if ($editable_options->placeholder && $editable_options->placeholder)
    placeholder: '{!! $editable_options->placeholder !!}',
    @endif
    @if ($editable_options->rows)
    rows: {{ $editable_options->rows }},
    @endif
    @if ($editable_options->format)
    format: '{{ $editable_options->format }}',
    @endif
    @if ($editable_options->viewFormat && $editable_options->viewFormat)
    viewformat: '{{ $editable_options->viewFormat }}',
    @endif

    @if ($editable_options->type == 'combodate')
        combodate: {
            minYear: {{ $editable_options->minYear }},
            maxYear: {{ $editable_options->maxYear }},
            minuteStep: {{ $editable_options->minuteStep }},
            secondStep: {{ $editable_options->secondStep }},
            smartDays: {{ $editable_options->smartDays }},
        },
    @endif

    success: function() {
        if (pipeline > 0) {
            oTable.clearPipeline().draw();
        } else {
            oTable.draw();
        }
    }
});
