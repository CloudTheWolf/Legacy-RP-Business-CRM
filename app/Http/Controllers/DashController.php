<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Selector;


class DashController extends Controller
{

    function showDashboard()
    {
        $count = DB::table('repair_log')->where('deleted','=','0')->count();
        $rev = DB::table('repair_log')->where('deleted','=','0')->select("cost")->sum('cost');
        $onDuty = DB::table('users')->select("onDuty")->where("onDuty","=","1")->count('id');

        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"), 'timeout' => 60]);
            $response = $client->request('GET', '/op-framework/connections.json');
            $citizens = json_decode($response->getBody())->data->joined->total;
        }
        catch(\Exception $e)
        {
            $citizens = '0 (Server Offline)';
        }
        $pie = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');

        $tJan = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 1 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tFeb = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 2 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tMar = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 3 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tApr = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 4 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tMay = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 5 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tJun = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 6 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tJul = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 7 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tAug = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 8 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tSep = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 9 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tOct = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 10 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tNov = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 11 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $tDec = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 12 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP)');
        $lJan = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 1 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lFeb = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 2 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lMar = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 3 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lApr = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 4 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lMay = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 5 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lJun = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 6 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lJul = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 7 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lAug = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 8 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lSep = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 9 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lOct = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 10 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lNov = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 11 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
        $lDec = DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND timestamp > now() - INTERVAL 12 month and MONTH(timestamp) = 12 and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');

        $team = DB::table('users')->select(["id","name","cell","onDuty"])->where('disabled','=','0')->get();
        $onDutyList = DB::table('users')->select(["name","workingAs"])->where("onDuty","=","1")->get();
        return view('index',)->with('count',$count)->with('rev',$rev)->with('onDuty',$onDuty)->with('citizens',$citizens)->with('pie',$pie)
            ->with('jan',$tJan)->with('feb',$tFeb)->with('mar',$tMar)->with('apr',$tApr)->with('may',$tMay)->with('jun',$tJun)
            ->with('jul',$tJul)->with('aug',$tAug)->with('sep',$tSep)->with('oct',$tOct)->with('nov',$tNov)->with('dec',$tDec)
            ->with('ljan',$lJan)->with('lfeb',$lFeb)->with('lmar',$lMar)->with('lapr',$lApr)->with('lmay',$lMay)->with('ljun',$lJun)
            ->with('ljul',$lJul)->with('laug',$lAug)->with('lsep',$lSep)->with('loct',$lOct)->with('lnov',$lNov)->with('ldec',$lDec)->with('team',$team)->with("onDutyList",$onDutyList);
    }
}
