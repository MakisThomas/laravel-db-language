<?php

namespace Makth\DbLanguage\Console\Commands;

use Illuminate\Console\Command;
use Makth\DbLanguage\Command\DbLanguage;

class AddDbLanguageFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:add {lang} {--default=English}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds language fields to DB';


    protected $lang;

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
        $this->lang->setDefaultLang($this->option('default'));

        (!$this->lang->checkLanguage($lang))
            ? $this->error("Language not found...")
            : $this->info($this->lang->handle($lang, $this->output));
    }


}
