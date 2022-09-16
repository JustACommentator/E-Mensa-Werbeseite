<?php

class GerichtAR extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;

    protected $table = 'gericht';


    public function scopeNameAscending($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function getPreisInternAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getPreisExternAttribute($value)
    {
        return number_format($value, 2);
    }

    public function setVegetarischAttribute($value)
    {
        $yes = '/^\s*y\s*e\s*s\s*$/i';
        $no = '/^\s*n\s*o\s*$/i';
        if(preg_match($yes, $value))
            $this->attributes['vegetarisch'] = 1;
        else if(preg_match($no, $value))
            $this->attributes['vegetarisch'] = 0;
    }

    public function setVeganAttribute($value)
    {
        $yes = '/^\s*y\s*e\s*s\s*$/i';
        $no = '/^\s*n\s*o\s*$/i';
        if(preg_match($yes, $value))
            $this->attributes['vegan'] = 1;
        else if(preg_match($no, $value))
            $this->attributes['vegan'] = 0;
    }
}