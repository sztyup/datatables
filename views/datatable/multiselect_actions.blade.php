{{-- @TODO finish this
{% macro link_title(action) %}
    @if ($action->label == null && $action->icon == null)
        @if ($action->route)
            {{ $action->route }}
        @else
            null
        @endif
    @else
        <span class="{{ $action->icon }}"></span> {{ $action->label }}
    @endif
{% endmacro %}

{% macro attributes(action) %}
    @foreach ($action->attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
{% endmacro %}

{% macro confirm_dialog(action) %}
    @if ($action->confirm)
        @if ($action->confirmMessage)
            data-message="{{ $action->confirmMessage }}"
        @else
            data-message="Biztos vagy benne?"
        @endif
    @endif
{% endmacro %}

{% macro href(action, route_parameters) %}
    @if ($action->route)
        href="@route($action->route,  $route_parameters)"
    @else
        href="javascript:void(0);"
    @endif
{% endmacro %}

{% macro value(value) %}
    @if (!is_null($value))
    {% if value is not null %}
        value="{{ value }}"
    @endif
{% endmacro %}


{% set multiselect_actions %}
    {% for actionKey, action in actions %}
        {% if action.callRenderIfClosure is same as(true) %}
            {% if action.button is same as(false) %}
                {{ action.startHtml|raw }}
                <a {{ macros.href(action, route_parameters[actionKey]) }} {{ macros.attributes(action) }} {{ macros.confirm_dialog(action) }}>
                    {{ macros.link_title(action) }}
                </a>
                {{ action.endHtml|raw }}
            {% else %}
                {{ action.startHtml|raw }}
                <button type="button" {{ macros.value(values[actionKey]) }} {{ macros.attributes(action) }} {{ macros.confirm_dialog(action) }}>
                    {{ macros.link_title(action) }}
                </button>
                {{ action.endHtml|raw }}
            {% endif %}
        {% endif %}
    {% endfor %}
{% endset %}
--}}

@if (is_null($dom_id))
    $("#sg-datatables-{{ $datatable_name }}-multiselect-actions").append("{!! $multiselect_actions !!}");
@else
    $("#{{ $dom_id }}").append("{!! $multiselect_actions !!}");
@endif

{# function to update the check-all-checkbox #}
function updateCheckAll() {
    var cbox_all = $("#sg-datatables-{{ $datatable_name }} tbody input.sg-datatables-{{ $datatable_name }}-multiselect-checkbox:checkbox");
    var cbox_checked = $("#sg-datatables-{{ $datatable_name }} tbody input.sg-datatables-{{ $datatable_name }}-multiselect-checkbox:checkbox:checked");
    var cbox_checkall = $("#sg-datatables-{{ $datatable_name }} input.sg-datatables-{{ $datatable_name }}-multiselect-checkall:checkbox");

    if(cbox_checked.length === 0){
        cbox_checkall.prop('checked', false);
        cbox_checkall.prop('indeterminate', false);
    } else if (cbox_checked.length === cbox_all.length){
        cbox_checkall.prop('checked', true);
        cbox_checkall.prop('indeterminate', false);
    } else {
        cbox_checkall.prop('checked', false);
        cbox_checkall.prop('indeterminate', true);
    }
}

{# handle row <tr> click #}
$("#sg-datatables-{{ $datatable_name }} tbody").on("click", "tr", function () {
    {# add 'selected' class #}
    if ($(this).find("input").length) {
        $(this).toggleClass("selected");
    }

    {# set !checked for the row checkbox #}
    $(this).find("input.sg-datatables-{{ $datatable_name }}-multiselect-checkbox:checkbox").each(function() {
        this.checked = !this.checked;
    });

    updateCheckAll();
});

{# handle checkbox <input> click #}
$("#sg-datatables-{{ $datatable_name }} tbody").on("click", "input.sg-datatables-{{ $datatable_name }}-multiselect-checkbox:checkbox", function () {
    this.checked = !this.checked;
    updateCheckAll();
});

{# select/unselect all checkboxes #}
$("#sg-datatables-{{ $datatable_name }}").on("click", "input.sg-datatables-{{ $datatable_name }}-multiselect-checkall:checkbox", function () {
    $("input.sg-datatables-{{ $datatable_name }}-multiselect-checkbox").prop('checked', $(this).prop("checked"));
    var propCheck = $(this).prop("checked");
    $("#sg-datatables-{{ $datatable_name }} tbody tr").each(function(){
        if ($(this).find("input").length) {
            if (true == propCheck) {
                $(this).addClass("selected");
            } else {
                $(this).removeClass("selected");
            }
        }
    });
});

{# handle multiselect action click #}
$(".sg-datatables-{{ $datatable_name }}-multiselect-action").on("click", function(event) {
    event.preventDefault();

    if (oTable.rows(".selected").data().length > 0) {
        if ($(this).data("message")) {
            if (!confirm($(this).data("message"))) {
                return;
            }
        }

        var items = $.map(oTable.rows(".selected").data(), function (i) {
            return i
        });

        var pipeline = {{ $pipeline }};

        {% set token = csrf_token('multiselect') %}

        var url = $(this).attr("href");
        if (url != null) {
            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    'data': items,
                    'token': "{{ $token }}"
                },
                success: function(msg) {
                    if (pipeline > 0) {
                        oTable.clearPipeline().draw();
                    } else {
                        oTable.draw();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest + ' ' + textStatus + ' '  + errorThrown);
                }
            })
        }
    } else {
        alert("Hiba történt a select közben");
    }
});
