<?php
namespace App\Service;

trait Big5Service
{
    /**
     * 將單一文字轉換成big5編碼
     *
     */
    public function strToBig5($str)
    {
        return mb_convert_encoding($str, "big5", "utf-8");
    }

    /**
     * 將array內容轉換成big5編碼
     *
     */
    public function arrayToBig5($array)
    {
        $newArray = [];
        list($key, $value) = array_divide($array);
        for ($i = 0; $i < count($value); $i++) {
            $newArray[$key[$i]] = mb_convert_encoding($value[$i], "big5", "utf-8");
        }
        return $newArray;
    }
}