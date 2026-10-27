@php $milestones = trans('company.timeline'); @endphp
<section class="section timeline" id="history" data-sky="golden" data-spine-label="{{ __('home.timeline.eyebrow') }}" data-timeline aria-labelledby="timeline-title">
    <div class="container">
        <header class="section-head section-head--split">
            <div>
                <p class="eyebrow">{{ $eyebrow ?? __('home.timeline.eyebrow') }}</p>
                <h2 id="timeline-title" class="h2" data-split>{{ $title ?? __('home.timeline.title') }}</h2>
            </div>
            <div class="segmented" role="radiogroup" aria-label="{{ __('home.timeline.calendar') }}" data-calendar-toggle>
                <button type="button" role="radio" aria-checked="true" data-calendar="gc">{{ __('home.timeline.gc') }}</button>
                <button type="button" role="radio" aria-checked="false" data-calendar="ec">{{ __('home.timeline.ec') }}</button>
            </div>
        </header>

        <div class="timeline__body">
            <div class="timeline__road" aria-hidden="true">
                <span class="timeline__track"></span>
                <span class="timeline__draw" data-timeline-draw></span>
            </div>
            <ol class="timeline__list">
                @foreach ($milestones as $m)
                    <li class="milestone milestone--{{ $m['status'] }}" data-milestone>
                        <span class="milestone__marker" aria-hidden="true">
                            <span data-cal="gc">{{ $m['marker'] }}</span><span data-cal="ec" hidden>{{ $m['marker_ec'] }}</span>
                        </span>
                        <span class="milestone__node" aria-hidden="true"></span>
                        <div class="milestone__body">
                            <p class="milestone__date"><span data-cal="gc">{{ $m['gc'] }}</span><span data-cal="ec" hidden>{{ $m['ec'] }}</span></p>
                            <h3 class="milestone__title">{{ $m['title'] }}</h3>
                            <p class="milestone__text">{{ $m['text'] }}</p>
                            @if ($m['status'] === 'planned')
                                <p class="status status--planned">{{ __('common.status.planned') }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
            <p class="timeline__note" data-cal="ec" hidden>{{ __('home.timeline.ec_note') }}</p>
        </div>
    </div>
</section>
