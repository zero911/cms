{{--后台base--}}
@extends('base)

@section('meta')

    @stop

@section('header_css')
    {!! style('bootstrap') !!}
    {!! style('font-awesome') !!}
    {!! style('ionicons') !!}
    {!! style('cms') !!}
    {!! style('_all-skins') !!}
    {!! style('all') !!}
    @stop


@section('end_js')
    {!! script('jquery') !!}
    {!! script('bootstrap_js') !!}
    {!! script('app') !!}
    {!! script('scroll') !!}
    @stop
@stop