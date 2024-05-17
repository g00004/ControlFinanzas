<?php

function countTable($table){
    $return = DB::select("SELECT count(*) as suma FROM $table")[0];
    return $return->suma;
}
