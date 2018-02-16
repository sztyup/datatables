{
    @if($button->action)
        action: @include($button->action['template'], $button->action['vars'] ?? []),
    @endif
    @if($button->available)
        available: @include($button->available['template'], $button->available['vars'] ?? []),
    @endif
    @if($butotn->className)
        className: "{{ $button->className  }}",
    @endif
    @if($button->destroy)
        destroy: @include($button->destroy['template'], $button->destroy['vars'] ?? []),
    @endif
    @if($button->enabled)
        enabled: {{ $button->enabled }},
    @endif
    @if($button->extend)
        extend: {{ $button->extend }},
    @endif
    @if($button->init)
        init: @include($button->init['template'], $button->init['vars'] ?? []),
    @endif
    @if($button->key)
        key: {{ $button->key }},
    @endif
    @if($button->name)
        name: {{ $button->name }},
    @endif
    @if($button->namespace)
        namespace: {{ $button->namespace }},
    @endif
    @if($button->text)
        text: {{ $button->text }},
    @endif
    @if($button->titleAttr)
        titleAttr: {{ $button->titleAttr }},
    @endif
    @foreach($button->buttonOptions as $key => $option)
        {{ $key }}: {!! json_encode($option) !!},
    @endforeach
},
