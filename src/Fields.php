<?php namespace Makth\DbLanguage;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Makth\DbLanguage\LanguageList;
use Illuminate\Support\Facades\DB;

class Fields extends DbMap
{

    use LanguageList;


    /**
     * creates an array with the fields for translate and keys the names of db tables
     *
     * @param $code
     * @return array
     */
    protected function findFieldsWithLanguage($code)
    {
        $pattern = '/^.*_(' . $code . ')$/';
        return $this->findFieldsOnDb($pattern);
    }


    /**
     * finds and return all lang fields in specific table.
     *
     * @param string $tableName table name
     * @param string $field field name
     * @return array
     */
    protected function findLangFieldsByTableAndField($tableName, $field)
    {
        $pattern = '/^' . $field . '_(' . implode($this->getLanguagesCodes(), '|') . ')$/';

        // reset array keys
        $languageFields = $this->resetKeys($tableName, $pattern);

        return [
            'fields' => $languageFields,
            'type' => (!empty($languageFields))
                        ? $this->getFieldType($tableName, $languageFields[0])
                        : []
        ];
    }


    /**
     * query to get db fields and types.
     *
     * @param $tableName
     * @param $field
     * @return mixed
     */
    private function getFieldType($tableName, $field)
    {
        return DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->where('TABLE_NAME', $tableName)
            ->where('COLUMN_NAME', $field)
            ->value('DATA_TYPE');
    }


    /**
     * @param $pattern
     * @return array
     */
    private function findFieldsOnDb($pattern)
    {
        $temp = [];
        foreach ($this->tempArrayWithTablesAndFields() as $tableName => $table)
            if ($fields = $this->findFieldsInSpecificTable($pattern, $table))
                $temp[$tableName] = $fields;
        return $temp;
    }


    /**
     * @param $pattern
     * @param $table
     * @return array
     */
    private function findFieldsInSpecificTable($pattern, $table)
    {
        return preg_grep($pattern, $table);
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
                $type = $this->getFieldType($tableName, $field);
                $self = $this;
                Schema::table($tableName, function (Blueprint $table) use ($self, $field, $type, $code) {
                    $self->generateField($table, $type, substr($field, 0, -2) . $code, $field);
                });
            }, $fields);
            $bar->advance();
        }

        $bar->finish();
    }


    /**
     * @param $table
     * @param $type
     * @param $fieldForGenerate
     * @param $field
     */
    private function generateField($table, $type, $fieldForGenerate, $field)
    {
        switch ($type) {
            case 'varchar':
                $table->string($fieldForGenerate)->after($field)->nullable();
                break;
            case 'text':
                $table->text($fieldForGenerate)->after($field)->nullable();
                break;
        }
    }


    /**
     * @param $tableWithFields
     * @param null $progressBar
     */
    protected function removeFields($tableWithFields, $progressBar = null)
    {
        $bar = $progressBar->createProgressBar(count($tableWithFields));

        foreach ($tableWithFields as $tableName => $fields) {
            array_map(function ($field) use ($tableName) {
                Schema::table($tableName, function (Blueprint $table) use ($field) {
                    $table->dropColumn($field);
                });
            }, $fields);
            $bar->advance();
        }

        $bar->finish();
    }


    /**
     * resets array keys
     *
     * @param $tableName
     * @param $pattern
     * @return array
     */
    protected function resetKeys($tableName, $pattern)
    {
        $languageFields = array_values(
            $this->findFieldsInSpecificTable($pattern, $this->getTableFields($tableName))
        );
        return $languageFields;
    }

}