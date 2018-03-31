@if ($datatable->features->getAutoWidth())
    "autoWidth": {{ $datatable->features->getAutoWidth() }},
@endif
@if ($datatable->features->getDeferRender())
    "deferRender": {{ $datatable->features->getDeferRender() }},
@endif
@if ($datatable->features->getInfo())
    "info": {{ $datatable->features->getInfo() }},
@endif
@if ($datatable->features->getLengthChange())
    "lengthChange": {{ $datatable->features->getLengthChange() }},
@endif
@if ($datatable->features->getOrdering())
    "ordering": {{ $datatable->features->getOrdering() }},
@endif
@if ($datatable->features->getPaging())
    "paging": {{ $datatable->features->getPaging() }},
@endif
@if ($datatable->features->getProcessing())
    "processing": {{ $datatable->features->getProcessing() }},
@endif
@if ($datatable->features->getScrollX())
    "scrollX": {{ $datatable->features->getScrollX() }},
@endif
@if ($datatable->features->getScrollY())
    "scrollY": "{{ $datatable->features->getScrollY() }}",
@endif
@if ($datatable->features->getSearching())
    "searching": {{ $datatable->features->getSearching() }},
@endif
@if ($datatable->features->getStateSave())
    "stateSave": {{ $datatable->features->getStateSave() }},
@endif
