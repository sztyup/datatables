@if ($data)
    @php $path = $image->relativePath . '/' . $data @endphp
    @if ($image->enlarge == true)
    {% if $image->enlarge is same as(true) %}
        {% set enlargedPath = asset(path)|imagine_filter($image->imagineFilterEnlarged) %}
        <a href="javascript:void(0);" data-featherlight="{{ $enlargedPath ?? $path }}">
            <img class="{{ $image_class }}" src="{{ $path | imagine_filter($image->imagineFilter) }}" />
        </a>
    @else
        <img class="{{ $image_class }}" src="{{ $path | imagine_filter($image->imagineFilter) }}" />
    @endif
@else
    @if ($image->holderUrl)
        <img src="{{ $image->holderUrl }}/{{ $image->holderWidth }}x{{ $image->holderHeight }}" />
    @endif
@endif
