@if ($render_if_cbox == true)
    {!! start_html !!}
    <input type="checkbox" @foreach ($attributes as $key => $value){{ $key }}="{{ $value }}" @endforeach value="{{ $value }}" />
    {!! end_html !!}
@endif
