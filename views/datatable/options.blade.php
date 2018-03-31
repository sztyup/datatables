@if ($datatable->options->getDeferLoading())
    "deferLoading": {{ $datatable->options->getDeferLoading() }},
@endif
@if ($datatable->options->getDisplayStart())
    "displayStart": {{ $datatable->options->getDisplayStart() }},
@endif
@if ($datatable->options->getDom())
    "dom": "{!! $datatable->options->getDom() !!}",
@endif
@if ($datatable->options->getLengthMenu())
    "lengthMenu": {!! $datatable->options->getLengthMenu() !!},
@endif
@if ($datatable->options->getOrder())
    "order": {!! $datatable->options->getOrder() !!},
@endif
@if ($datatable->options->isOrderCellsTop())
    "orderCellsTop": {{ $datatable->options->isOrderCellsTop() }},
@endif
@if ($datatable->options->isOrderClasses())
    "orderClasses": {{ $datatable->options->isOrderClasses() }},
@endif
@if ($datatable->options->getOrderFixed())
    "orderFixed": {!! $datatable->options->getOrderFixed() !!},
@endif
@if ($datatable->options->isOrderMulti())
    "orderMulti": {{ $datatable->options->isOrderMulti() }},
@endif
@if ($datatable->options->getPageLength())
    "pageLength": {{ $datatable->options->getPageLength() }},
@endif
@if ($datatable->options->getPagingType())
    "pagingType": "{{ $datatable->options->getPagingType() }}",
@endif
@if ($datatable->options->getRenderer())
    "renderer": "{{ $datatable->options->getRenderer() }}",
@endif
@if ($datatable->options->isRetrieve())
    "retrieve": {{ $datatable->options->isRetrieve() }},
@endif
@if ($datatable->options->getRowId())
    "rowId": "{{ $datatable->options->getRowId() }}",
@endif
@if ($datatable->options->isScrollCollapse())
    "scrollCollapse": {{ $datatable->options->isScrollCollapse() }},
@endif
@if ($datatable->options->getSearchDelay())
    "searchDelay": {{ $datatable->options->getSearchDelay() }},
@endif
@if ($datatable->options->getStateDuration())
    "stateDuration": {{ $datatable->options->getStateDuration() }},
@endif
@if ($datatable->options->getStripeClasses())
    "stripeClasses": {!! $datatable->options->getStripeClasses() !!},
@endif
