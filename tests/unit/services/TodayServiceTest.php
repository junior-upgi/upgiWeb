<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Service\TodayService;
use App\Http\Repositories\TodayRepository;
use App\Service\ExcelService;

class TodayServiceTest extends TestCase
{
    protected $target;
    protected $mockExcel;
    protected $mockToday;

    public function setUp()
    {
        parent::setUp();
        $this->mockToday = $this->initMock(TodayRepository::class);
        $this->mockExcel = $this->initMock(ExcelService::class);
        $this->target = $this->app->make(TodayService::class);
    }

    public function tearDown()
    {
        $this->target = null;
        $this->mockToday = null;
        $this->mockExcel = null;
        parent::tearDown();
    }

    public function test_importProductionInfo()
    {
        $trueData = [[0,1,2,3,4,5,6,7,8,9,10], [0,1,2,3,4,5,6,7,8,9,10]];
        $falseData = [];

        $resultSuccess = ['success' => true, ''];
        
        $this->mockExcel->shouldReceive('getTodayArray')
            ->once()
            ->withAnyArgs()
            ->andReturn($falseData);
        /*
        $this->mockToday->shouldReceive('insertProductionInfo')
            ->once()
            ->withAnyArgs()
            ->andReturn($resultSuccess);
        */
        $result = $this->target->importProductionInfo('');
        dd($result);
        $this->assertEquals($result['success'], true);
        
        $this->mockExcel->shouldReceive('getTodayArray')
            ->once()
            ->withAnyArgs()
            ->andReturn($falseData);
        
        $result = $this->target->importProductionInfo('');
        $this->assertEquals($result['success'], false);
    }
}
