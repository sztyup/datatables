{!! $start_html_container !!}

@foreach ($actions as $actionKey => $action)
    @if ($render_if_actions[$actionKey])
        @if($action->button == false)
            {!! $action->startHtml !!}

            <a
                @if ($action->route)
                    href="@route($action->route, $route_parameters[$actionKey])"
                @else
                    href="javascript:void(0);"
                @endif
                @foreach ($attributes as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
                @if ($action->confirm)
                    @if ($action->confirmMessage)
                        onclick="return confirm('{{ $action->confirmMessage }}')"
                    @else
                        onclick="return confirm('Biztos vagy benne?')"
                    @endif
                @endif
            >
            @if (is_null($action->label) && is_null($action->icon))
                @if ($action->route)
                    {{ $action->route }}
                @endif
            @else
                <span class="{{ $action->icon }}"></span> {{ $action->label }}
            @endif
            </a>
            {!! $action->endHtml !!}
        @else
            {!! $action->startHtml !!}
            <button type="button"
                @if ($value)
                    value="{{ $value }}"
                @endif
                @foreach ($attributes as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
                @if ($action->confirm)
                    @if ($action->confirmMessage)
                        onclick="return confirm('{{ $action->confirmMessage }}')"
                    @else
                        onclick="return confirm('Biztos vagy benne?')"
                    @endif
                @endif
            >
            @if (is_null($action->label) && is_null($action->icon))
                @if ($action->route)
                    {{ $action->route }}
                @else
                    null
                @endif
            @else
                    <span class="{{ $action->icon }}"></span> {{ $action->label }}
            @endif
            </button>
            {!! $action->endHtml !!}
        @endif
    @endif
@endforeach

{!! $end_html_container !!}
