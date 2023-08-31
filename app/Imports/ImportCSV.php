<?php

namespace App\Imports;

use CSVImport;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCSV implements WithHeadingRow,ToArray
{

    public function Array(array $rows)
    {
      return $rows;
    }
}
