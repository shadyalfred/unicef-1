<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Get the reports for the governorate.
     */
    public function reports()
    {
        return $this->hasMany('App\CountryReport');
    }
}
