<?php
/**
 * 生產部相關處理方法
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 17/01/12
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Service;

use App\Service\ExcelService;
use App\Repositories\TodayRepository;
use Carbon\Carbon;

/**
 * Class TodayService
 *
 * @package App\Service
 */
class TodayService
{
    /** 注入 TodayRepository */
    private $today;
    
    /** 注入 ExcelService */
    private $excel;

    /**
     * 建構式
     *
     * @param TodayRepository $today
     * @param  ExcelService $excel
     */
    public function __construct(
        TodayRepository $today,
        ExcelService $excel
    ) {
        $this->today = $today;
        $this->excel = $excel;
    }

    /**
     * @param $data
     * @return \App\Repositories\array|array
     */
    public function importProductionInfo($data)
    {
        $table = $this->excel->getTodayArray($data, 1);
        //$ref = ['線別', '瓶號', '重量', '機速', '引出量', '下支瓶號', '預計換模時間', '試模瓶號'];
        if ($table == null) {
            return ['success' => false, 'msg' => '上傳檔案格式錯誤!'];
        }
        return $this->today->insertProductionInfo($table);
    }

    /**
     * 取得並回傳最新上傳生產資訊
     *
     * @return array
     */
    public function getNewestProductionInfo()
    {
        $newest = $this->today->getNewestDate();
        return $this->today->getProductionInfo($newest)->get()->toArray();
    }

    /**
     * 取得並回傳今日上傳生產資訊
     *
     * @return array
     */
    public function getTodayImportInfo()
    {
        return $this->today->getProductionInfo(Carbon::today())->get()->toArray();
    }
}