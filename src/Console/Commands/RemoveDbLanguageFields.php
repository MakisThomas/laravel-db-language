<?php

namespace Makth\DbLanguage\Console\Commands;

use Illuminate\Console\Command;
use Makth\DbLanguage\Command\DbLanguage;

class RemoveDbLanguageFields extends Command
{

    protected $lang;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:remove { lang }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove language fields from database';


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

        (!$this->lang->languageExists($lang))
            ? $this->error("Language not found...")
            : $this->info($this->lang->remove($lang, $this->output));
    }


}
