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
    {{ $data->format($date_format) }}
@endif
