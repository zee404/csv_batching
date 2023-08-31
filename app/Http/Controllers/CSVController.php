<?php

namespace App\Http\Controllers;


use CSVImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class CSVController extends Controller
{

  function index()
  {
    return view('upload');
  }
  public function upload(Request $request)
  {

    $csvFile = $request->file('csv_file');

    $batch = CSVImport::import_csv($csvFile);

    return redirect()->route('batch',['id'=>$batch->id]);


  }

  public function batch($id){
    $batch = Bus::findBatch($id);
    return $batch;
  }
}