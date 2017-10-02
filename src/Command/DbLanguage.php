<?php namespace Makth\DbLanguage\Command;

use Makth\DbLanguage\Fields;
use Makth\DbLanguage\LanguageList;

class DbLanguage extends Fields
{
    use LanguageList;

    protected $defaultLang;

    /**
     * add a language on db.
     *
     * @param $lang
     * @param null $progressBar
     * @return string
     */
    public function add($lang, $progressBar = null)
    {
        $code = $this->getLanguageCode($lang);

        if (empty($this->findFieldsWithLanguage($code))) {
            $this->createFields(
                $this->findFieldsWithLanguage($this->defaultLang), 
                $code, 
                $progressBar
            );
            return "\n\n Language added with success ....";
        }

        return "Language already exists or there is not default language in the database.";
    }


    /**
     * remove a language from db.
     *
     * @param $lang
     * @param null $progressBar
     * @return string
     */
    public function remove($lang, $progressBar = null){
        
        $code = $this->getLanguageCode($lang);

        if (!empty($this->findFieldsWithLanguage($code))) {
            $this->removeFields(
                $this->findFieldsWithLanguage($code), 
                $progressBar
            );
            return "\n\n Language removed with success ....";
        }

        return "This language is not installed in the database.";
    }


    /**
     * @param $lang
     */
    public function setDefaultLang($lang)
    {
        $this->defaultLang = $this->getLanguageCode($lang);
    }


}