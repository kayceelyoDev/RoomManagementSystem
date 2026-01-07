<?php

namespace App\Services;

use App\Models\CheckinTable;
use Exception;

class CheckinServices
{
    /**
     * Create a new class instance.
     */
  
        //
        public function createCheckin(array $data){
            try{
                $room= CheckinTable::create([$data]);
                return $room;
            }catch(Exception $e){
                throw $e;
            }
        }
    
}
