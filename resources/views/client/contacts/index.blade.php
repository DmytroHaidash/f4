@extends('layouts.client', ['page_title' => __('nav.contacts')])

@section('content')
    @if($page->hasMedia('cover'))
        <section class="lozad page-header" data-background-image="{{ $page->getFirstMediaUrl('cover') }}"></section>
    @endif
    <section class="{{$page->hasMedia('cover')? '-mt-32' : 'mt-32'}} mb-12 container">
        <h1 hidden>{{ __('nav.contacts') }}</h1>

        <div class="flex flex-wrap -mx-12 -mb-8">
            @foreach($contacts as $contact)
                <article class="px-12 my-8 w-full md:w-1/2">
                    <div class="relative">
                        @if ($contact->hasMedia('cover'))
                            <img src="{{ $contact->getFirstMedia('cover')->getFullUrl('cover') }}"
                                 class="max-w-xs" alt="{{ $contact->name }}">
                        @endif

                        <div class="{{ $contact->hasMedia('cover') ? 'px-2 py-2 mb-0 bg-purple-900 text-white w-3/4 absolute right-0 bottom-0' : '' }}">
                            <h2 class="text-xl">{{ $contact->name }}</h2>
                            <p class="font-serif italic text-base mb-2">{{ $contact->position }}</p>

                            @isset ($contact->contacts['phone'])
                                <p>
                                    <a href="tel:{{ clearPhone($contact->contacts['phone']) }}">
                                        {{ $contact->contacts['phone'] }}
                                    </a>
                                </p>
                            @endisset

                            @isset ($contact->contacts['email'])
                                <p>
                                    <a href="mailto:{{ clearPhone($contact->contacts['email']) }}" class="underline">
                                        {{ $contact->contacts['email'] }}
                                    </a>
                                </p>
                            @endisset
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <button class="button button--primary modal-btn " data-modal-open="question">
                @lang('pages.contacts.btn')
            </button>
        </div>
        @include('client.contacts.modal')

    </section>

@endsection
