<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountriesReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->header('Content-Language') === 'ar') {
            return [
                'id' => $this->id,
    
                'country' => $this->country->country_ar,
    
                'males_under_5'        => $this->males_under_5,
                'males_from_5_to_15'   => $this->males_from_5_to_15,
                'females_under_5'      => $this->females_under_5,
                'females_from_5_to_15' => $this->females_from_5_to_15,
    
                'total_under_5'      => $this->total_under_5,
                'total_from_5_to_15' => $this->total_from_5_to_15,
                'total_kids_visits'  => $this->total_kids_visits,
    
                'pregnancy_visits'       => $this->pregnancy_visits,
                'endangered_pregnancies' => $this->endangered_pregnancies,
                'other_visits'           => $this->other_visits,
    
                'total_women_visits'          => $this->total_women_visits,
                'total_women_and_kids_visits' => $this->total_women_and_kids_visits,
    
                'males_above_15_visits' => $this->males_above_15_visits,
    
                'total_visits' => $this->total_visits,
    
                'date' => $this->date,
            ];
        } else {
            return [
                'id' => $this->id,

                'country' => $this->country->country_en,

                'males_under_5'        => $this->males_under_5,
                'males_from_5_to_15'   => $this->males_from_5_to_15,
                'females_under_5'      => $this->females_under_5,
                'females_from_5_to_15' => $this->females_from_5_to_15,

                'total_under_5'      => $this->total_under_5,
                'total_from_5_to_15' => $this->total_from_5_to_15,
                'total_kids_visits'  => $this->total_kids_visits,

                'pregnancy_visits'       => $this->pregnancy_visits,
                'endangered_pregnancies' => $this->endangered_pregnancies,
                'other_visits'           => $this->other_visits,

                'total_women_visits'          => $this->total_women_visits,
                'total_women_and_kids_visits' => $this->total_women_and_kids_visits,

                'males_above_15_visits' => $this->males_above_15_visits,

                'total_visits' => $this->total_visits,

                'date' => $this->date,
            ];
        }
    }
}
