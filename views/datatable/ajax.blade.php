@if($datatable->ajax->getUrl())
    "url": "{!! $datatable->ajax->getUrl() !!}",
@endif
"type": "{!! $datatable->ajax->getType() !!}",
@if($datatable->ajax->getData())
    "data": "{!! $datatable->ajax->getData() !!}",
@endif

"serverSide": true,
@if($datatable->ajax->getPipeline() > 0)
    "ajax": $.fn.dataTable.pipeline({
    @if($datatable->ajax->getUrl())
        "url": "{!! $datatable->ajax->getUrl() !!}",
    @endif
    "type": "{!! $datatable->ajax->getType() !!}",
    @if($datatable->ajax->getData())
        "data": "{!! $datatable->ajax->getData() !!}",
    @endif
    "pages": {{ $datatable->ajax->getPipeline() }}
    }),
@else
    "ajax": {
    @if($datatable->ajax->getUrl())
        "url": "{!! $datatable->ajax->getUrl() !!}",
    @endif
    "type": "{!! $datatable->ajax->getType() !!}",
    @if($datatable->ajax->getData())
        "data": "{!! $datatable->ajax->getData() !!}",
    @endif
    },
@endif