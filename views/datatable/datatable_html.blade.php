@php $individual_filtering = false @endphp

@if ($datatable->options->individualFiltering)
    @if ($datatable->features->searching || is_null($datatable->features->searching))
        @php $individual_filtering = true @endphp
    @endif
@endif

<table id="sg-datatables-{{ $datatable->name }}" class="{{ $datatable->options->classes }}" cellspacing="0" width="100%">
    <thead>
    @if ($individual_filtering)
        @if ($datatable->options->individualFilteringPosition == 'head' || $datatable->options->individualFilteringPosition == 'both')
            <tr>
                @foreach ($datatable->columnBuilder->getColumns() as $column)
                    <th>{{ $column->title }}</th>
                @endforeach
            </tr>
            <tr id="sg-datatables-{{ $datatable->name }}-filterrow">
                @foreach ($datatable->columnBuilder->getColumns() as $column)
                    <th>
                        @if ($column->searchable)
                            {{ sg_datatables_render_filter(datatable, column, 'head') }}
                        @endif
                    </th>
                @endforeach
            </tr>
        @endif
    @endif
    </thead>
    @if ($individual_filtering)
        @if ($datatable->options->individualFilteringPosition == 'foot' || $datatable->options->individualFilteringPosition == 'both')
            <tfoot>
            <tr>
                @foreach ($datatable->columnBuilder->getColumns() as $column)
                    <td>
                        @if ($column->searchable)
                            {{ sg_datatables_render_filter(datatable, column, 'foot') }}
                        @endif
                    </td>
                @endforeach
            </tr>
            </tfoot>
        @endif
    @endif
    <tbody>
    </tbody>
</table>

@if($datatable->columnBuilder->getUniqueColumn('multiselect'))
    <div id="sg-datatables-{{ $datatable->name }}-multiselect-actions"></div>
@endif
