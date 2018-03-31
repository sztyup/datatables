{% block html %}
    <input type="{{ $column->filter->type }}"
           id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}"
           class="sg-datatables-individual-filtering{% if $column->filter.classes is not same as(null) %} {{ $column->filter->classes }}{% endif %}"
           @if ($column->width)style="width:{{ $column->width }};" @endif
           @if ($column->filter->placeholder)
                placeholder="@if ($column->filter->placeholderText){{ $column->filter->placeholderText }}@else{{ $column->title }}@endif"
           @endif
           data-search-column-index="{{ $search_column_index }}"
            @if ($column->name) name="{{ $column->name }}"@endif
            @if ($column->filter->initialSearch)value="{{ $column->filter->initialSearch }}"@endif
    />
@if ($column->filter->cancelButton)
<button type="button"
        id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}"
        class="btn btn-default btn-xs"
>&times;</button>
@endif
{% endblock %}

{% block javascript %}
    <script type="text/javascript">
        moment.locale("{{ $locale }}");
        $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: "YY-MM-DD",
                applyLabel: "Ok",
                cancelLabel: "Mégse",
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek()
            }
        }).on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            $(this).change();
          })
          .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format("{{ 'sg.datatables.daterange.format'|trans({}, 'messages') }}") + ' - ' + picker.endDate.format("{{ 'sg.datatables.daterange.format'|trans({}, 'messages') }}"));
                $(this).change();
          });
    </script>


    {% if true == $column->filter.cancelButton %}
    <script type="text/javascript">
        $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}").click(function() {
            if ('' != $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val()) {
                $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}")
                    .val('')
                    .change();
            }
        });
    </script>
    {% endif %}
{% endblock %}
