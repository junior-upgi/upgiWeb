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
use App\Repositories\TodayRepository;
//
use \Carbon\Carbon;

/**
 * Class ProduceService
 *
 * @package App\Service
 */
class TodayService
{
    //
    private $today;
    
    //
    private $excel;

    //
    private $carbon;

    public function __construct(
        TodayRepository $today,
        ExcelService $excel,
        Carbon $carbon
    ) {
        $this->today = $today;
        $this->excel = $excel;
        $this->carbon = $carbon;
    }

    /**
     * 取得上傳資料並進行格式判斷與寫入
     *
     * @param  Illuminate\Http\UploadedFile $data
     * @return array
     */
    public function importToday($data)
    {
        $table = $this->excel->getTableArray($data, 1);
        $ref = ['線別', '瓶號', '重量', '機速', '引出量', '下支瓶號', '預計換模時間', '試模瓶號', null];
        if ($table[0] != $ref) {
            return ['success' => false, '上傳檔案㯗位格式錯誤!'];
        }
        return $this->today->insertToday(array_slice($table,1));
    }

    public function getTodayNewest()
    {
        return $this->today->getTodayGlassByDate($this->today->getTodayGlassNewestDate())->get()->toArray();
    }

    public function getTodayDataImport()
    {
        return $this->today->getTodayGlassByDate($this->carbon->today())->get()->toArray();
    }
}