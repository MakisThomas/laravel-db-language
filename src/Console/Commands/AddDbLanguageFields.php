<?php

namespace Makth\DbLanguage\Console\Commands;

use Illuminate\Console\Command;
use Makth\DbLanguage\Command\DbLanguage;

class AddDbLanguageFields extends Command
{

    protected $lang;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:add { lang } { --default= }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add language fields in the database';


    /**
     * Create a new command instance.
     *
     * @param DbLanguage $lang
     */
    public function __construct(DbLanguage $lang)
    {
        parent::__construct();
        $this->lang = $lang;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lang = $this->argument('lang');

        ($defaultLang = $this->option('default'))
            ? $this->lang->setDefaultLang($defaultLang)
            : $this->lang->setDefaultLang(config('lang.default_lang'));


        (!$this->lang->languageExists($lang))
            ? $this->error("Language not found...")
            : $this->info($this->lang->add($lang, $this->output));
    }


}
