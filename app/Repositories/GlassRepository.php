<?php
/**
 * Glass資料存取庫
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 17/01/13
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Repositories;

use App\Models\GlassProduce;
use Carbon\Carbon;

/**
 * Class GlassRepository
 *
 * @package App\Repositories
 */
class GlassRepository
{
    /** 注入 Glass Model */
    public $glass;

    /**
     * 建構式
     *
     * @param  GlassProduce $glass
     */
    public function __construct(GlassProduce $glass) 
    {
        $this->glass = $glass;
    }

    /**
     * 依搜尋瓶號，回傳瓶號生產資訊
     * 以下線時間排序
     *
     * @param string $search
     * @return mixed
     */
    public function getGlass($search)
    {
        return $this->glass
            ->where('glassNumber', iconv('utf8', 'big5', $search))
            ->orderBy('offline', 'desc');
    }

    /**
     * 回傳今日上傳瓶號生產資訊
     * 依產線排序
     *
     * @return mixed
     */
    public function getTodayImportData()
    {
        return $this->glass
            ->where('date', Carbon::today())
            ->orderByRaw("CASE WHEN line = '1-1' THEN 0 ELSE line END");
    }

    /**
     * 寫入今日上傳瓶號生產資訊
     *
     * @param array $data
     * @return array
     */
    public function insertGlassData($data)
    {
        try {
            $this->glass->getConnection()->beginTransaction();
            $this->glass->insert($data);
            $this->glass->getConnection()->commit();
            return ['success' => true];
        } catch (\Exception $e) {
            $this->glass->getConnection()->rollback();
            return ['success' => false, $e->getMessage()];
        }
    }
}