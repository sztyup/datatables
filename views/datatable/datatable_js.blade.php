<script type="text/javascript">

    $(document).ready(function () {

        var selector = "#sg-datatables-{{ $datatable->name }}";
        var oTable;

        var defaults = {
        };

        var language = {
            @include('datatables::datatable.language')
        };

        var ajax = {
            @include('datatables::datatable.ajax')
        };

        var options = {
            @include('datatables::datatable.options')
        };

        var features = {
            @include('datatables::datatable.features')
        };

        var callbacks = {
            @include('datatables::datatable.callbacks')
        };

        var extensions = {
            @include('datatables::datatable.extensions')
        };

        var columns = {
            @include('datatables::datatable.columns')
        };

        var initialSearch = {
            @include('datatables::datatable.initial_search')
        };

        function postCreateDatatable(pipeline) {
            @foreach($datatable->columnBuilder->getColumns() as $column)
            @if($column->renderPostCreateDatatableJsContent)
            {!! $column->renderPostCreateDatatableJsContent !!}
            @endif
            @endforeach
        }

        function createDatatable() {
            $.extend(defaults, language);
            $.extend(defaults, ajax);
            $.extend(defaults, options);
            $.extend(defaults, features);
            $.extend(defaults, callbacks);
            $.extend(defaults, extensions);
            $.extend(defaults, columns);
            $.extend(defaults, initialSearch);

            if (!$.fn.dataTable.isDataTable(selector)) {
                $(selector)
                @include('datatables::datatable.events')
                ;

                oTable = $(selector)
                    .DataTable(defaults)
                    .on('draw.dt', function() { postCreateDatatable({{ $datatable->ajax->pipeline}}) })
                ;

                @if($datatable->options->individualFiltering)
                @include('datatables::datatable.search')
                @endif
            }
        }

        createDatatable();

        @if($datatable->columnBuilder->getUniqueColumn('multiselect'))
        {{ $sg_datatables_render_multiselect_actions( $datatable->columnBuilder->getUniqueColumn('multiselect'), $datatable->ajax->pipeline) }}
        @endif
    });

</script>
