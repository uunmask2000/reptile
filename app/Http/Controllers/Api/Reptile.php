<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

######################################
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpClient\HttpClient;

class Reptile extends Controller
{

    /**
     *
     *
     *
     *
     */
    public function index()
    {
        // echo '123456';
        ### http: //astro.click108.com.tw/
        # http://astro.click108.com.tw/daily_{}.php?iAstro={}  0 - 11
        for ($i = 0; $i < 12; $i++) {
            ### 原本
            // $url = 'http://astro.click108.com.tw/daily_' . $i . '.php?iAstro=' . $i;
            ### 根據時間
            $url = 'http://astro.click108.com.tw/daily_' . $i . '.php?iAstro=' . $i . '.&iType=0&iAcDay=' . date("Y-m-d");
            $this->single_reptile($url);
        }

    }

    /**
     * [single_reptile description]
     *
     * 爬取網址
     *
     *
     * @param   string  $url  [$url description] 網址
     *
     * @return  [type]        [return description]
     */
    public function single_reptile(string $url)
    {
        $client  = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);

        ## data
        $data = [];

        ## 時間
        parse_str(parse_url($url)['query'], $output);
        $data['today_date'] = $output['iAcDay'];
        ### 星座
        $data['constellation_name'] = str_replace('今日', '', str_replace('解析', '', $crawler->filter('.TODAY_CONTENT > h3')->text()));

        $sss = $crawler->filter('.TODAY_CONTENT > p')->each(function ($node, $i = 0, $res = []) {
            $i++;
            $res[] = $node->text();
            return $res;
        });

        $data['overall_fortune'] = $sss[0][0] . $sss[1][0];
        $data['love_fortune']    = $sss[2][0] . $sss[3][0];
        $data['career_fortune']  = $sss[4][0] . $sss[5][0];
        $data['luck_fortune']    = $sss[6][0] . $sss[7][0];

        $reptile = DB::table('reptile')
            ->where('today_date', $data['today_date'])
            ->where('constellation_name', $data['constellation_name'])
            ->get();
        $reptile = json_decode(json_encode($reptile), 1);
        ## 空白新增
        if (empty($reptile)) {
            // print_r($data);
            DB::table('reptile')->insert($data);
        } else {
            print_r($data);
        }

    }

}
