<?php

class BewertungAR extends \Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'gerichte_bewertungen';
    protected $primaryKey = 'benutzerid';

    public function scopeDateDescending($query) {
        return $query->orderBy('verfasst_am', 'DESC');
    }
}

