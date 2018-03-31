@if($datatable->callbacks->getCreatedRow())
    "createdRow": @include($datatable->callback->getCreatedRow()['template'], $datatable->callbacks->getCreatedRow()['vars'] ?? []),
@endif

@if($datatable->callbacks->getDrawCallback())
    "drawCallback": @include($datatable->callbacks->getDrawCallback()['template'], $datatable->callbacks->getDrawCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getFooterCallback())
    "footerCallback": @include($datatable->callbacks->getFooterCallback()['template'], $datatable->callbacks->getFooterCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getFormatNumber())
    "formatNumber": @include($datatable->callbacks->getFormatNumber()['template'], $datatable->callbacks->getFormatNumber()['vars'] ?? []),
@endif

@if($datatable->callbacks->getHeaderCallback())
    "headerCallback": @include($datatable->callbacks->getHeaderCallback()['template'], $datatable->callbacks->getHeaderCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getInfoCallback())
    "infoCallback": @include($datatable->callbacks->getInfoCallback()['template'], $datatable->callbacks->getInfoCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getInitComplete())
    "initComplete": @include($datatable->callbacks->getInitComplete()['template'], $datatable->callbacks->getInitComplete()['vars'] ?? []),
@endif

@if($datatable->callbacks->getPreDrawCallback())
    "preDrawCallback": @include($datatable->callbacks->getPreDrawCallback()['template'], $datatable->callbacks->getPreDrawCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getRowCallback())
    "rowCallback": @include($datatable->callbacks->getRowCallback()['template'], $datatable->callbacks->getRowCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getStateLoadCallback())
    "stateLoadCallback": @include($datatable->callbacks->getStateLoadCallback()['template'], $datatable->callbacks->getStateLoadCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getStateLoaded())
    "stateLoaded": @include($datatable->callbacks->getStateLoaded()['template'], $datatable->callbacks->getStateLoaded()['vars'] ?? []),
@endif

@if($datatable->callbacks->getStateLoadParams())
    "stateLoadParams": @include($datatable->callbacks->getStateLoadParams()['template'], $datatable->callbacks->getStateLoadParams()['vars'] ?? []),
@endif

@if($datatable->callbacks->getStateSaveCallback())
    "stateSaveCallback": @include($datatable->callbacks->getStateSaveCallback()['template'], $datatable->callbacks->getStateSaveCallback()['vars'] ?? []),
@endif

@if($datatable->callbacks->getStateSaveParams())
    "stateSaveParams": @include($datatable->callbacks->getStateSaveParams()['template'], $datatable->callbacks->getStateSaveParams()['vars'] ?? []),
@endif

