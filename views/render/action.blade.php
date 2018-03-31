{!! $start_html_container !!}

@foreach ($actions as $actionKey => $action)
    @if ($render_if_actions[$actionKey])
        @if($action->isButton() == false)
            {!! $action->getStartHtml() !!}

            <a
                    @if ($action->getRoute())
                    href="@route($action->getRoute(), $route_parameters[$actionKey])"
                    @else
                    href="javascript:void(0);"
        @endif
        @foreach ($attributes[$actionKey] as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
        @if ($action->isConfirm())
            @if ($action->getConfirmMessage())
                onclick="return confirm('{{ $action->getConfirmMessage() }}')"
            @else
                onclick="return confirm('Biztos vagy benne?')"
            @endif
        @endif
        >
        @if (is_null($action->getLabel()) && is_null($action->getIcon()))
            @if ($action->getRoute())
                {{ $action->getRoute() }}
            @endif
        @else
            <span class="{{ $action->getIcon() }}"></span> {{ $action->getLabel() }}
            @endif
            </a>
            {!! $action->getEndHtml() !!}
            @else
                {!! $action->getStartHtml() !!}
                <button type="button"
                        @if ($value)
                        value="{{ $value }}"
            @endif
            @foreach ($attributes as $key => $value)
                {{ $key }}="{{ $value }}"
            @endforeach
            @if ($action->isConfirm())
                @if ($action->getConfirmMessage())
                    onclick="return confirm('{{ $action->getConfirmMessage() }}')"
                @else
                    onclick="return confirm('Biztos vagy benne?')"
                @endif
            @endif
            >
            @if (is_null($action->getLabel()) && is_null($action->getIcon()))
                @if ($action->getRoute())
                    {{ $action->getRoute() }}
                @else
                    null
                @endif
            @else
                <i class="{{ $action->getIcon() }}"></i> {{ $action->getLabel() }}
                @endif
                </button>
                {!! $action->getEndHtml() !!}
            @endif
        @endif
        @endforeach

        {!! $end_html_container !!}
