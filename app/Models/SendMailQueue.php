<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SendMailQueue extends Model
{
    protected $fillable = [
        'mail_class',
        'to_email',
        'subject',
        'error_message',
        'attempts',
        'last_attempt_at',
        'is_sent'
    ];

    protected $casts = [
        'is_sent' => 'boolean',
        'last_attempt_at' => 'datetime',
    ];

    public function mailable(): MorphTo
    {
        return $this->morphTo();
    }

    public function incrementAttempts(): void
    {
        $this->increment('attempts');
        $this->update(['last_attempt_at' => now()]);
    }

    public function markAsSent(): void
    {
        $this->update(['is_sent' => true]);
    }

    public function recordError(string $message): void
    {
        $this->update(['error_message' => $message]);
    }
}
