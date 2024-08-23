<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'licence_type_id',
        'notification_id',
        'name',
        'start_date',
        'end_date',
        'provider',
        'amount'
    ];

    public function licenceType(): BelongsTo
    {
        return $this->belongsTo(LicenceType::class, 'licence_type_id');
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }

}
