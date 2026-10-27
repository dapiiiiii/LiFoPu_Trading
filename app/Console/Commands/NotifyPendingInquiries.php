<?php

namespace App\Console\Commands;

use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class NotifyPendingInquiries extends Command
{
    protected $signature = 'inquiries:notify';

    protected $description = 'Re-send team notifications for stored inquiries whose email failed';

    public function handle(): int
    {
        $pending = Inquiry::whereNull('mailed_at')->oldest()->get();

        if ($pending->isEmpty()) {
            $this->info('No pending inquiries.');

            return self::SUCCESS;
        }

        foreach ($pending as $inquiry) {
            try {
                Mail::to(config('lifopu.inquiries.to'))->send(new InquiryReceived($inquiry));
                $inquiry->forceFill(['mailed_at' => now()])->save();
                $this->line("Sent {$inquiry->reference}");
            } catch (Throwable $e) {
                report($e);
                $this->error("Failed {$inquiry->reference}: {$e->getMessage()}");
            }
        }

        return self::SUCCESS;
    }
}
