<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

######################################
use App\Model\Reptile_model;

#### USE composer require fabpot/goutte
#### https://github.com/FriendsOfPHP/Goutte
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

        ### http: //astro.click108.com.tw/
        # http://astro.click108.com.tw/daily_{}.php?iAstro={}  0 - 11
        for ($i = 0; $i < 12; $i++) {
            ### 原本
            // $url = 'http://astro.click108.com.tw/daily_' . $i . '.php?iAstro=' . $i;
            ### 根據時間
            $url = 'http://astro.click108.com.tw/daily_' . $i . '.php?iAstro=' . $i . '.&iType=0&iAcDay=' . date("Y-m-d");

            ### 丟給下一方法
            $res = $this->single_reptile($url);
            dump($res);
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
    private function single_reptile(string $url)
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

        // 驗證請求...
        $respone   = Reptile_model::firstOrCreate($data);
        $ArrayData = json_decode(json_encode($respone), 1);

        return $ArrayData;

    }

}
