<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helper
{
    public static function getRow($tableName)
    {
        $rerult = DB::table($tableName)->count() + 1;
        return $rerult;
    }

    public static function getDescription($tableName){
        return DB::select("DESCRIBE $tableName");
    }

    public static function getSpecificColumn($tableTextCombobox, $columnName, $nameTextCombobox){
        return DB::table($tableTextCombobox)
        ->select($columnName, $nameTextCombobox)
        ->get();
    }
}
