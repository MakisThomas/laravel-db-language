<?php 

namespace Makth\DbLanguage;

use Illuminate\Support\Facades\DB;

class DbMap{


	 /**
     * it gets all the names of db tables
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDbTables()
    {
        return collect(DB::connection()->getDoctrineSchemaManager()->listTableNames());
    }


    /**
     * creates an array with all db fields and keys the names of db tables
     *
     * @return static
     */
    public function tempArrayWithTablesAndFields()
    {
        return $this->getDbTables()->mapWithKeys(function ($table) {
            return [$table => $this->getTableFields($table) ];
        });
    }


    /**
     * @param $tableName
     * @return mixed
     */
    public function getTableFields($tableName){
    	return DB::getSchemaBuilder()->getColumnListing($tableName);
    }

}