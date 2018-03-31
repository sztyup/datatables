@if($datatable->events->getColumnSizing())
    .on('column-sizing.dt', @include($datatable->callback->getColumnSizing()['template'], $datatable->events->getColumnSizing()['vars'] ?? []))
@endif

@if($datatable->events->getColumnVisibility())
    .on('column-visibility.dt', @include($datatable->callback->getColumnVisibility()['template'], $datatable->events->getColumnVisibility()['vars'] ?? []))
@endif

@if($datatable->events->getDestroy())
    .on('destroy.dt', @include($datatable->callback->getDestroy()['template'], $datatable->events->getDestroy()['vars'] ?? []))
@endif

@if($datatable->events->getError())
    .on('error.dt', @include($datatable->callback->getError()['template'], $datatable->events->getError()['vars'] ?? []))
@endif

@if($datatable->events->getLength())
    .on('length.dt', @include($datatable->callback->getLength()['template'], $datatable->events->getLength()['vars'] ?? []))
@endif

@if($datatable->events->getOrder())
    .on('order.dt', @include($datatable->callback->getOrder()['template'], $datatable->events->getOrder()['vars'] ?? []))
@endif

@if($datatable->events->getPage())
    .on('page.dt', @include($datatable->callback->getPage()['template'], $datatable->events->getPage()['vars'] ?? []))
@endif

@if($datatable->events->getPreInit())
    .on('preInit.dt', @include($datatable->callback->getPreInit()['template'], $datatable->events->getPreInit()['vars'] ?? []))
@endif

@if($datatable->events->getProcessing())
    .on('processing.dt', @include($datatable->callback->getProcessing()['template'], $datatable->events->getProcessing()['vars'] ?? []))
@endif

@if($datatable->events->getSearch())
    .on('search.dt', @include($datatable->callback->getSearch()['template'], $datatable->events->getSearch()['vars'] ?? []))
@endif

@if($datatable->events->getPage())
    .on('page.dt', @include($datatable->callback->getPage()['template'], $datatable->events->getPage()['vars'] ?? []))
@endif

@if($datatable->events->getStateLoaded())
    .on('stateLoaded.dt', @include($datatable->callback->getStateLoaded()['template'], $datatable->events->getStateLoaded()['vars'] ?? []))
@endif

@if($datatable->events->getStateLoadParams())
    .on('stateLoadedParams.dt', @include($datatable->callback->getStateLoadParams()['template'], $datatable->events->getStateLoadParams()['vars'] ?? []))
@endif

@if($datatable->events->getStateSaveParams())
    .on('stateSaveParams.dt', @include($datatable->callback->getStateSaveParams()['template'], $datatable->events->getStateSaveParams()['vars'] ?? []))
@endif

@if($datatable->events->getXhr())
    .on('xhr.dt', @include($datatable->callback->getXhr()['template'], $datatable->events->getXhr()['vars'] ?? []))
@endif