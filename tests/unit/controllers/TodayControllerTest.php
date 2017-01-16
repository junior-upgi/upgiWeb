<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\TodayController;
use App\Service\TodayService;

class TodayControllerTest extends TestCase
{
    /** @var TodayController */
    protected $target;

    /** @var Mock */
    protected $mock;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->mock = $this->initMock(TodayService::class);
        $this->target = $this->app->make(TodayController::class);
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->target = null;
        $this->mock = null;
        parent::tearDown();
    }

    /**
     * Test TodayController@today
     *
     * @group TodayController
     * @group TodayController0
     */
    public function test_today()
    {
        // arrange

        // act
        $view = $this->target->today();
        $value = true;

        // assert
        $this->assertEquals($view->auth, $value);
    }

    public function test_importToday()
    {
        // arrange

        // act
        $view = $this->target->importToday();
        $value = true;

        // assert
        $this->assertEquals($view->auth, $value);
    }

    public function test_importTodayData()
    {
        // arrange
        $true = [];

        // act
        $this->mock->shouldReceive('importProductionInfo')
            ->once()
            ->withAnyArgs()
            ->andReturn($true);
        
        // assert
        $result = $this->target->importTodayData();
        $this->assertEquals($result, $true);
    }

    public function test_getTodayGlassProduction()
    {
        // arrange
        $true = [];

        // act
        $this->mock->shouldReceive('getNewestProductionInfo')
            ->once()
            ->withAnyArgs()
            ->andReturn($true);
        
        // assert
        $result = $this->target->getTodayGlassProduction();
        $this->assertEquals($result, $true);
    }
}
