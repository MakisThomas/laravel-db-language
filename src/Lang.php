<?php namespace Makth\DbLanguage;

use Illuminate\Support\HtmlString;

class Lang extends Fields
{

    protected $view;

    /**
     * Lang constructor.
     */
    function __construct()
    {
        $this->view = 'fields::' . config('lang.fields_view');
    }


    /**
     * @param $tableName
     * @param $field
     * @param null $defaultLanguage
     * @param array $options
     * @return HtmlString
     */
    public function fields($tableName, $field, $defaultLanguage = null, $options = [])
    {

        $defaultLanguage = ($defaultLanguage == null) ? config('app.locale') : $defaultLanguage;

        $languageFields = $this->findLangFieldsByTableAndField($tableName, $field);

        return new HtmlString(view($this->view, [
            'fields' => $languageFields['fields'],
            'type' => $languageFields['type'],
            'defaultLanguage' => $defaultLanguage,
            'option' => $options
        ]));
    }


    /**
     * @param $locale
     * @return string
     */
    public function convertLocaleToCountryCode($locale)
    {
        return strtolower($this->getCountryCodeFromLocale($locale));
    }
}
