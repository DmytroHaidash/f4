@extends('layouts.client', ['page_title' => $page->title])

@section('content')

    <section class="mt-32 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>{{ $page->title }}</span>
        </h1>
        <div class="page-content mt-8">
            {!! $page->body !!}
        </div>
        @if($page->slug == 'expertise')
            <div class="text-center mt-8">
                <button class="button button--primary modal-btn " data-modal-open="question">
                    @lang('pages.question.btn')
                </button>
            </div>
        @endif
        @if($page->slug == 'expertise')
            @include('client.pages.question-modal')
        @endif
    </section>

@endsection