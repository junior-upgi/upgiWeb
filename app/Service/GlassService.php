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
use App\Repositories\GlassRepository;
use \Carbon\Carbon;

/**
 * Class GlassService
 *
 * @package App\Service
 */
class GlassService
{
    /** 注入 GlassRepository */
    private $glass;
    
    /** 注入 ExcelService */
    private $excel;

    /**
     * 建構式
     *
     * @param GlassRepository $glass
     * @param  ExcelService $excel
     * @internal param GlassProduce $today
     */
    public function __construct(
        GlassRepository $glass,
        ExcelService $excel
    ) {
        $this->glass = $glass;
        $this->excel = $excel;
    }

    /**
     * 取得並回傳今日上傳瓶號生產資料
     *
     * @param $data
     * @return \App\Repositories\array|array
     */
    public function importGlass($data)
    {
        $table = $this->excel->getGlassArray($data, 0);
        //$ref = ['線別', '瓶號', '機速', '重量', '數量(萬)', '良率(％)', '下線日期', '備註'];
        if (count($table[0]) != 10) {
            return ['success' => false, '上傳檔案㯗位格式錯誤!'];
        }
        return $this->glass->insertGlassData(array_slice($table,1));
    }

    /**
     * 依搜尋條件回傳瓶號生產資料
     *
     * @param $search
     * @return \App\Repositories\array|array
     * @internal param string $data
     */
    public function getGlass($search)
    {
        return $this->glass->getGlass($search)->get()->toArray();
    }

    /**
     * 取得並回傳今日上傳瓶號生產資料
     * @return array
     * @internal param string $data
     */
    public function getTodayImportGlassData()
    {
        return $this->glass->getTodayImportData()->get()->toArray();
    }
}