<?php
//
namespace App\Http\Controllers;

//
use App\Service\TodayService;

//
class TodayController extends Controller
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
        request()->setTrustedProxies(['192.168.168.1']);

        $ip = request()->getClientIp();
        return view('production.todayProduce')
            ->with('auth', true)
            ->with('ip', $ip);
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
        return $this->today->importProductionInfo(request()->file('todayFile'));
    }

    //
    public function getTodayGlassProduction()
    {
        return $this->today->getNewestProductionInfo();
    }

    public function getTodayImportGlassProduction()
    {
        return $this->today->getTodayImportInfo();
    }
}
