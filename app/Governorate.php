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
}
