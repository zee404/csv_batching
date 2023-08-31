<?php

namespace App\Facades\CSV;
use Illuminate\Support\Facades\Facade;

class CSVImportFacade extends Facade{

    
   /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CSVImport';
    }
}