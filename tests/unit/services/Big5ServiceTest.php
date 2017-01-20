<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Service\Big5Service;

class Big5ServiceTest extends TestCase
{
    use Big5Service;

    public function setUp()
    {
        parent::setUp();
    }

    public function test_strToBig5()
    {
        $str = "測試字串";
        $big5Str = mb_convert_encoding($str, "big5", "utf-8");
        $result = $this->strToBig5($str);
        $this->assertEquals($result, $big5Str);
    }

    public function test_arrayToBig5()
    {
        $array = ['name' => '王大陸', 'message' => '大平台'];
        $result = $this->arrayToBig5($array);
        $array['name'] = mb_convert_encoding($array['name'], "big5", "utf-8");
        $array['message'] = mb_convert_encoding($array['message'], "big5", "utf-8");
        $this->assertEquals($result, $array);
    }
}
