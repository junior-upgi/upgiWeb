<?php
//
namespace App\Http\Controllers;

//
use App\Service\TodayService;

//
class TodayController
{
    //
    private $today;

    //
    public function __construct(
        TodayService $today
    ) {
        //
        $this->today = $today;
    }

    //
    public function today()
    {
        return view('production.todayProduce')
            ->with('auth', true);
    }

    //
    public function importToday()
    {
        return view('production.importToday')
            ->with('auth', true);
    }

    //
    public function importTodayData()
    {
        return $this->today->importToday(request()->file('todayFile'));
    }

    // *
    public function getTodayGlassProduction()
    {
        return $this->today->getTodayNewest();
    }

    public function getTodayImportGlassProduction()
    {
        return $this->today->getTodayDataImport();
    }
}
