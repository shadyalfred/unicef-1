<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GovernorateReport extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Add extra calculated attributes.
     *
     * @var array
     */
    protected $appends = ['total_under_5', 'total_from_5_to_15', 'total_kids_visits',
        'total_women_visits', 'total_women_and_kids_visits', 'total_visits'];

    public function getTotalUnder5Attribute()
    {
        return $this->males_under_5 + $this->females_under_5;
    }

    public function getTotalFrom5To15Attribute()
    {
        return $this->males_from_5_to_15 + $this->females_from_5_to_15;
    }

    public function getTotalKidsVisitsAttribute()
    {
        return $this->total_under_5 + $this->total_from_5_to_15;
    }

    public function getTotalWomenVisitsAttribute()
    {
        return $this->pregnancy_visits + $this->endangered_pregnancies + $this->other_visits;
    }

    public function getTotalWomenAndKidsVisitsAttribute()
    {
        return $this->total_women_visits + $this->total_kids_visits;
    }

    public function getTotalVisitsAttribute() {
        return $this->total_women_and_kids_visits + $this->males_above_15_visits;
    }

    /**
     * Disable or enable timestamps of created_at & updated_at.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Get the governorate for this report.
     *
     * @return \App\Governorate
     */
    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }
}
