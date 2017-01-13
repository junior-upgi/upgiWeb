<?php
/**
 * excel相關處理方法
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 17/01/12
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Service;
//
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
}