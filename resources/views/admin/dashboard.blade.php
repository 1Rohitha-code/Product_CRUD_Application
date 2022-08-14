@extends('root.master_page')

@section('title')
Admin Dashboard
@endsection

@section('dashboard_name')
Admin Dashboard
@endsection


@section('navbar')

@include('admin.navbar')

@endsection



@section('content')

@include('admin.product_categories.product_list')

@endsection