<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'address_id',
        'image',
        'proprietor_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function proprietor()
    {
        return $this->belongsTo(User::class);
    }
}
