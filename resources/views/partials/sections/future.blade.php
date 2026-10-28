<section class="section future" data-sky="night" data-spine-label="{{ __('home.future.eyebrow') }}" aria-labelledby="future-title">
    <div class="future__horizon" aria-hidden="true"><span></span></div>
    <div class="container">
        <header class="section-head">
            <p class="eyebrow">{{ __('home.future.eyebrow') }}</p>
            <h2 id="future-title" class="h2" data-split>{{ __('home.future.title') }}</h2>
            <p class="lead">{{ __('home.future.lede') }}</p>
        </header>
        <div class="future__grid">
            <div class="horizon-col horizon-col--operating" data-reveal>
                <h3 class="horizon-col__title"><span class="horizon-col__line" aria-hidden="true"></span>{{ __('common.status.operating') }}</h3>
                <ul>
                    @foreach (__('home.future.operating') as $item)
                        <li><x-logo variant="mark" title="" class="horizon-col__bullet" />{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="horizon-col horizon-col--planned" data-reveal>
                <h3 class="horizon-col__title"><span class="horizon-col__line" aria-hidden="true"></span>{{ __('common.status.planned') }}</h3>
                <ul>
                    @foreach (__('home.future.planned') as $item)
                        <li><x-logo variant="mark" title="" class="horizon-col__bullet" />{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="horizon-col horizon-col--confirmed" data-reveal>
                <h3 class="horizon-col__title"><span class="horizon-col__line" aria-hidden="true"></span>{{ __('common.status.confirmed') }}</h3>
                <p>{{ __('home.future.confirmed_empty') }}</p>
            </div>
        </div>
    </div>
</section>
