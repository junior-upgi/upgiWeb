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
//
use App\Service\ExcelService;
//
use App\Repositories\GlassRepository;
//
use \Carbon\Carbon;

/**
 * Class ProduceService
 *
 * @package App\Service
 */
class GlassService
{
    //
    private $glass;
    
    //
    private $excel;

    //
    private $carbon;

    //
    public function __construct(
        GlassRepository $glass,
        ExcelService $excel,
        Carbon $carbon
    ) {
        $this->glass = $glass;
        $this->excel = $excel;
        $this->carbon = $carbon;
    }

    //
    public function importGlass($data)
    {
        $table = $this->excel->getTableArray($data, 0);
        $ref = ['線別', '瓶號', '機速', '重量', '數量(萬)', '良率(％)', '下線日期', '備註'];
        if ($table[0] != $ref) {
            return ['success' => false, '上傳檔案㯗位格式錯誤!'];
        }
        return $this->glass->insertGlassData(array_slice($table,1));
    }

    //
    public function getGlass($search)
    {
        return $this->glass->getGlass($search)->get();
    }

    public function getTodayImportGlassData()
    {
        return $this->glass->getTodayImportGlassData()->get()->toArray();
    }
}