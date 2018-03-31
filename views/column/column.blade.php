{
@if ($column->getCellType())
    "cellType": "{{ $column->getCellType() }}",
@endif
@if ($column->getContentPadding())
    "contentPadding": "{{ $column->getContentPadding() }}",
@endif
@if ($column->getDefaultContent())
    "defaultContent": "{{ $column->getDefaultContent() }}",
@endif
@if ($column->getName())
    "name": "{{ $column->getName() }}",
@endif
@if ($column->getWidth())
    "width": "{{ $column->getWidth() }}",
@endif
@if ($column->getTitle())
    "title": "{!! $column->getTitle() !!}",
@endif
@if ($column->getSearchable() == true || $column->getSearchable() == false)
    "searchable": {{ $column->getSearchable() ? 'true' : 'false' }},
@endif
@if ($column->getVisible() == true)
    "visible": true,
    @if ($column->getClassName())
        "className": "{{ $column->getClassName() }}",
    @endif
@endif
@if ($column->getVisible() == false)
    "visible": false,
    "className": "never @if ($column->getClassName()){{ $column->getClassName() }}@endif",
@endif
@if ($column->getOrderable() == false)
    "orderable": true,
    @if ($column->getOrderSequence())
        "orderSequence": {!! $column->getOrderSequence() !!},
    @endif
    @if ($column->getOrderData())
        "orderData": {{ $column->getOrderData() }},
    @endif
@endif
@if ($column->getOrderable() == false)
    "orderable": false,
@endif
@if ($column->getResponsivePriority())
    "responsivePriority": {{ $column->getResponsivePriority() }},
@endif

"data": "{{ $column->getData() }}",
},
