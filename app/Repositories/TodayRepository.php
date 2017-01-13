<?php
namespace App\Repositories;

//
use App\Models\GlassProduce;
use App\Models\TodayGlassProduce;
use Carbon\Carbon;

//
class TodayRepository
{
    //
    public $today;
    //
    private $carbon;

    //
    public function __construct(
        TodayGlassProduce $today,
        Carbon $carbon
    ) {
        $this->today = $today;
        $this->carbon = $carbon;
    }

    public function getTodayGlassNewestDate()
    {
        return $this->today->orderBy('date', 'desc')->first()->date;
    }

    //
    public function getTodayGlassByDate($date)
    {
        return $this->today
            ->where('date', $date)
            ->orderByRaw("CASE WHEN line = '1-1' THEN 0 ELSE line END");
    }

    //
    public function getTodayImportGlass()
    {
        return $this->today
            ->where('date', $this->carbon->today())
            ->orderByRaw("CASE WHEN line = '1-1' THEN 0 ELSE line END");
    }

    //
    public function insertToday($data)
    {
        try {
            $this->today->getConnection()->beginTransaction();
            foreach ($data as $item) {
                $this->today->insert([
                    'line' => iconv('utf8', 'big5', $item[0]),
                    'glassNumber' => iconv('utf8', 'big5', $item[1]),
                    'weight' => iconv('utf8', 'big5', $item[2]),
                    'speed' => iconv('utf8', 'big5', $item[3]),
                    'quantity' => iconv('utf8', 'big5', $item[4]),
                    'nextNumber' => iconv('utf8', 'big5', $item[5]),
                    'change' => iconv('utf8', 'big5', $item[6]),
                    'testNumber' => iconv('utf8', 'big5', $item[7]),
                    'date' => $this->carbon->today(),
                    'created_at' => $this->carbon->now()
                ]);
            }
            $this->today->getConnection()->commit();
            return ['success' => true];
        } catch (\Exception $e) {
            $this->today->getConnection()->rollback();
            return ['success' => false, $e->getMessage()];
        }
    }
}