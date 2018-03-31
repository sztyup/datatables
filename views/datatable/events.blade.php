@if($datatable->events->columnSizing)
    .on('column-sizing.dt', @include($datatable->callback->columnSizing['template'], $datatable->events->columnSizing['vars'] ?? []))
@endif

@if($datatable->events->columnVisibility)
    .on('column-visibility.dt', @include($datatable->callback->columnVisibility['template'], $datatable->events->columnVisibility['vars'] ?? []))
@endif

@if($datatable->events->destroy)
    .on('destroy.dt', @include($datatable->callback->destroy['template'], $datatable->events->destroy['vars'] ?? []))
@endif

@if($datatable->events->error)
    .on('error.dt', @include($datatable->callback->error['template'], $datatable->events->error['vars'] ?? []))
@endif

@if($datatable->events->length)
    .on('length.dt', @include($datatable->callback->length['template'], $datatable->events->length['vars'] ?? []))
@endif

@if($datatable->events->order)
    .on('order.dt', @include($datatable->callback->order['template'], $datatable->events->order['vars'] ?? []))
@endif

@if($datatable->events->page)
    .on('page.dt', @include($datatable->callback->page['template'], $datatable->events->page['vars'] ?? []))
@endif

@if($datatable->events->preInit)
    .on('preInit.dt', @include($datatable->callback->preInit['template'], $datatable->events->preInit['vars'] ?? []))
@endif

@if($datatable->events->processing)
    .on('processing.dt', @include($datatable->callback->processing['template'], $datatable->events->processing['vars'] ?? []))
@endif

@if($datatable->events->search)
    .on('search.dt', @include($datatable->callback->search['template'], $datatable->events->search['vars'] ?? []))
@endif

@if($datatable->events->page)
    .on('page.dt', @include($datatable->callback->page['template'], $datatable->events->page['vars'] ?? []))
@endif

@if($datatable->events->stateLoaded)
    .on('stateLoaded.dt', @include($datatable->callback->stateLoaded['template'], $datatable->events->stateLoaded['vars'] ?? []))
@endif

@if($datatable->events->stateLoadParams)
    .on('stateLoadedParams.dt', @include($datatable->callback->stateLoadParams['template'], $datatable->events->stateLoadParams['vars'] ?? []))
@endif

@if($datatable->events->stateSaveParams)
    .on('stateSaveParams.dt', @include($datatable->callback->stateSaveParams['template'], $datatable->events->stateSaveParams['vars'] ?? []))
@endif

@if($datatable->events->xhr)
    .on('xhr.dt', @include($datatable->callback->xhr['template'], $datatable->events->xhr['vars'] ?? []))
@endif