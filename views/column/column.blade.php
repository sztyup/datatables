{
    @section('common')
        @if ($column->cellType)
            "cellType": "{{ $column->cellType }}",
        @endif
        @if ($column->contentPadding)
            "contentPadding": "{{ $column->contentPadding }}",
        @endif
        @if ($column->defaultContent)
            "defaultContent": "{{ $column->defaultContent }}",
        @endif
        @if ($column->name)
            "name": "{{ $column->name }}",
        @endif
        @if ($column->width)
            "width": "{{ $column->width }}",
        @endif
        @if ($column->title)
            "title": "{!! $column->title !!}",
        @endif
        @if ($column->searchable == true || $column->searchable == false)
            "searchable": {{ $column->searchable }},
        @endif
        @if ($column->visible == true)
            "visible": true,
            @if ($column->className)
                "className": "{{ $column->className }}",
            @endif
        @endif
        @if ($column->visible == false)
            "visible": false,
            "className": "never @if ($column->className){{ $column->className }}@endif",
        @endif
        @if ($column->orderable == false)
            "orderable": true,
            @if ($column->orderSequence)
                "orderSequence": {!! $column->orderSequence !!},
            @endif
            @if ($column->orderData)
                "orderData": {{ $column->orderData }},
            @endif
        @endif
        @if ($column->orderable == false)
            "orderable": false,
        @endif
        @if ($column->responsivePriority)
            "responsivePriority": {{ $column->responsivePriority }},
        @endif
    @endsection

    @section('data')
        "data": "{{ $column->data }}",
    @endsection
},
