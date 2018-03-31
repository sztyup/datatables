@if ($datatable->features->autoWidth)
    "autoWidth": {{ $datatable->features->autoWidth }},
@endif
@if ($datatable->features->deferRender)
    "deferRender": {{ $datatable->features->deferRender }},
@endif
@if ($datatable->features->info)
    "info": {{ $datatable->features->info }},
@endif
@if ($datatable->features->lengthChange)
    "lengthChange": {{ $datatable->features->lengthChange }},
@endif
@if ($datatable->features->ordering)
    "ordering": {{ $datatable->features->ordering }},
@endif
@if ($datatable->features->paging)
    "paging": {{ $datatable->features->paging }},
@endif
@if ($datatable->features->processing)
    "processing": {{ $datatable->features->processing }},
@endif
@if ($datatable->features->scrollX)
    "scrollX": {{ $datatable->features->scrollX }},
@endif
@if ($datatable->features->scrollY)
    "scrollY": "{{ $datatable->features->scrollY }}",
@endif
@if ($datatable->features->searching)
    "searching": {{ $datatable->features->searching }},
@endif
@if ($datatable->features->stateSave)
    "stateSave": {{ $datatable->features->stateSave }},
@endif
