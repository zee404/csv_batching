<?php

namespace App\Facades\CSV;
use App\Imports\ImportCSV;
use Exception;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CSVImport {

    public function import_csv($csvFile){
     
        try{
            $csv = fopen($csvFile, 'r');
            $import = new ImportCSV();
           $data= Excel::toArray($import,$csvFile);
           $data= $data[0];
            $invalidData=collect();
            $validatedData=collect();
            
        
        //    dd($data);
           foreach ($data as $row) {
            $validationErrors = $this->validateRow($row);

            if ($validationErrors) {
                // print_r($row);
                // dd($validationErrors);
                // Row failed validation, add it to the invalid data collection
                $invalidData->push([
                    'row' => $row,
                    'errors' => $validationErrors,
                ]);
            } else {
                // Row passed validation, add it to the validated data collection
                $validatedData->push($row);
            }


           
        }
         dd($validatedData);
        }catch(Exception $e){
            dd($e);
        }

    }

    public function validateRow($row){
        $rules=[
            // 'title'=>['required'],
            // 'body_html'=>['required'],
            // 'type'=>['required'],
            // 'published'=>['required'],

            'handle'=>['required',]

        ];
        $validator = Validator::make($row, $rules);
        return $validator->fails()? $validator->errors() :null;

    }
}