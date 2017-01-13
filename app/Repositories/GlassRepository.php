<?php
namespace App\Repositories;

//
use App\Models\GlassProduce;

//
class GlassRepository
{
    //
    public $glass;

    //
    public function __construct(GlassProduce $glass) 
    {
        $this->glass = $glass;
    }

    //
    public function getGlass($search)
    {
        return $this->glass
            ->where('glassNumber', iconv('utf8', 'big5', $search))
            ->orderBy('offline', 'desc');
    }
    //
    public function getTodayImportGlassData()
    {
        return $this->glass
            ->where('date', \Carbon\Carbon::today())
            ->orderByRaw("CASE WHEN line = '1-1' THEN 0 ELSE line END");
    }

    //
    public function insertGlassData($data)
    {
        try {
            $this->glass->getConnection()->beginTransaction();
            $row = ['line', 'glassNumber', 'speed', 'weight', 'quantity', 'yield', 'offline', 'remark', 'date', 'created_at'];
            foreach ($data as $item) {
                $this->glass->insert($this->setParams($item));
            }
            $this->glass->getConnection()->commit();
            return ['success' => true];
        } catch (\Exception $e) {
            $this->glass->getConnection()->rollback();
            return ['success' => false, $e->getMessage()];
        }
    }

    private function setParams($item) {
        $set = [];
        $set['line'] = iconv('utf8', 'big5', $item[0]);
        $set['glassNumber'] = iconv('utf8', 'big5', $item[1]);
        $set['speed'] = iconv('utf8', 'big5', $item[2]);
        $set['weight'] = iconv('utf8', 'big5', $item[3]);
        $set['quantity'] = iconv('utf8', 'big5', $item[4]);
        $set['yield'] = iconv('utf8', 'big5', $item[5]);
        $set['offline'] = iconv('utf8', 'big5', $item[6]);
        $set['remark'] = iconv('utf8', 'big5', $item[7]);
        $set['date'] = \Carbon\Carbon::today();
        $set['created_at'] = \Carbon\Carbon::now();
        return $set;
    }
}