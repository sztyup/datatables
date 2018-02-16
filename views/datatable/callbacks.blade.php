@if($datatable->callbacks->createdRow)
    "createdRow": @include($datatable->callback->createdRow['template'], $datatable->callbacks->createdRow['vars'] ?? []),
@endif

@if($datatable->callbacks->drawCallback)
    "drawCallback": @include($datatable->callbacks->drawCallback['template'], $datatable->callbacks->drawCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->footerCallback)
    "footerCallback": @include($datatable->callbacks->footerCallback['template'], $datatable->callbacks->footerCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->formatNumber)
    "formatNumber": @include($datatable->callbacks->formatNumber['template'], $datatable->callbacks->formatNumber['vars'] ?? []),
@endif

@if($datatable->callbacks->headerCallback)
    "headerCallback": @include($datatable->callbacks->headerCallback['template'], $datatable->callbacks->headerCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->infoCallback)
    "infoCallback": @include($datatable->callbacks->infoCallback['template'], $datatable->callbacks->infoCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->initComplete)
    "initComplete": @include($datatable->callbacks->initComplete['template'], $datatable->callbacks->initComplete['vars'] ?? []),
@endif

@if($datatable->callbacks->preDrawCallback)
    "preDrawCallback": @include($datatable->callbacks->preDrawCallback['template'], $datatable->callbacks->preDrawCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->rowCallback)
    "rowCallback": @include($datatable->callbacks->rowCallback['template'], $datatable->callbacks->rowCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->stateLoadCallback)
    "stateLoadCallback": @include($datatable->callbacks->stateLoadCallback['template'], $datatable->callbacks->stateLoadCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->stateLoaded)
    "stateLoaded": @include($datatable->callbacks->stateLoaded['template'], $datatable->callbacks->stateLoaded['vars'] ?? []),
@endif

@if($datatable->callbacks->stateLoadParams)
    "stateLoadParams": @include($datatable->callbacks->stateLoadParams['template'], $datatable->callbacks->stateLoadParams['vars'] ?? []),
@endif

@if($datatable->callbacks->stateSaveCallback)
    "stateSaveCallback": @include($datatable->callbacks->stateSaveCallback['template'], $datatable->callbacks->stateSaveCallback['vars'] ?? []),
@endif

@if($datatable->callbacks->stateSaveParams)
    "stateSaveParams": @include($datatable->callbacks->stateSaveParams['template'], $datatable->callbacks->stateSaveParams['vars'] ?? []),
@endif

