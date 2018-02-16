@php $individual_filtering = false @endphp

{% if true == datatable.options.individualFiltering %}
    {% if true == datatable.features.searching or datatable.features.searching is same as(null) %}
        {% set individual_filtering = true %}
    {% endif %}
{% endif %}

<table id="sg-datatables-{{ datatable.name }}" class="{{ datatable.options.classes }}" cellspacing="0" width="100%">
    <thead>
        {% if true == individual_filtering %}
            {% if 'head' == datatable.options.individualFilteringPosition or 'both' == datatable.options.individualFilteringPosition%}
                <tr>
                    {% for column in datatable.columnBuilder.columns %}
                        <th>{{ column.title }}</th>
                    {% endfor %}
                </tr>
                <tr id="sg-datatables-{{ datatable.name }}-filterrow">
                    {% for column in datatable.columnBuilder.columns %}
                        <th>
                            {% if column.searchable %}
                                {{ sg_datatables_render_filter(datatable, column, 'head') }}
                            {% endif %}
                        </th>
                    {% endfor %}
                </tr>
            {% endif %}
        {% endif %}
    </thead>
        {% if true == individual_filtering %}
            {% if 'foot' == datatable.options.individualFilteringPosition or 'both' == datatable.options.individualFilteringPosition%}
            <tfoot>
                    <tr>
                        {% for column in datatable.columnBuilder.columns %}
                            <td>
                                {% if column.searchable %}
                                    {{ sg_datatables_render_filter(datatable, column, 'foot') }}
                                {% endif %}
                            </td>
                        {% endfor %}
                    </tr>
                </tfoot>
            {% endif %}
        {% endif %}
    <tbody>
    </tbody>
</table>

{% if datatable.columnBuilder.uniqueColumn('multiselect') is not same as(null) %}
    <div id="sg-datatables-{{ datatable.name }}-multiselect-actions"></div>
{% endif %}
