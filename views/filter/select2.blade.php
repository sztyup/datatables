@extends('datatables.filter.select')

@section('javascript')
    @if($column->filter->cancelButton)
        <script type="text/javascript">
            $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-cancel-{{ $column->index }}").click(function() {
                if ('' != $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val()) {
                    $("#sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}")
                        .val('')
                        .change();
                }
            });
        </script>
    @endif
    <script type="text/javascript">
        $("#id=sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").select2({
            @if($column->filter->placeholder)
                placeholder: "{{ $column->filter->placeholder }}",
            @endif
            @if($column->filter->allowClear)
                allowClear: {{ $column->filter->allowClear }},
            @endif
            @if($column->filter->tags)
                tags: {{ $column->filter->tags }},
            @endif
            @if($column->filter->language)
                language: "{{ $column->filter->language }}",
            @else
                language: "{{ $locale }}",
            @endif
            dropdownAutoWidth : true,
            @if($column->filter->url)
                ajax: {
                    url: "@route($column->filter->url)",
                    dataType: 'json',
                    delay: {{ $column->filter->delay }},
                    cache: {{ $column->filter->cache }},
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        var resultArray = [];
                        for (var id in data) {
                            resultArray.push({
                                id : data[id],
                                text : data[id]
                            });
                        }

                        return {
                            results: resultArray,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            @endif
        });
        @if($column->filter->searchColumn)
            $("#id=sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}").val(
                $('#id="sg-datatables-{{ $datatable_name }}-{{ $position }}-filter-{{ $column->index }}" option:first-child').val()
        ).trigger('change');
        @endif
    </script>
@endsection
