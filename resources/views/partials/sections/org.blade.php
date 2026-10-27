@php $org = trans('company.org'); @endphp
<div class="org" data-org>
    <div class="org__head">
        <x-logo variant="mark" title="" class="org__mark" />
        <span>{{ $org['head'] }}</span>
    </div>
    <div class="org__trunk" aria-hidden="true"></div>
    <ul class="org__units">
        @foreach ($org['units'] as $unit)
            <li class="org__unit" data-reveal>
                <h3 class="org__unit-name">{{ $unit['name'] }}</h3>
                <p class="org__lead">{{ $unit['lead'] }}</p>
                @if (count($unit['teams']))
                    <ul class="org__teams">
                        @foreach ($unit['teams'] as $team)
                            <li>
                                <span class="org__team">{{ $team['name'] }}</span>
                                <span class="org__roles">{{ implode(' · ', $team['roles']) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
