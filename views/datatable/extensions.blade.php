@if (isset($datatable->extensions->buttons))
    @if ($datatable->extensions->buttons === true)
        buttons: true,
    @else
        buttons: [
        @if ($datatable->extensions->buttons->showButtons)
            {!! $datatable->extensions->buttons->showButtons !!},
        @endif
        @if ($datatable->extensions->buttons->createButtons)
            @foreach ($datatable->extensions->buttons->createButtons as $button)
                @include ('datatable.button')
            @endforeach
        @endif
        ],
    @endif
@endif

@if (isset($datatable->extensions->responsive))
    @if ($datatable->extensions->responsive === true)
        responsive: true,
    @elseif ($datatable->extensions->responsive->details)
        @if (is_array($datatable->extensions->responsive->details))
            details: {
                @if ($datatable->extensions->responsive->details['type'])
                    type: "{{ $datatable->extensions->responsive->details['type'] }}"
                @endif
                @if ($datatable->extensions->responsive->details['target'])
                    target: "{{ $datatable->extensions->responsive->details['target'] }}"
                @endif
                @if ($datatable->extensions->responsive->details['renderer'])
                    renderer: @include ($datatable->extensions->responsive->details['renderer']['template'], $datatable->extensions->responsive->details['renderer']['vars']),
                @endif
                @if ($datatable->extensions->responsive->details['display'])
                    display: @include ($datatable->extensions->responsive->details['display']['template'], $datatable->extensions->responsive->details['display']['vars']),
                @endif
            },
        @else
            details: {{ $datatable->extensions->responsive->details }}
        @endif
    @endif
@endif

@if (isset($datatable->extensions->select))
    @if ($datatable->extensions->select === true)
        select: true,
    @elseif ($datatable->extensions->select->details)
        select: {
        @if ($datatable->extensions->select->blurable)
            blurable: "{{ $datatable->extensions->select->blurable }}"
        @endif
        @if ($datatable->extensions->select->className)
            className: "{{ $datatable->extensions->select->className }}"
        @endif
        @if ($datatable->extensions->select->info)
            info: {{ $datatable->extensions->select->info }}
        @endif
        @if ($datatable->extensions->select->items)
            items: "{{ $datatable->extensions->select->items }}"
        @endif
        @if ($datatable->extensions->select->selector)
            selector: "{{ $datatable->extensions->select->selector }}"
        @endif
        @if ($datatable->extensions->select->style)
            style: "{{ $datatable->extensions->select->style }}"
        @endif
        },
    @endif
@endif