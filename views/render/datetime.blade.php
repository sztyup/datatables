@if (isset($column_class_editable_selector))
    <div id="sg-datatables-{{ $datatable_name }}-datetime-{{ $row_id }}" class="{{ $column_class_editable_selector }}" data-pk="{{ $pk }}" @if ($path) data-path="{{ $path }}"@endif></div>
@else
    <div id="sg-datatables-{{ $datatable_name }}-datetime-{{ $row_id }}">
        @if ($data == null and $default_content != null)
            {{ $default_content }}
        @endif
    </div>
@endif

@if ($data)
    <script type="text/javascript">
        $(function() {
            moment.locale("{{ $locale }}");

            @if ($timeago == false)
                $("#sg-datatables-{{ $datatable_name }}-datetime-{{ $row_id }}").html(moment.unix({{ $data|date('U') }}).format("{{ $date_format }}"));
            @else
                $("#sg-datatables-{{ $datatable_name }}-datetime-{{ $row_id }}").html(moment.unix({{ $data|date('U') }}).fromNow());
            @endif
        });
    </script>
@endif
