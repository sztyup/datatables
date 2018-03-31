@if ($column_class_editable_selector)
    @if ($data == true)
        <span
                class="{{ $true_icon . ' ' . $column_class_editable_selector }}"
                data-pk="{{ $pk }}"
                @if ($path) data-path="{{ $path }}"@endif
        >{{ $true_label }}</span>
    @elseif ($data == false)
        <span
                class="{{ $false_icon . ' ' . $column_class_editable_selector }}"
                data-pk="{{ $pk }}"
                @if ($path) data-path="{{ $path }}"@endif
        >{{ $false_label }}</span>
    @elseif(is_null($data))
        <span class="{{ $column_class_editable_selector }}"
              data-pk="{{ $pk }}"
              @if ($path) data-path="{{ $path }}"@endif
        >
            @if ($default_content)
                {{ $default_content }}
            @else
                {{ $empty_text }}
            @endif
        </span>
    @endif
@else
    @if ($data == true)
        <span class="{{ $true_icon }}"></span> {{ $true_label }}
    @elseif ($data == false)
        <span class="{{ $false_icon }}"></span> {{ $false_label }}
    @elseif (is_null($data))
        @if ($default_content)
            {{ $default_content }}
        @else
            {{ $empty_text }}
        @endif
    @endif
@endif
