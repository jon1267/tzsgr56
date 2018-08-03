@extends('layouts.master')

@section('navigation')
    @include('site.navigation')
@endsection

@section('content')
    @include($template)
@endsection

@section('footer')
    @include('site.footer')
@endsection
