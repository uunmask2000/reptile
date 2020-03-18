<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users_model extends Model
{
    /**
     * 與模型關聯的資料表。
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 指定是否模型應該被戳記時間。
     *
     * @var bool
     */
    public $timestamps = true;
    public $primaryKey = 'user_id';

    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'user_pwd',
        'user_acc',
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
    public function get_user_Data($request)
    {
        $request->acc      = $request->acc;
        $request->password = md5($request->password);

        $reptile = DB::table($this->table)
            ->where('user_acc', $request->acc)
            ->where('user_pwd', $request->password)
            ->get();
        return $reptile;
    }

}
