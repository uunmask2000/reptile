<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reptile_model extends Model
{
    /**
     * 與模型關聯的資料表。
     *
     * @var string
     */
    protected $table = 'reptile';

    /**
     * 指定是否模型應該被戳記時間。
     *
     * @var bool
     */
    public $timestamps = true;

    public $primaryKey = 'id';

    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'today_date',
        'constellation_name',
        'overall_fortune',
        'love_fortune',
        'career_fortune',
        'luck_fortune',
    ];

    /**
     * [insert_Retire_Data description]
     *
     *
     *
     * @param   [type]  $data  [$data description]
     *
     * @return  [type]         [return description]
     */
    public function insert_Retire_Data($data)
    {
        ## SQL raw 寫法
        // $reptile = DB::table('reptile')
        //     ->where('today_date', $data['today_date'])
        //     ->where('constellation_name', $data['constellation_name'])
        //     ->get();
        // $reptile = json_decode(json_encode($reptile), 1);
        // ## 空白新增
        // if (empty($reptile)) {
        //     // print_r($data);
        //     DB::table('reptile')->insert($data);
        // } else {
        //     print_r($data);
        // }

    }

}
