<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inquiry extends Model
{
    public const INTERESTS = ['fuel', 'lubricants', 'transport', 'coffee', 'partnership', 'other'];

    protected $fillable = [
        'reference', 'interest', 'name', 'organization', 'email', 'phone',
        'subject', 'message', 'details', 'ip_address', 'user_agent', 'mailed_at',
    ];

    protected function casts(): array
    {
        return [
            'details' => 'array',
            'mailed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Inquiry $inquiry) {
            $inquiry->reference ??= 'LFP-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
        });
    }

    public function interestLabel(): string
    {
        return __("contact.interests.{$this->interest}.label");
    }
}
