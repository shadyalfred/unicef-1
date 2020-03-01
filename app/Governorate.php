<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    /**
     * Get the reports for the governorate.
     */
    public function reports()
    {
        return $this->hasMany('App\GovernorateReport');
    }

    /**
     * Get the Syrians reports for the governorate.
     */
    public function syriansReports()
    {
        return $this->hasMany('App\SyriansReport');
    }
}
