<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'map_key'];

    /**
     * Disable or enable timestamps of created_at & updated_at.
     *
     * @var array
     */
    public $timestamps = false;

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
