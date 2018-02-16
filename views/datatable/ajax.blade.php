@if($datatable->ajax->url)
    "url": "{!! $datatable->ajax->url !!}",
@endif
"type": "{!! $datatable->ajax->type !!}",
@if($datatable->ajax->data)
    "data": "{!! $datatable->ajax->data !!}",
@endif

"serverSide": true,
@if($datatable->ajax->pipeline > 0)
    "ajax": $.fn.dataTable.pipeline({
    @if($datatable->ajax->url)
        "url": "{!! $datatable->ajax->url !!}",
    @endif
    "type": "{!! $datatable->ajax->type !!}",
    @if($datatable->ajax->data)
        "data": "{!! $datatable->ajax->data !!}",
    @endif
        "pages": {{ $datatable->ajax->pipeline }}
    }),
@else
    "ajax": {
        @if($datatable->ajax->url)
            "url": "{!! $datatable->ajax->url !!}",
        @endif
        "type": "{!! $datatable->ajax->type !!}",
        @if($datatable->ajax->data)
            "data": "{!! $datatable->ajax->data !!}",
        @endif
    },
@endif