{##
 # This file is part of the SgDatatablesBundle package.
 #
 # (c) stwe <https://github.com/stwe/DatatablesBundle>
 #
 # For the full copyright and license information, please view the LICENSE
 # file that was distributed with this source code.
 #}
<script type="text/javascript">

    $(document).ready(function () {

        var selector = "#sg-datatables-{{ sg_datatables_view.name }}";
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
            {% for column in sg_datatables_view.columnBuilder.columns %}
                {% if column.renderPostCreateDatatableJsContent is not null %}
                    {{ column.renderPostCreateDatatableJsContent|raw }}
                {% endif %}
            {% endfor %}
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
                        .on('draw.dt', function() { postCreateDatatable({{ sg_datatables_view.ajax.pipeline}}) })
                    ;

                {% if true == sg_datatables_view.options.individualFiltering %}
                    @include('datatable.search')
                {% endif %}
            }
        }

        createDatatable();

        {% if sg_datatables_view.columnBuilder.uniqueColumn('multiselect') is not null %}
            {{ sg_datatables_render_multiselect_actions( sg_datatables_view.columnBuilder.uniqueColumn('multiselect'), sg_datatables_view.ajax.pipeline) }}
        {% endif %}
    });

</script>
