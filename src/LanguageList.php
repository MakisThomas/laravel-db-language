<?php

namespace Makth\DbLanguage;

trait LanguageList
{

    /**
     * @return mixed
     */
    protected function getAllLanguages()
    {
        return include('languages.php');
    }


    /**
     * @return mixed
     */
    protected function getAllCountriesCodesWithLocales()
    {
        return include('countriesCodesWithLocales.php');
    }


    /**
     * @param $lang
     * @return bool
     */
    public function languageExists($lang)
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
     * @return array
     */
    public function getLanguagesCodes()
    {
        return array_keys($this->getAllLanguages());
    }


    /**
     * @param $locale
     * @return null
     */
    public function getCountryCodeFromLocale($locale)
    {
        return $this->getAllCountriesCodesWithLocales()[$locale]
            ? $this->getAllCountriesCodesWithLocales()[$locale]
            : null;
    }
}
