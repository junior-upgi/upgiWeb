<?php
/**
 * Today資料存取庫
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 17/01/13
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Repositories;

use App\Models\TodayGlassProduce;

/**
 * Class TodayRepository
 *
 * @package App\Repositories
 */
class TodayRepository
{
    /** 注入 Today Model */
    public $today;

    /**
     * 建構式
     *
     * @param  TodayGlassProduce $today
     * @return void
     */
    public function __construct(TodayGlassProduce $today) 
    {
        $this->today = $today;
    }

    /**
     * 回傳最新上傳檔案日期
     *
     * @return string
     */
    public function getNewestDate()
    {
        return $this->today->orderBy('date', 'desc')->first()->date;
    }

    /**
     * 依傳入日期，回傳今日生產資訊
     * 以 1-1 線別優先排序
     *
     * @param string $date
     * @return Model
     */
    public function getProductionInfo($date)
    {
        return $this->today
            ->where('date', $date)
            ->orderByRaw("CASE WHEN line = '1-1' THEN 0 ELSE line END");
    }

    /**
     * 寫入今日生產資訊
     *
     * @param Array $data
     * @return Array
     */
    public function insertProductionInfo($data)
    {
        try {
            $this->today->getConnection()->beginTransaction();
            $this->today->insert($data);
            $this->today->getConnection()->commit();
            return ['success' => true];
        } catch (\Exception $e) {
            $this->today->getConnection()->rollback();
            return ['success' => false, $e->getMessage()];
        }
    }
}