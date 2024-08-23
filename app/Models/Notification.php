<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'duration_type',
        'notification_days',
    ];

    protected $casts = [
        'notification_days' => 'array'
    ];

    public function licences(): HasMany
    {
        return $this->hasMany(Licence::class);

    }
}
