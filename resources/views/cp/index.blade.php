@extends('statamic::layout')

@section('content')
    <publish-form
        title="{{ $title }}"
        action="{{ cp_route('seo.settings.store') }}"
        :blueprint='@json($blueprint)'
        :meta='@json($meta)'
        :values='@json($values)'
    ></publish-form>
@stop
