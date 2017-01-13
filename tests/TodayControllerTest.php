<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\TodayController;
use App\Service\TodayService;

class TodayControllerTest extends TestCase
{
    use WithoutMiddleware;

    /** @var TodayController */
    protected $today;

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
    public function testToday()
    {
        // arrange

        // act
        $this->target->today();
        $key = 'auth';
        $value = true;

        // assert
        $view = $this->visit('/production/today');
        $view->see('當日生產線一覽');
        $view->assertViewHas($key, $value);
    }
}
