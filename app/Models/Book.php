<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    // Allowed values, reused by validation, forms and report filters
    public const CATEGORIES = ['Fiction', 'Nonfiction', 'Academic', "Children's Books"];
    public const STATUSES = ['Available', 'Unavailable'];

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'category',
        'unit_price',
        'description',
        'availability_status',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    // A Book belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}