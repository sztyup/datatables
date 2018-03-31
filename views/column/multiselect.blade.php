@extends('datatables.column.column')

@section('title')
    "title": "<input type='checkbox' name='sg-datatables-{{ $datatable->name }}-multiselect-checkall' class='sg-datatables-{{ $datatable->name }}-multiselect-checkall' />",
@endsection
