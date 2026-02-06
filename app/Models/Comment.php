<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'likes',
        'is_approved',
        'product_id',
        'user_id',
        'guest_name',
        'guest_email',
        'ip_address',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'likes' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function getAuthorNameAttribute()
    {
        if ($this->user) {
            return $this->user->name ?? $this->user->fullname ?? 'User';
        }
        return $this->guest_name ?? 'Guest';
    }

    public function getAuthorEmailAttribute()
    {
        if ($this->user) {
            return $this->user->email;
        }
        return $this->guest_email;
    }
}
