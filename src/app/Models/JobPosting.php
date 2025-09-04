<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'category_id',
        'location_id',
        'title',
        'description',
        'requirements',
        'benefits',
        'employment_type',
        'salary_min',
        'salary_max',
        'salary_type',
        'required_people',
        'work_start_date',
        'work_end_date',
        'work_start_time',
        'work_end_time',
        'status',
        'expires_at',
        'view_count',
        'tags',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'work_start_date' => 'date',
            'work_end_date' => 'date',
            'work_start_time' => 'datetime:H:i',
            'work_end_time' => 'datetime:H:i',
            'expires_at' => 'datetime',
            'tags' => 'json',
            'is_featured' => 'boolean',
            'view_count' => 'integer',
        ];
    }

    /**
     * Get the company that owns the job posting
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the category of the job posting
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the location of the job posting
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get job applications for this posting
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * Scope for active job postings
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope for featured job postings
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Check if job posting is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expires_at > now();
    }

    /**
     * Get salary range display
     */
    public function getSalaryRangeAttribute(): string
    {
        if ($this->salary_max) {
            return number_format($this->salary_min) . ' - ' . number_format($this->salary_max);
        }
        return number_format($this->salary_min);
    }

    /**
     * Increment view count
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }
}