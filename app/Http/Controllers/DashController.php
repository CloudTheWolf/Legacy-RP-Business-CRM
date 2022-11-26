<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\ArcadeSales;
use App\Models\BarSales;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashController extends BaseController
{

    function showDashboard()
    {
        $month = Carbon::now()->format('M');
        $year = $month == "Jan" ? "YEAR(CURRENT_TIMESTAMP) -1" : "YEAR(CURRENT_TIMESTAMP)";
        $count = DB::table('repair_log')->where('deleted','=','0')->count();
        $rev = DB::table('repair_log')->where('deleted','=','0')->select("cost")->sum('cost');
        $count2 = DB::table('repair_log')->where('deleted','=','0')->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) -1 and YEAR(`repair_log`.`timestamp`) = '.$year)->count();
        $rev2 = DB::table('repair_log')->where('deleted','=','0')->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) -1 and YEAR(`repair_log`.`timestamp`) = '.$year)->select("cost")->sum('cost');
        $count3 = DB::table('repair_log')->where('deleted','=','0')->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->count();
        $rev3 = DB::table('repair_log')->where('deleted','=','0')->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->select("cost")->sum('cost');
        $onDuty = DB::table('users')->select("onDuty")->where("onDuty","=","1")->count('id');
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
            $response = $client->request('GET', '/op-framework/users.json');
            $citizens = count(json_decode($response->getBody())->data);
        }
        catch(\Exception $e)
        {
            $citizens = 'API Error';
        }
        $pie = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        $pie2 = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) - 1 AND YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        $pie3 = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) AND YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');

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
        return view('index',)->with('count',$count)->with('rev',$rev)->with('count2',$count2)->with('rev2',$rev2)->with('count3',$count3)->with('rev3',$rev3)
            ->with('onDuty',$onDuty)->with('citizens',$citizens)->with('pie',$pie)->with('pie2',$pie2)->with('pie3',$pie3)
            ->with('jan',$tJan)->with('feb',$tFeb)->with('mar',$tMar)->with('apr',$tApr)->with('may',$tMay)->with('jun',$tJun)
            ->with('jul',$tJul)->with('aug',$tAug)->with('sep',$tSep)->with('oct',$tOct)->with('nov',$tNov)->with('dec',$tDec)
            ->with('ljan',$lJan)->with('lfeb',$lFeb)->with('lmar',$lMar)->with('lapr',$lApr)->with('lmay',$lMay)->with('ljun',$lJun)
            ->with('ljul',$lJul)->with('laug',$lAug)->with('lsep',$lSep)->with('loct',$lOct)->with('lnov',$lNov)->with('ldec',$lDec)->with('team',$team)->with("onDutyList",$onDutyList);
    }

    function showArcadeDashboard()
    {
        $onDuty = DB::table('users')->select("onDuty")->where("onDuty","=","1")->count('id');
        $rev = ArcadeSales::all()->sum('finalCost');
        $sales = ArcadeSales::all()->count('finalCost');
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
            $response = $client->request('GET', '/op-framework/users.json');
            $citizens = count(json_decode($response->getBody())->data);
        }
        catch(\Exception $e)
        {
            $citizens = 'API Error';
        }
        $team = DB::table('users')->select(["id","name","cell","onDuty"])->where('disabled','=','0')->get();
        $onDutyList = DB::table('users')->select(["name","workingAs"])->where("onDuty","=","1")->get();
        return view('arcade.index',compact('onDuty','citizens','team','onDutyList','sales','rev'));
    }

    function showBarDashboard()
    {
        $onDuty = DB::table('users')->select("onDuty")->where("onDuty","=","1")->count('id');
        $rev = BarSales::all()->sum('finalCost');
        $sales = BarSales::all()->count('finalCost');
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
            $response = $client->request('GET', '/op-framework/users.json');
            $citizens = count(json_decode($response->getBody())->data);
        }
        catch(\Exception $e)
        {
            $citizens = 'API Error';
        }
        $team = DB::table('users')->select(["id","name","cell","onDuty"])->where('disabled','=','0')->get();
        $onDutyList = DB::table('users')->select(["name","workingAs"])->where("onDuty","=","1")->get();
        return view('bars.index',compact('onDuty','citizens','team','onDutyList','sales','rev'));
    }

}
