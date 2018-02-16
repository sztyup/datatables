<script type="text/javascript">

    $(document).ready(function () {

        var selector = "#sg-datatables-{{ $datatable->name }}";
        var oTable;

        var defaults = {
        };

        var language = {
            @include('datatable.language')
        };

        var ajax = {
            @include('datatable.ajax')
        };

        var options = {
            @include('datatable.options')
        };

        var features = {
            @include('datatable.features')
        };

        var callbacks = {
            @include('datatable.callbacks')
        };

        var extensions = {
            @include('datatable.extensions')
        };

        var columns = {
            @include('datatable.columns')
        };

        var initialSearch = {
            @include('datatable.initial_search')
        };

        function postCreateDatatable(pipeline) {
            @foreach($datatable->columnBuilder->columns as $column)
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
                    @include('datatable.events')
                ;
            
                oTable = $(selector)
                    .DataTable(defaults)
                        .on('draw.dt', function() { postCreateDatatable({{ $datatable->ajax->pipeline}}) })
                    ;

                @if($datatable->options->individualFiltering)
                    @include('datatable.search')
                @endif
            }
        }

        createDatatable();

        @if($datatable->columnBuilder->uniqueColumn('multiselect'))
            {{ $sg_datatables_render_multiselect_actions( $datatable->columnBuilder->uniqueColumn('multiselect'), $datatable->ajax->pipeline) }}
        @endif
    });

</script>
