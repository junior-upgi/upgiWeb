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
     * @param $file
     * @param  int $sheet
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
     * @param $file
     * @param  int $sheet
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
     * @param $file
     * @param  int $sheet
     * @return array
     */
    public function getGlassArray($file, $sheet)
    {
        $data = $this->getTableArray($file, $sheet);
        $keys = ['line', 'glassNumber', 'speed', 'weight', 'quantity', 
            'yield', 'offline', 'remark', 'date', 'created_at'];
        return $this->checkArray($data, $keys);
    }

    /**
     * 檢查瓶號資料庫欄位
     *
     * @param $data
     * @param $keys
     * @return array|null
     */
    public function checkArray($data, $keys)
    {
        $count = count($keys) - 2;
        if ($data == null || count($data) < 2 || count($data[0]) != $count) {
            return null;
        }
        return $this->setArray($data, $keys);
    }

    /**
     * 檢查今日上傳生產資訊欄位
     *
     * @param $data
     * @param $keys
     * @return array|null
     */
    public function checkTodayArray($data, $keys)
    {
        $count = count($keys) - 2;
        if ($data == null || count($data) < 2 || count($data[0]) != $count) {
            return null;
        }
        return $this->setTodayArray($data, $keys);
    }

    /**
     * 設定今日上傳生產資訊資料
     *
     * @param $data
     * @param $keys
     * @return array
     */
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

    /**
     * 修正小數精準度
     *
     * @param $value
     * @return string
     */
    private function setTodayQuantity($value)
    {
        if (!is_numeric($value)) {
            return $value;
        }
        $val = number_format($value, 1);
        if (strchr($val, '.') == '.0') {
            return substr($val, 0, strlen($val) -2);
        }
        return $val;
    }

    private function setTodayQuantityfloat2($value)
    {
        if (!is_numeric($value)) {
            return $value;
        }
        $val = number_format($value, 2);
        if (strchr($val, '.') == '.00') {
            return substr($val, 0, strlen($val) -3);
        }
        return $val;
    }

    /**
     * 格式化寫入資料陣列
     *
     * @param $data
     * @param $keys
     * @return array
     */
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
            $list[5] = $this->setTodayQuantityfloat2($list[5]);
            $combine = array_combine($keys, $this->arrayToBig5($list));
            array_push($array, $combine);
        }
        return $array;
    }
}