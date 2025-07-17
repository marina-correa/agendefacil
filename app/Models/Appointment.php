<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_email',
        'service_id',
        'date',
        'time',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
