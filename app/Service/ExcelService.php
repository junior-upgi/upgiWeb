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

use Carbon\Carbon;
use Excel;

use App\Service\Big5Service;

/**
 * Class ExcelService
 *
 * @package App\Service
 */
class ExcelService
{
    use Big5Service;
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
        $keys = ['line', 'glassNumber', 'weight', 'speed', 'quantity', 
            'nextNumber', 'change', 'testNumber', 'date', 'created_at'];
        return $this->checkTodayArray($data, $keys);
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
        $keys = ['line', 'glassNumber', 'speed', 'weight', 'quantity', 
            'yield', 'offline', 'remark', 'date', 'created_at'];
        return $this->checkArray($data, $keys);
    }

    //
    public function checkArray($data, $keys)
    {
        $count = count($keys) - 2;
        if ($data == null || count($data) < 2 || count($data[0]) != $count) {
            return null;
        }
        return $this->setArray($data, $keys);
    }

    public function checkTodayArray($data, $keys)
    {
        $count = count($keys) - 2;
        if ($data == null || count($data) < 2 || count($data[0]) != $count) {
            return null;
        }
        return $this->setTodayArray($data, $keys);
    }

    public function setTodayArray($data, $keys)
    {
        $array = [];
        $today = Carbon::today();
        $now = Carbon::now();
        $data = array_slice($data,1);
        foreach ($data as $list) {
            array_push($list, $today);
            array_push($list, $now);
            $list[4] = $this->setTodayQuantity($list[4]);
            $combine = array_combine($keys, $this->arrayToBig5($list));
            array_push($array, $combine);
        }
        return $array;
    }

    private function setTodayQuantity($value)
    {
        $val = number_format($value, 1);
        if (strchr($val, '.') == '.0') {
            return substr($val, 0, strlen($val) -2);
        }
        return $val;
    } 
    
    //
    public function setArray($data, $keys)
    {
        $array = [];
        $today = Carbon::today();
        $now = Carbon::now();
        $data = array_slice($data,1);
        foreach ($data as $list) {
            array_push($list, $today);
            array_push($list, $now);
            $list[4] = $this->setTodayQuantity($list[4]);
            $list[5] = $this->setTodayQuantity($list[5]);
            $list[6] = $this->setTodayQuantity($list[6]);
            $combine = array_combine($keys, $this->arrayToBig5($list));
            array_push($array, $combine);
        }
        return $array;
    }
}