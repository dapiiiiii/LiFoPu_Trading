<?php

// Service descriptions quote the Company Profile 2026, p.7. Detail copy only
// reorganizes facts from the profile; see CONTENT_REGISTER.md.

return [

    'meta_title' => 'Products & Services | LiFoPu Trading',
    'meta_description' => 'Fuel retail sales, lubricants sales, bulk fuel transportation and coffee export trading from LiFoPu Trading, Ethiopia.',

    'index' => [
        'eyebrow' => 'Products & Services',
        'title' => 'Wholesale, retail and the road between.',
        'lede' => 'LiFoPu is mainly engaged in the wholesale and retail business of fuel and lubricants and in the operation of bulk fuel transportation, and has recently expanded into coffee export trading through its sister company, Lela Trading.',
        'products_title' => 'Essential inputs for daily economic life',
        'products_text' => 'LiFoPu delivers fuel, lubricants and LPG products that serve as essential inputs for transportation, construction, manufacturing and daily economic activity. Integrated retail, wholesale and bulk transportation operations keep supply reliable and operations continuous across our markets.',
    ],

    'items' => [

        'fuel-retail' => [
            'km' => '01',
            'title' => 'Fuel Retail Sales',
            'summary' => 'Supply of ground fuel products through service stations.',
            'meta_description' => 'LiFoPu operates four modern fuel service stations in Ethiopia: Amoudi Plaza, Pastor, Wolayta and Humbo NOC.',
            'palette' => 'trading',
            'scene' => 'station',
            'inquiry' => 'fuel',
            'hero_title' => 'Four stations. One standard.',
            'lede' => 'Supply of ground fuel products through four modern service stations: Amoudi Plaza, Pastor, Wolayta and Humbo NOC.',
            'sections' => [
                ['title' => 'The forecourt is where trust is earned', 'text' => 'Our service stations consistently rank among the top ten nationwide in combined fuel and lubricant sales, reflecting strong operational management, customer trust and supply chain efficiency.'],
                ['title' => 'Fuel as an essential input', 'text' => 'Fuel keeps transportation, construction, manufacturing and daily economic activity moving. Our integrated retail, wholesale and bulk transportation operations are built to keep supply reliable and operations continuous.'],
                ['title' => 'Standards at every pump', 'text' => 'LiFoPu maintains strict safety and environmental standards while continuously investing in service quality and infrastructure improvement.'],
            ],
            'facts' => [
                ['label' => 'Stations', 'value' => '4'],
                ['label' => 'Ranking', 'value' => 'Top 10'],
                ['label' => 'In retail since', 'value' => '2023'],
            ],
            'moment' => ['title' => 'When the canopy lights come on', 'text' => 'Dusk is when a service station shows what it stands for: light, order and readiness for every vehicle that pulls in.'],
            'next' => ['title' => 'What’s next at the forecourt', 'text' => 'LiFoPu plans to integrate electric vehicle charging alongside traditional fuel services, supporting both conventional vehicles and the growing electric mobility market.'],
            'audiences' => ['motorists', 'sme', 'fleets', 'government'],
        ],

        'lubricants' => [
            'km' => '02',
            'title' => 'Lubricants Sales',
            'summary' => 'Wholesale distribution and retail sales of automotive and industrial lubricants to retailers (gas stations, sub-distributors, resellers, lube shops), automotive garages, machine workshops, transport owners/operators, and industrial customers.',
            'meta_description' => 'LiFoPu is an authorized sub-distributor of Caltex lubricants, supplying automotive and industrial lubricants wholesale and retail in Ethiopia.',
            'palette' => 'gold',
            'scene' => 'oil',
            'inquiry' => 'lubricants',
            'hero_title' => 'Protection for every machine that moves.',
            'lede' => 'An authorized sub-distributor of Caltex lubricants, supplying automotive and industrial lubricants through wholesale and retail channels.',
            'sections' => [
                ['title' => 'Authorized sub-distributor of Caltex', 'text' => 'LiFoPu distributes Caltex automotive and industrial lubricants through wholesale and retail channels, backed by a dedicated lubricants team of sales representatives and store keepers.'],
                ['title' => 'The channels we supply', 'text' => 'Gas stations, sub-distributors, resellers and lube shops; automotive garages and machine workshops; transport owners and operators; and industrial customers.'],
                ['title' => 'Reliable supply, fair value', 'text' => 'Through strategic partnerships with trusted lubricant suppliers, we work to ensure a reliable supply of high-quality, affordable products, delivering seamless service, convenience and value.'],
            ],
            'channels' => ['Gas stations', 'Sub-distributors', 'Resellers', 'Lube shops', 'Automotive garages', 'Machine workshops', 'Transport owners & operators', 'Industrial customers'],
            'facts' => [
                ['label' => 'Brand', 'value' => 'Caltex'],
                ['label' => 'Channels', 'value' => 'Wholesale & retail'],
                ['label' => 'Range', 'value' => 'Automotive & industrial'],
            ],
            'moment' => ['title' => 'Weight, flow, protection', 'text' => 'Move across the ribbon. Good lubrication is felt before it is seen: smooth, steady and protective under load.'],
            'audiences' => ['motorists', 'sme', 'fleets', 'construction', 'industrial'],
        ],

        'fuel-transportation' => [
            'km' => '03',
            'title' => 'Fuel Transportation Services',
            'summary' => 'Operating a fleet of bulk fuel tanker trucks to transport petroleum products mainly from source depots to retail stations and commercial consumers.',
            'meta_description' => 'LiFoPu operates bulk fuel tanker trucks transporting petroleum products from source depots to retail stations and commercial consumers in Ethiopia.',
            'palette' => 'transport',
            'scene' => 'tanker',
            'inquiry' => 'transport',
            'hero_title' => 'Where LiFoPu began: on the road.',
            'lede' => 'A fleet of bulk fuel tanker trucks moving petroleum products mainly from source depots to retail stations and commercial consumers.',
            'sections' => [
                ['title' => 'Depot to destination', 'text' => 'Our tankers connect supply with demand: they collect petroleum products mainly at source depots and deliver them to retail stations and commercial consumers.'],
                ['title' => 'Safety and compliance first', 'text' => 'Bulk fuel is one of the most sensitive loads on any road. Every operation is held to our Commitment to Safety and Compliance: ensuring all operations meet regulatory and safety standards.'],
                ['title' => 'Continuity under pressure', 'text' => 'Reliability and Continuity is a core value: maintaining consistent operations and service, even during challenges. Transport management, logistics supervision and a technical team keep the operation moving.'],
            ],
            'route' => ['Source depot', 'Bulk tanker', 'Retail stations', 'Commercial consumers'],
            'facts' => [
                ['label' => 'On the road since', 'value' => '2013'],
                ['label' => 'Load', 'value' => 'Petroleum products'],
                ['label' => 'Delivers to', 'value' => 'Stations & commercial'],
            ],
            'moment' => ['title' => 'Follow the load', 'text' => 'Scroll to move the tanker from depot to destination.'],
            'audiences' => ['fleets', 'construction', 'industrial', 'government'],
        ],

        'coffee-export' => [
            'km' => '04',
            'title' => 'Coffee Export Trading',
            'summary' => 'Export of premium and commercial-grade Ethiopian coffee through our sister company, Lela Trading, sourced in compliance with national regulations and quality standards to ensure reliable and traceable global supply.',
            'meta_description' => 'Premium and commercial-grade Ethiopian coffee exported through Lela Trading, LiFoPu’s sister company.',
            'palette' => 'gold',
            'scene' => 'coffee',
            'inquiry' => 'coffee',
            'hero_title' => 'From Ethiopian highlands to the world.',
            'lede' => 'Premium and commercial-grade Ethiopian coffee, exported through our sister company Lela Trading.',
            'sections' => [
                ['title' => 'Coffee’s homeland', 'text' => 'Ethiopia is widely regarded as the birthplace of Arabica coffee. Exporting it carries a responsibility to the farmers, regions and traditions behind every bag.'],
                ['title' => 'Sourced by the rules', 'text' => 'Lela Trading sources coffee in compliance with national regulations and quality standards.'],
                ['title' => 'Reliable and traceable', 'text' => 'Compliance and quality discipline are what make supply reliable and traceable for buyers in international markets.'],
            ],
            'grades' => ['Premium grade', 'Commercial grade'],
            'facts' => [
                ['label' => 'Exported through', 'value' => 'Lela Trading'],
                ['label' => 'Grades', 'value' => 'Premium & commercial'],
                ['label' => 'Origin', 'value' => 'Ethiopia'],
            ],
            'moment' => ['title' => 'From bean to market', 'text' => 'A single bean, a country of origin, and a supply line that reaches outward.'],
            'audiences' => [],
        ],

    ],

    'labels' => [
        'at_a_glance' => 'At a glance',
        'who' => 'Who we serve',
        'next' => 'Next stop',
        'all' => 'All products & services',
        'inquire' => 'Start an inquiry',
        'planned' => 'Planned',
        'channels' => 'Channels we supply',
        'route' => 'The route',
        'grades' => 'Grades',
        'team' => 'The team behind it',
    ],

];
