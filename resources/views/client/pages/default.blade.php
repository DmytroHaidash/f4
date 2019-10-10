@extends('layouts.client', ['page_title' => $page->title])

@section('content')

    <section class="mt-32 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>{{ $page->title }}</span>
        </h1>

        <div class="page-content mt-8">
            {!! $page->body !!}
        </div>
        {{--@if($page->slug == 'expertise')
            <a href="#" class="button button--primary ">
                {{ __('nav.about') }}
            </a>
        @endif--}}
    </section>

@endsection