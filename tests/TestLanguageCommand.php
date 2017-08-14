<?php namespace Makth\DbLanguage\Tests;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class TestLanguageCommand extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_add_a_language()
    {
        Artisan::call("language:add", ['lang' => 'Italian']);
        $this->assertContains('Language added with success', Artisan::output());
    }

    /** @test */
    public function a_user_cannot_add_language_that_is_not_exists()
    {
        Artisan::call("language:add", ['lang' => 'ArialBlack']);
        $this->assertContains('Language not found', Artisan::output());
    }

    /** @test */
    public function a_user_cannot_add_language_that_already_exists()
    {
        Artisan::call("language:add", ['lang' => 'English']);
        $this->assertContains('Language already exists', Artisan::output());
    }

    /** @test */
    public function a_user_can_add_language_based_on_custom_default_language()
    {
        Artisan::call("language:add", ['lang' => 'Spanish', '--default' => 'Greek']);
        $this->assertContains('Language added with success', Artisan::output());
    }

}