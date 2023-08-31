<?php

namespace App\Facades\CSV;

use App\Events\ProductCreated;
use App\Imports\ImportCSV;
use App\Jobs\ProductCsvProcess;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CSVImport
{

    public function import_csv($csvFile)
    {

        try {
            $csv = fopen($csvFile, 'r');
            $import = new ImportCSV();
            $data = Excel::toArray($import, $csvFile);

            $data = $data[0];
            $chunks = array_chunk($data,100);
            $batch= Bus::batch([])->dispatch();

            foreach ($chunks as $data) {

              $batch->add(new ProductCsvProcess($data));
            }
    
            return $batch;
        } catch (Exception $e) {
            dd($e);
        }

    }

    public function validateRow($row)
    {
        $rules = [
            // 'title'=>['required'],
            // 'body_html'=>['required'],
            // 'type'=>['required'],
            // 'published'=>['required'],

            // 'handle' => ['required']

        ];
        $validator = Validator::make($row, $rules);
        return $validator->fails() ? $validator->errors() : null;

    }
}