<?php namespace Makth\DbLanguage\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DbLanguage
{

    protected $defaultLang;

    /**
     * @param $lang
     * @param null $progressBar
     * @return string
     */
    public function handle($lang, $progressBar = null)
    {
        $code = $this->getLanguageCode($lang);

        if (empty($this->findFieldsWithLanguage($code))) {
            $this->createFields($this->findFieldsWithLanguage($this->defaultLang), $code, $progressBar);
            return "\n\n Language added with success ....";
        }

        return "Language already exists or there is not these default Language....";
    }


    /**
     * @param $lang
     */
    public function setDefaultLang($lang)
    {
        $this->defaultLang = $this->getLanguageCode($lang);
    }


    /**
     * @return mixed
     */
    protected function getAllLanguages()
    {
        return include(__DIR__ . '/../languages.php');
    }


    /**
     * @param $lang
     * @return bool
     */
    public function checkLanguage($lang)
    {
        return in_array($lang, $this->getAllLanguages());
    }


    /**
     * @param $lang
     * @return false|int|string
     */
    public function getLanguageCode($lang)
    {
        return array_search($lang, $this->getAllLanguages());
    }


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
            return [$table => DB::getSchemaBuilder()->getColumnListing($table)];
        });
    }


    /**
     * creates an array with the fields for translate and keys the names of db tables
     *
     * @param $code
     * @return array
     */
    protected function findFieldsWithLanguage($code)
    {

        $pattern = '/.*_(' . $code . ')/';
        $temp = [];
        foreach ($this->tempArrayWithTablesAndFields() as $tableName => $table)
            if (preg_grep($pattern, $table))
                $temp[$tableName] = preg_grep($pattern, $table);

        return $temp;
    }


    /**
     * @param $tableWithFields
     * @param $code
     * @param null $progressBar
     */
    protected function createFields($tableWithFields, $code, $progressBar = null)
    {
        $bar = $progressBar->createProgressBar(count($tableWithFields));

        foreach ($tableWithFields as $tableName => $fields) {
            array_map(function ($field) use ($tableName, $code) {
                Schema::table($tableName, function (Blueprint $table) use ($field, $code) {
                    $table->string(substr($field, 0, -2) . $code)->after($field)->nullable();
                });
            }, $fields);
            $bar->advance();
        }

        $bar->finish();
    }

}