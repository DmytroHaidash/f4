<section class="slideshow hidden lg:block">
    <div class="slides slides--images">
        <div class="slide slide--current">
            <figure class="slide__img" style="background-image: url({{ $page->hasMedia('cover') ? $page->getFirstMediaUrl('cover') : asset('images/background.jpg') }});"></figure>
            <div class="slide__title">
                <svg fill="#fff" class="slide__title-logo">
                    <use xlink:href="{{app()->getLocale() == 'ru' ? '#logo2_rus' : '#logo2'}}"></use>
                </svg>
            </div>
            <div class="slide__desc" hidden></div>
            <div class="slide__link mt-6">
                <a href="{{ url('/about')}}" class="button button--primary">
                    <h1>{{ __('nav.about') }}</h1>
                </a>
            </div>
        </div>
        @foreach($sections as $section)
            <div class="slide slide--current">
                <figure class="slide__img"
                        style="background-image: url({{ optional($section->getFirstMedia('cover'))->getFullUrl('banner') }});">
                </figure>

                <h2 class="slide__title font-heading">{{ $section->title }}</h2>
                @if ($section->hasTranslation('description'))
                    <p class="slide__desc text-white">{{ $section->description }}</p>
                @endif
                <div class="slide__link mt-6">
                    <a href="{{ route('client.collection.index', $section) }}" class="button button--primary">
                        {{ __('pages.sections.visit') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <nav class="slidenav text-white">
        <button class="slidenav__item slidenav__item--prev mr-3">
            <svg width="12" height="18">
                <use xlink:href="#arow-icon"></use>
            </svg>
        </button>
        <button class="slidenav__item slidenav__item--next">
            <svg width="12" height="18">
                <use xlink:href="#arow-icon"></use>
            </svg>
        </button>
    </nav>
</section>
<div class="mobile-top" style="background-image: url({{ asset('images/bg-mobile.jpg') }});">
    <svg fill="#fff" class="mobile-top__logo">
        <use xlink:href="{{app()->getLocale() == 'ru' ? '#logo2_rus' : '#logo2'}}"></use>
    </svg>
</div>
