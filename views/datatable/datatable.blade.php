@section('sg_datatables')

    {% block sg_datatables_html %}

        {% include '@SgDatatables/datatable/datatable_html.html.twig' %}

    {% endblock %}

    {% block sg_datatables_js %}

        {% include '@SgDatatables/datatable/datatable_js.html.twig' %}

    {% endblock %}

@endsection