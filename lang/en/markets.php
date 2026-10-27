<?php

// Customer categories: Company Profile 2026, p.8. The service mapping is an
// interpretation of the profile and needs company approval.

return [

    'meta_title' => 'Markets | LiFoPu Trading',
    'meta_description' => 'LiFoPu supplies fuel, lubricants and transportation solutions to motorists, commercial operators, fleets, construction, industry and government transport departments.',

    'eyebrow' => 'Markets',
    'title' => 'Everyone who keeps Ethiopia moving.',
    'lede' => 'LiFoPu caters to a diverse range of consumers, providing reliable and sustainable lubricants, fuel, and transportation solutions to individuals, businesses, and organizations.',

    'segments' => [
        'motorists' => ['title' => 'Individual motorists', 'text' => 'Fuel at our service stations, and lubricants for the vehicles people depend on every day.', 'services' => ['fuel-retail', 'lubricants']],
        'sme' => ['title' => 'Small and medium commercial vehicle operators', 'text' => 'Dependable fuel and automotive lubricants that keep working vehicles earning.', 'services' => ['fuel-retail', 'lubricants']],
        'fleets' => ['title' => 'Transport fleet owners and logistics companies', 'text' => 'Fuel, lubricants and bulk transport for operations where downtime is expensive.', 'services' => ['fuel-retail', 'lubricants', 'fuel-transportation']],
        'construction' => ['title' => 'Construction and heavy equipment operators', 'text' => 'Fuel and industrial lubricants for machines that work hard, a sector LiFoPu knows from its construction machinery rental years.', 'services' => ['lubricants', 'fuel-transportation']],
        'industrial' => ['title' => 'Industrial customers, including small and medium sized factories', 'text' => 'Industrial lubricants and fuel supply as essential inputs for manufacturing.', 'services' => ['lubricants', 'fuel-transportation']],
        'government' => ['title' => 'Corporate and government transport departments', 'text' => 'Reliable supply and continuity of service for institutional fleets.', 'services' => ['fuel-retail', 'lubricants', 'fuel-transportation']],
    ],

    'matrix_title' => 'Which capability serves whom',
    'matrix_caption' => 'Customer categories and the LiFoPu services most relevant to each.',

];
