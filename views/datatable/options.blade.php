@if ($datatable->options->deferLoading)
    "deferLoading": {{ $datatable->options->deferLoading }},
@endif
@if ($datatable->options->displayStart)
    "displayStart": {{ $datatable->options->displayStart }},
@endif
@if ($datatable->options->dom)
    "dom": "{!! $datatable->options->dom !!}",
@endif
@if ($datatable->options->lengthMenu)
    "lengthMenu": {!! $datatable->options->lengthMenu !!},
@endif
@if ($datatable->options->order)
    "order": {!! $datatable->options->order !!},
@endif
@if ($datatable->options->orderCellsTop)
    "orderCellsTop": {{ $datatable->options->orderCellsTop }},
@endif
@if ($datatable->options->orderClasses)
    "orderClasses": {{ $datatable->options->orderClasses }},
@endif
@if ($datatable->options->orderFixed)
    "orderFixed": {!! $datatable->options->orderFixed !!},
@endif
@if ($datatable->options->orderMulti)
    "orderMulti": {{ $datatable->options->orderMulti }},
@endif
@if ($datatable->options->pageLength)
    "pageLength": {{ $datatable->options->pageLength }},
@endif
@if ($datatable->options->pagingType)
    "pagingType": "{{ $datatable->options->pagingType }}",
@endif
@if ($datatable->options->renderer)
    "renderer": "{{ $datatable->options->renderer }}",
@endif
@if ($datatable->options->retrieve)
    "retrieve": {{ $datatable->options->retrieve }},
@endif
@if ($datatable->options->rowId)
    "rowId": "{{ $datatable->options->rowId }}",
@endif
@if ($datatable->options->scrollCollapse)
    "scrollCollapse": {{ $datatable->options->scrollCollapse }},
@endif
@if ($datatable->options->searchDelay)
    "searchDelay": {{ $datatable->options->searchDelay }},
@endif
@if ($datatable->options->stateDuration)
    "stateDuration": {{ $datatable->options->stateDuration }},
@endif
@if ($datatable->options->stripeClasses)
    "stripeClasses": {!! $datatable->options->stripeClasses !!},
@endif
