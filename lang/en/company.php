<?php

// Shared company facts. Sources: LiFoPu Company Profile 2026 (P) and
// LiFoPu Brand Guideline 2025 (G). See CONTENT_REGISTER.md for status.

return [

    'name' => 'LiFoPu Trading',
    'tagline' => 'Live For Purpose.',

    // P.3
    'acronym' => 'The name LiFoPu is an acronym for “Live For Purpose,” symbolizing a commitment to pursuing one’s purpose wholeheartedly.',
    // G.5
    'acronym_brand' => 'Wholehearted dedication to Mission, People, and Progress.',

    // P.6: exact wording.
    'mission' => 'At LiFoPu, we are dedicated to delivering uninterrupted services while upholding the highest standards of quality, integrity, and customer satisfaction. Our mission is to be an industry leader in the petroleum distribution industry, offering sustainable and innovative solutions to meet the evolving needs of consumers.',
    'vision' => 'Our vision is to be a leading and trusted force in petroleum distribution and transportation, driving efficiency, innovation, and sustainable growth while powering industries and communities.',

    // P.9: exact wording.
    'competitive_advantage' => 'LiFoPu stands out for its commitment to operational excellence, reliability, and customer satisfaction. In addition, we continuously explore innovative solutions to enhance our offerings and exceed customer expectations by leveraging the power of well-interpreted data.',

    // P.9: exact wording.
    'values' => [
        ['name' => 'Customer-Centric Approach', 'text' => 'prioritizing the needs and satisfaction of our customers.', 'glyph' => 'pinwheel'],
        ['name' => 'Commitment to Safety and Compliance', 'text' => 'ensuring all operations meet regulatory and safety standards.', 'glyph' => 'diamond'],
        ['name' => 'Environmental Sustainability', 'text' => 'promoting eco-friendly practices and responsible resource use.', 'glyph' => 'pairs'],
        ['name' => 'Reliability and Continuity', 'text' => 'maintaining consistent operations and service, even during challenges.', 'glyph' => 'star'],
        ['name' => 'Local Impact and Job Creation', 'text' => 'contributing to economic growth by creating employment opportunities and supporting local communities.', 'glyph' => 'mark'],
    ],

    // P.2: competitive strengths.
    'strengths' => ['Disciplined execution', 'Data-informed decision-making', 'Regulatory compliance', 'A customer-first approach'],

    // P.3
    'stations' => ['Amoudi Plaza', 'Pastor', 'Wolayta', 'Humbo NOC'],

    // P.2 / P.3: figures must be confirmed as current before launch.
    'stats' => [
        ['key' => 'founded', 'value' => '2013', 'count' => 2013, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'label' => 'Established', 'detail' => 'August 2013, as a transport company'],
        ['key' => 'stations', 'value' => '4', 'count' => 4, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'label' => 'Modern fuel service stations', 'detail' => 'Amoudi Plaza · Pastor · Wolayta · Humbo NOC'],
        ['key' => 'turnover', 'value' => 'ETB 4.6B+', 'count' => 4.6, 'decimals' => 1, 'prefix' => 'ETB ', 'suffix' => 'B+', 'label' => 'Annual sales turnover', 'detail' => 'Exceeding ETB 4.6 billion'],
        ['key' => 'people', 'value' => '100+', 'count' => 100, 'decimals' => 0, 'prefix' => '', 'suffix' => '+', 'label' => 'Permanent employees', 'detail' => 'A workforce of more than 100'],
    ],
    'ranking' => 'Our service stations consistently rank among the top ten nationwide in combined fuel and lubricant sales.',
    'stats_source' => 'Figures as published in the LiFoPu Company Profile, 2026 edition.',

    // P.2, P.3, P.7, P.10. Ethiopian calendar equivalents verified by date arithmetic.
    'timeline' => [
        [
            'id' => 'founded',
            'gc' => 'August 2013',
            'ec' => 'Hamle to Nehase 2005 E.C.',
            'marker' => '2013',
            'marker_ec' => '2005',
            'title' => 'Founded as a transport company',
            'text' => 'LiFoPu was established in August 2013, initially as a transport service provider. The road is where the company began.',
            'status' => 'done',
        ],
        [
            'id' => 'machinery',
            'gc' => 'Later',
            'ec' => 'Later',
            'marker' => 'Then',
            'marker_ec' => 'Then',
            'title' => 'Construction machinery rental',
            'text' => 'The company strategically evolved into construction machinery rental, part of a disciplined growth strategy focused on high-impact sectors of the economy.',
            'status' => 'done',
        ],
        [
            'id' => 'petroleum',
            'gc' => 'August 2023',
            'ec' => 'Hamle to Nehase 2015 E.C.',
            'marker' => '2023',
            'marker_ec' => '2015',
            'title' => 'Petroleum distribution and retail',
            'text' => 'LiFoPu expanded into the distribution and retailing of petroleum products: fuel, lubricants and LPG, which are strategic inputs for economic development and the day-to-day life of society.',
            'status' => 'done',
        ],
        [
            'id' => 'today',
            'gc' => 'Today',
            'ec' => 'Today',
            'marker' => 'Now',
            'marker_ec' => 'Now',
            'title' => 'An integrated energy operation',
            'text' => 'Four modern fuel service stations, authorized sub-distribution of Caltex lubricants, and integrated retail, wholesale and bulk transportation operations, plus coffee export trading through sister company Lela Trading.',
            'status' => 'done',
        ],
        [
            'id' => 'ev',
            'gc' => 'Planned',
            'ec' => 'Planned',
            'marker' => 'Ahead',
            'marker_ec' => 'Ahead',
            'title' => 'EV charging alongside fuel',
            'text' => 'LiFoPu plans to integrate electric vehicle charging infrastructure alongside traditional fuel services, ready for a gradual transition toward diversified energy.',
            'status' => 'planned',
        ],
    ],

    // P.5: functions only, no names.
    'org' => [
        'head' => 'General Manager',
        'units' => [
            ['name' => 'Operations', 'lead' => 'Operations Manager', 'teams' => [
                ['name' => 'Retail', 'roles' => ['Station supervisors', 'Court supervisors', 'Cashiers', 'Pump attendants', 'Storekeepers']],
                ['name' => 'Transport', 'roles' => ['Transport manager', 'Logistics supervisor']],
                ['name' => 'Technical', 'roles' => ['Technical supervisor', 'Technicians']],
            ]],
            ['name' => 'Lubricants', 'lead' => 'Lubricants Manager', 'teams' => [
                ['name' => 'Sales', 'roles' => ['Sales representatives']],
                ['name' => 'Stores', 'roles' => ['Store keepers']],
            ]],
            ['name' => 'Resources', 'lead' => 'Resources Manager', 'teams' => [
                ['name' => 'People', 'roles' => ['Human resources']],
                ['name' => 'Systems', 'roles' => ['IT systems']],
                ['name' => 'Property', 'roles' => ['Real estate']],
            ]],
            ['name' => 'Finance', 'lead' => 'Finance Manager', 'teams' => [
                ['name' => 'Accounting', 'roles' => ['Chief accountant', 'Cashiers']],
                ['name' => 'Ledgers', 'roles' => ['Accounts receivable', 'Accounts payable']],
            ]],
            ['name' => 'Legal', 'lead' => 'Legal Department', 'teams' => []],
            ['name' => 'Internal Audit', 'lead' => 'Internal Auditor', 'teams' => []],
        ],
    ],

    // P.4: summary of the founder profile. Needs company approval to publish.
    'founder' => [
        'name' => 'Sebhat Gebrehiwot Tasew',
        'role' => 'Founder',
        'paragraphs' => [
            'Sebhat Gebrehiwot Tasew, founder of LiFoPu, has long experience managing B2C and B2B business developments and operations in the petroleum distribution industry. His career began as a junior technical and marketing lubricants expert and progressed to the top managerial positions leading Sales and Marketing, commonly named the Retail and Commercial departments, which are the core business functions of the sector.',
            'By training he is a Mechanical Engineering graduate from Addis Ababa University and a Certified Manager from Madison University, Virginia, in collaboration with ICMP. He is also certified in Data Analytics from Google and Targeted Technologies, USA, with extensive experience in target-oriented wholesale and retail sales, marketing, customer service and supply chain in the petroleum sector.',
        ],
    ],

    // G.9: concept behind the mark.
    'mark_story' => [
        ['title' => 'Guiding symbol: northing arrow', 'text' => 'Represents direction, clarity, and progress. The upward arrow is a metaphor for purposeful growth, LiFoPu’s True North across all industries.'],
        ['title' => 'Letter ‘L’ integration', 'text' => 'The ‘L’ from LiFoPu forms the base of the arrow, tying the symbol back to brand identity while reinforcing recognition and originality.'],
        ['title' => 'Final mark', 'text' => 'A dynamic, abstract arrow with a subtle ‘L’, symbolizing forward momentum and purpose. Its split form signifies guidance and purpose.'],
    ],

    // G.8
    'personality' => 'Reliably bold, clean, fast, and supremely professional yet always grounded in the people and places that make LiFoPu’s success possible.',

];
