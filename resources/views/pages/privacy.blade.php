<x-layout :title="__('privacy.meta_title')" :description="__('privacy.meta_description')" page="privacy">

    <section class="section legal" data-sky="morning" aria-labelledby="page-title">
        <div class="container legal__inner">
            <p class="eyebrow">{{ __('privacy.eyebrow') }}</p>
            <h1 id="page-title" class="h2">{{ __('privacy.title') }}</h1>
            <p class="legal__updated">{{ __('privacy.updated') }}</p>
            <div class="prose">
                @foreach (__('privacy.sections') as $section)
                    <h2>{{ $section['title'] }}</h2>
                    <p>{{ $section['text'] }}</p>
                @endforeach
            </div>
        </div>
    </section>

</x-layout>
