<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'user_id',
        'status',
        'cover_letter',
        'resume_file',
        'additional_info',
        'applied_at',
        'reviewed_at',
        'interview_scheduled_at',
        'employer_notes',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'additional_info' => 'json',
            'applied_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'interview_scheduled_at' => 'datetime',
        ];
    }

    /**
     * Get the job posting that was applied to
     */
    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    /**
     * Get the user who applied
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for accepted applications
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope for rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if application is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if application is accepted
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if application is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Accept the application
     */
    public function accept(string $notes = null): void
    {
        $this->update([
            'status' => 'accepted',
            'reviewed_at' => now(),
            'employer_notes' => $notes,
        ]);
    }

    /**
     * Reject the application
     */
    public function reject(string $reason = null): void
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }
}