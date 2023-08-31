<?php

namespace App\Http\Controllers;


use CSVImport;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    
    public function upload(Request $request){

        $csvFile = $request->file('csv_file');
       
      CSVImport::import_csv($csvFile);

   

    }
}
