<?php

namespace App\Imports;

use App\GovernorateReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GovernorateReportsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $governorate_id = \App\Governorate::where('name_ar', $row[1])->first()->id; // Get the foreign key for the governorate

        return new GovernorateReport([
            'governorate_id' => $governorate_id, // Foreign key field

            // From excel
            'males_under_5'          => $row[2],
            'males_from_5_to_15'     => $row[3],
            'females_under_5'        => $row[4],
            'females_from_5_to_15'   => $row[5],
            'pregnancy_visits'       => $row[9],
            'endangered_pregnancies' => $row[10],
            'other_visits'           => $row[11],
            'males_above_15_visits'  => $row[14],

            // From $request
            'date' => request()->date
        ]);
    }

    /**
     * Returns the number of the first row from which importing is started.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 7;
    }
}
