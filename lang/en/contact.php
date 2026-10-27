<?php

return [

    'meta_title' => 'Contact | LiFoPu Trading',
    'meta_description' => 'Talk to LiFoPu about fuel supply, lubricants, bulk fuel transportation, coffee trading or partnerships.',

    'eyebrow' => 'Contact',
    'title' => 'Tell us where you’re headed.',
    'lede' => 'Start with what you need. We will ask only the questions that matter for it.',

    'direct' => [
        'title' => 'Talk to us directly',
        'person' => 'Contact person',
        'phone' => 'Phone',
        'email' => 'Email',
    ],

    'steps' => [
        'need' => 'What do you need?',
        'details' => 'A few details',
        'you' => 'About you',
        'progress' => 'Step :current of :total',
        'next' => 'Continue',
        'back' => 'Back',
        'submit' => 'Send inquiry',
        'sending' => 'Sending…',
    ],

    'interests' => [
        'fuel' => ['label' => 'Fuel supply', 'hint' => 'Station or bulk fuel'],
        'lubricants' => ['label' => 'Lubricants', 'hint' => 'Automotive & industrial'],
        'transport' => ['label' => 'Fuel transportation', 'hint' => 'Bulk tanker service'],
        'coffee' => ['label' => 'Coffee trading', 'hint' => 'Through Lela Trading'],
        'partnership' => ['label' => 'Partnership', 'hint' => 'Suppliers & partners'],
        'other' => ['label' => 'Something else', 'hint' => 'Any other question'],
    ],

    'fields' => [
        'name' => 'Full name',
        'organization' => 'Organization',
        'organization_hint' => 'Optional for individuals',
        'email' => 'Business email',
        'phone' => 'Phone',
        'phone_hint' => 'Include the country code, e.g. +251',
        'subject' => 'Subject',
        'message' => 'Message',
        'privacy' => 'I agree that LiFoPu may use these details to respond to my inquiry, as described in the :link.',
        'privacy_link' => 'Privacy Policy',
        'customer_type' => 'Which best describes you?',
        'volume' => 'Estimated volume or quantity',
        'volume_hint' => 'For example, litres per month or units per order',
        'location' => 'Delivery or service location',
        'origin' => 'Pickup location',
        'destination' => 'Delivery location',
        'schedule' => 'Preferred timing',
        'grade' => 'Grade of interest',
        'market' => 'Destination market',
        'partner_type' => 'Type of partnership',
        'website' => 'Leave this field empty',
    ],

    'options' => [
        'customer_type' => [
            'motorist' => 'Individual motorist',
            'sme' => 'Small or medium commercial vehicle operator',
            'fleet' => 'Fleet owner or logistics company',
            'construction' => 'Construction or heavy equipment operator',
            'industrial' => 'Industrial customer or factory',
            'government' => 'Corporate or government transport department',
            'retailer' => 'Retailer, reseller or lube shop',
            'workshop' => 'Garage or machine workshop',
        ],
        'grade' => ['premium' => 'Premium grade', 'commercial' => 'Commercial grade', 'both' => 'Both / not sure'],
        'partner_type' => ['supplier' => 'Supplier', 'distribution' => 'Distribution', 'investment' => 'Investment', 'other' => 'Other'],
    ],

    'subjects' => [
        'fuel' => 'Fuel supply inquiry',
        'lubricants' => 'Lubricants inquiry',
        'transport' => 'Fuel transportation inquiry',
        'coffee' => 'Coffee trading inquiry',
        'partnership' => 'Partnership inquiry',
        'other' => 'General inquiry',
    ],

    'result' => [
        'success_title' => 'Inquiry received.',
        'success' => 'Thank you, :name. Your inquiry is recorded under reference :ref. The LiFoPu team will reply to :email.',
        'error_title' => 'We couldn’t send that.',
        'error' => 'Something went wrong on our side and your inquiry was not recorded. Please try again, or contact us directly by phone or email.',
        'throttled' => 'Too many attempts. Please wait a minute and try again.',
        'validation' => 'Please check the highlighted fields.',
        'another' => 'Send another inquiry',
    ],

    'mail' => [
        'internal_subject' => 'New inquiry :ref | :interest',
        'confirmation_subject' => 'We received your inquiry (:ref)',
        'confirmation_intro' => 'Thank you for contacting LiFoPu. This is a copy of your inquiry for your records. Our team will reply to you directly.',
    ],

];
