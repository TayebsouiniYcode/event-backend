<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class texte extends Model
{
    use HasFactory;

    protected $table = 'long_description';
    public $timestamps = false;


    protected $fillable = [
        'title',
        'subtitle',
        'texte',
        'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function setTexte($texte)
    {
        $this->texte = $texte;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        return $this->subtitle = $subtitle;
    }
}
