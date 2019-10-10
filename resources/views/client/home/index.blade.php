@extends('layouts.client', ['page_title' => __('nav.home')])

@section('content')

    @include('client.home.partials.slideshow')
    @include('client.home.partials.sections')

    @includeWhen($posts->count(), 'partials.client.blog.section')

@endsection