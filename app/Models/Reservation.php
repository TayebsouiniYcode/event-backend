<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'quantity',
        'price',
        'reservation_date',
        'paid',
    ];

    protected $appends = [
        'ticket',
        'user',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTicketAttribute()
    {
        return $this->ticket()->first();
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }
}
