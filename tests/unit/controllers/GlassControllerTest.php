<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\GlassController;
use App\Service\GlassService;

class GlassControllerTest extends TestCase
{
    protected $target;
    protected $mock;

    public function setUp()
    {
        parent::setUp();
        $this->mock = $this->initMock(GlassService::class);
        $this->target = $this->app->make(GlassController::class);
    }

    public function tearDown()
    {
        $this->target = null;
        $this->mock = null;
        parent::tearDown();
    }

    public function test_info()
    {
        // arrange

        // act
        $view = $this->target->info();
        $value = true;

        // assert
        $this->assertEquals($view->auth, $value);
    }

    public function test_importGlass()
    {
        $view = $this->target->importGlass();
        $value = true;

        $this->assertEquals($view->auth, $value);
    }

    public function test_importGlassData()
    {
        $true = [];

        $this->mock->shouldReceive('importGlass')
            ->once()
            ->withAnyArgs()
            ->andReturn($true);
        
        $result = $this->target->importGlassData();
        $this->assertEquals($result, $true);
    }

    public function test_getGlassProductionInfo()
    {
        $true = [];

        $this->mock->shouldReceive('getGlass')
            ->once()
            ->withAnyArgs()
            ->andReturn($true);
        
        $result = $this->target->getGlassProductionInfo();
        $this->assertEquals($result, $true);
    }   

    public function test_getTodayImportGlassData()
    {
        $true = [];

        $this->mock->shouldReceive('getTodayImportGlassData')
            ->once()
            ->withAnyArgs()
            ->andReturn($true);
        
        $result = $this->target->getTodayImportGlassData();
        $this->assertEquals($result, $true);
    }
}
