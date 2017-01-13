<?php
/**
 * excel相關處理方法
 *
 * @version 1.0.1
 * @author spark it@upgi.com.tw
 * @date 17/01/12
 * @since 1.0.0 spark: 於此版本開始編寫註解
 * @since 1.0.1 spark: 優化程式碼
 */
namespace App\Service;

use Excel;

/**
 * Class ExcelService
 *
 * @package App\Service
 */
class ExcelService
{
    /**
     * 將上傳的excel資料轉成array回傳
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  int  $sheet
     * @return array
     */
    public function getTableArray($file, $sheet)
    {
        $array = Excel::load($file->path(), function($reader) {})->getSheet($sheet)->toArray();
        return $array;
    }

    /**
     * 格式化今日上傳生產資訊
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  int  $sheet
     * @return array
     */
    public function getTodayArray($file, $sheet)
    {
        $data = $this->getTableArray($file, $sheet);
        $keys = ['line', 'glassNumber', 'weight', 'speed', 'quantity', 'nextNumber', 'change', 'testNumber', 'date', 'created_at'];
        $array = [];
        $today = \Carbon\Carbon::today();
        $now = \Carbon\Carbon::now();
        foreach ($data as $list) {
            array_push($list, $today);
            array_push($list, $now);
            $combine = array_combine($keys, $list);
            array_push($array, $combine);
        }
        return $array;
    }

    /**
     * 格式化今日上傳生產資料庫
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  int  $sheet
     * @return array
     */
    public function getGlassArray($file, $sheet)
    {
        $data = $this->getTableArray($file, $sheet);
        $keys = ['line', 'glassNumber', 'speed', 'weight', 'quantity', 'yield', 'offline', 'remark', 'date', 'created_at'];
        $array = [];
        $today = \Carbon\Carbon::today();
        $now = \Carbon\Carbon::now();
        foreach ($data as $list) {
            array_push($list, $today);
            array_push($list, $now);
            $combine = array_combine($keys, $list);
            array_push($array, $combine);
        }
        return $array;
    }
}