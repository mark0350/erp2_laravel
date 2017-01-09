<?php

namespace App\Http\Controllers;

use App\Electricity_consumption;
use App\Http\Wechat;
use App\Paper_machine_speed;
use App\Paper_machine_status;
use App\Paper_moisture;
use App\Paper_production;
use App\Paper_substance;
use App\Paper_thick;
use App\Pulping_machine_status1;
use App\Pulping_machine_status2;
use App\Pulping_machine_status3;
use App\Pulping_machine_status4;
use App\Pulping_machine_status5;
use App\Reeling_machine_status;
use App\Sizing_machine_status;
use App\Sizing_machine_width;
use App\Steam_consumption;
use App\Water_consumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WechatController extends Controller
{
    protected $wechatObj;

    public function __construct(Wechat $wechatObj)
    {
        $this->wechatObj = $wechatObj;

    }

    public function machine_status()
    {
        date_default_timezone_set('PRC');

        $string = "纸机运行状况\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Paper_machine_status::DataBetween(strtotime('today'), time())->first();

        if (is_null($data)) {
            $string .= "纸机：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "纸机：" . "开机" . "\n";
            } else {
                $string .= "纸机：" . "停机" . "\n";
            }
        }

        $data = Paper_machine_speed::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "车速：" . "未知" . "\n";
        } else {
            $string .= "车速：" . round($data, 1) . " 米/分\n";
        }

        $string .= "---------------------\n";

        $data = Reeling_machine_status::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "供浆泵：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "供浆泵：" . "运行" . "\n";
            } else {
                $string .= "供浆泵：" . "停止" . "\n";
            }
        }

        $string .= "---------------------\n";

        $data = Pulping_machine_status1::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "磨浆机M1113A：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "磨浆机M1113A：" . "运行" . "\n";
            } else {
                $string .= "磨浆机M1113A：" . "停止" . "\n";
            }
        }

        $data = Pulping_machine_status2::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "磨浆机M1114A：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "磨浆机M1114A：" . "运行" . "\n";
            } else {
                $string .= "磨浆机M1114A：" . "停止" . "\n";
            }
        }

        $data = Pulping_machine_status3::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "磨浆机M1115A：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "磨浆机M1115A：" . "运行" . "\n";
            } else {
                $string .= "磨浆机M1115A：" . "停止" . "\n";
            }
        }

        $data = Pulping_machine_status4::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "磨浆机M1122A：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "磨浆机M1122A：" . "运行" . "\n";
            } else {
                $string .= "磨浆机M1122A：" . "停止" . "\n";
            }
        }


        $data = Pulping_machine_status5::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "磨浆机M1123A：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "磨浆机M1123A：" . "运行" . "\n";
            } else {
                $string .= "磨浆机M1123A：" . "停止" . "\n";
            }
        }

        $string .= "---------------------\n";

        $data = Sizing_machine_status::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "卷取：" . "未知" . "\n";
        } else {
            if ($data == 1) {
                $string .= "卷取：" . "断纸" . "\n";
            } else {
                $string .= "卷取：" . "有纸" . "\n";
            }
        }

        $string .= "---------------------\n";

        $data = Sizing_machine_width::DataBetween(strtotime('today'), time())->first();
        if (is_null($data)) {
            $string .= "抄宽：" . "未知" . "\n";
        } else {
            $string .= "抄宽：" . round($data, 1) . " 毫米\n";
        }

        $paper_machine_speed = Paper_machine_speed::DataBetween(strtotime('today'), time())->first();
        $sizing_machine_width = Sizing_machine_width::DataBetween(strtotime('today'), time())->first();
        $paper_substance = Paper_substance::DataBetween(strtotime('today'), time())->first();

        if ((!is_null($paper_machine_speed)) && (!is_null($sizing_machine_width)) && (!is_null($paper_substance))) {
            $data = round($paper_machine_speed * ($sizing_machine_width/1000) * ($paper_substance/1000)*60/1000,3);
            $string .= "瞬时产量：" . round($data, 2) . " 吨/时\n";
        } else {
            $string .= "瞬时产量：" . "未知" . "\n";
        }

        return $string;
    }

    public function production_status()
    {
        date_default_timezone_set('PRC');


        $string = "纸机产品状况\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Paper_substance::DataBetween(strtotime('today'), time())->first();
        if (empty($data)) {
            $string .= "定量：" . "未知" . "\n";
        } else {
            dd('null is not empty');
            $string .= "定量：" . round($data->value, 1) . " 克\n";
        }

        $data = Paper_moisture::DataBetween(strtotime('today'), time())->first();

        if (empty($data)) {
            $string .= "水分：" . "未知" . "\n";
        } else {
            $string .= "水分：" . round($data->value, 1) . " %\n";
        }

        $data = Paper_thick::DataBetween(strtotime('today'), time())->first();
        if (empty($data)) {
            $string .= "厚度：" . "未知" . "\n";
        } else {
            $string .= "厚度：" . round($data->value, 1) . " 微米\n";
        }

        return $string;
    }

    public function breaking_status()
    {
//        date_default_timezone_set('PRC');

        $string = "纸机断纸状况\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Sizing_machine_status::lengthOfStatus(strtotime('today'), time(), 1);
        $temp = $data;
        if (is_bool($data)) {
            $string .= "连续时间：" . "未知" . "\n";
        } else {
            $string .= "连续时间：" . round($data / 3600, 2) . " 小时\n";
        }

        $data = Sizing_machine_status::DataBetween(strtotime('today'), time())->get();
        if ($data->isEmpty()) {
            $string .= "断纸次数：" . "未知" . "\n";
        } else {
            $string .= "断纸次数：" . $data->where('value', 0)->count() . " 次\n";
        }

        $data = Sizing_machine_status::lengthOfStatus(strtotime('today'), time(), 0);
        if (is_bool($data)) {
            $string .= "断纸时间：" . "未知" . "\n";
        } else {
            $string .= "断纸时间：" . round($data / 3600, 2) . " 小时\n";
        }

        if (is_bool($temp)) {
            $string .= "运行率：" . "未知" . "\n";
        } else {
            $string .= "运行率：" . round(($temp / (time() - strtotime('today'))), 4) * 100 . " %\n";
        }

        return $string;
    }

    public function yesterday_statistics()
    {
        date_default_timezone_set('PRC');


        $string = "纸机状态昨日统计\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Sizing_machine_status::lengthOfStatus(strtotime('yesterday'), strtotime('today'), 0);
        if (is_bool($data)) {
            $string .= "断纸时间：" . "未知" . "\n";
        } else {
            $string .= "断纸时间：" . round($data / 3600, 2) . " 小时\n";
        }

        $data = Sizing_machine_status::lengthOfStatus(strtotime('yesterday'), strtotime('today'), 1);
        if (is_bool($data)) {
            $string .= "运行率：" . "未知" . "\n";
        } else {
            $string .= "运行率：" . round(($data / (strtotime('today') - strtotime('yesterday'))), 4) * 100 . " %\n";
        }
        return $string;
    }

    public function monthly_statistics()
    {
        date_default_timezone_set('PRC');


        $string = "纸机状态月统计\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Sizing_machine_status::lengthOfStatus(strtotime('first day of this month',strtotime('today')), time(),0);
        if (is_bool($data)) {
            $string .= "断纸时间：" . "未知" . "\n";
        } else {
            $string .= "断纸时间：" . round($data / 3600, 2) . " 小时\n";
        }
        $data = Sizing_machine_status::lengthOfStatus(strtotime('first day of this month',strtotime('today')), time(),1);
        if (is_bool($data)) {
            $string .= "运行率：" . "未知" . "\n";
        } else {
            $string .= "运行率：" . round(($data / (time() - strtotime('first day of this month',strtotime('today')))), 4) * 100 . " %\n";
        }
        return $string;
    }

    public function yearly_statistics()
    {
        date_default_timezone_set('PRC');


        $string = "纸机状态年统计\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data =  Sizing_machine_status::lengthOfStatus(strtotime('first day of January ' . date('Y')), time(),0);
        if (is_bool($data)) {
            $string .= "断纸时间：" . "未知" . "\n";
        } else {
            $string .= "断纸时间：" . round($data / 3600, 2) . " 小时\n";
        }
        $data = Sizing_machine_status::lengthOfStatus(strtotime('first day of January ' . date('Y')), time(),1);
        if (is_bool($data)) {
            $string .= "运行率：" . "未知" . "\n";
        } else {
            $string .= "运行率：" . round(($data / (time() - strtotime('first day of January ' . date('Y')))), 4) * 100 . " %\n";
        }
        return $string;
    }

    public function production($start_time, $end_time)
    {
        date_default_timezone_set('PRC');
        $productions = Paper_production::productionBetween($start_time
           , $end_time );
        $string = date("Y-m-d H:i:s")."\n"."---------------\n";
        if($productions->isEmpty())
            return $string;

        $qualified = 0;
        $total = 0;
        $grouped = $productions->groupBy(function($production){
           return $production->Type_Print;
        });
        $grouped->toArray();
//        dd($grouped);
        foreach($grouped as $key=>$g) {
            $string .= $key."\n";
            foreach($g as $p) {
                $string .= $p->Grade_Print."等品: ".(($p->Weight)/1000)." 吨\n";
                $total += $p->Weight;
                if($p->Grade_Print == 'A')
                    $qualified += $p->Weight;
            }
            $string .= "---------------\n";
        }
        $string .= "总计\n"."A等品: ".($qualified/1000)."吨\n" ;
        $string .= "B等品: ".(($total - $qualified)/1000)."吨";
        return $string;
    }

    public function daily_production()
    {
        date_default_timezone_set('PRC');
//        dd(strtotime('today'));
        $string = "\n今日产量\n".$this->production(date("Y-m-d H:i:s" ,strtotime('today') )
                , date("Y-m-d H:i:s"));
        return $string;
    }

    public function yesterday_production()
    {
        date_default_timezone_set('PRC');
        $string = "\n昨日产量\n".$this->production(date("Y-m-d H:i:s" ,strtotime('today') )
                , date("Y-m-d H:i:s" ,strtotime('yesterday') ));
        return $string;
    }


    public function monthly_production()
    {
        date_default_timezone_set('PRC');
        $string = "\n月产量\n".$this->production(date("Y-m-d H:i:s" ,strtotime('first day of this month',strtotime('today')) )
                , date("Y-m-d H:i:s"));
        return $string;
    }

    public function yearly_production()
    {
        date_default_timezone_set('PRC');
        $string = "\n年产量\n".$this->production(date("Y-m-d H:i:s" ,strtotime('first day of January',strtotime('today')) )
                , date("Y-m-d H:i:s"));
        return $string;
    }


    public function daily_consumption()
    {
        date_default_timezone_set('PRC');
        return '日消耗'.$this->consumption(strtotime('today'), time());
    }

    public function yesterday_consumption()
    {
        date_default_timezone_set('PRC');
        return '昨日消耗'.$this->consumption(strtotime('yesterday'), strtotime('today'));
    }

    public function monthly_consumption()
    {
        date_default_timezone_set('PRC');
//       DD(date('Y-m-d H：i:s',1483920000));
        return '月消耗'.$this->consumption(strtotime('first day of this month',strtotime('today')), time());

    }

    public function yearly_consumption()
    {
        date_default_timezone_set('PRC');
        return '年消耗'.$this->consumption(strtotime('first day of January ' . date('Y')), time());
    }

    public function consumption($start_time, $end_time)
    {
        date_default_timezone_set('PRC');
        $string = "\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $consumption = Water_consumption::getConsumption($start_time,$end_time);
        if(is_bool($consumption))
            $string .= "清水消耗：" . "未知" . "\n";
        else {
            $string .= "清水消耗：" . round($consumption, 1) . " 吨\n";
        }

        $string .= "---------------------\n";
        $consumption = Electricity_consumption::getConsumption($start_time,$end_time);
        if(is_bool($consumption))
            $string .= "电力消耗：" . "未知" . "\n";
        else {
            $string .= "电力消耗：" . round($consumption, 1) . " 度\n";
        }

        $string .= "---------------------\n";
        $consumption = Steam_consumption::getConsumption($start_time,$end_time);
        if(is_bool($consumption))
            $string .= "蒸汽消耗：" . "未知" . "\n";
        else {
            $string .= "蒸汽消耗：" . round($consumption, 1) . " 吨\n";
        }

        $string .= "---------------------\n";
        $string .= "污水排放：" . "未知" . "\n";
        
        return $string;

    }
    public function response()
    {
        date_default_timezone_set('PRC');
        $this->wechatObj->valid();

        switch ($this->wechatObj->getRev()->getRevEvent()['key']) {
            case "machine_status":
                $this->wechatObj->text($this->machine_status())->reply();
                break;
            case "production_status":
                $this->wechatObj->text($this->production_status())->reply();
                break;
            case "breaking_status":
                $this->wechatObj->text($this->breaking_status())->reply();
                break;
            case "yesterday_statistics":
                $this->wechatObj->text($this->yesterday_statistics())->reply();
                break;
            case "monthly_statistics":
                $this->wechatObj->text($this->monthly_statistics())->reply();
                break;
            case "yearly_statistics":
                $this->wechatObj->text($this->yearly_statistics())->reply();
                break;
            case "shift_production":
                $this->wechatObj->text($this->shift_production())->reply();
                break;
            case "yearly_production":
                $this->wechatObj->text($this->yearly_production())->reply();
                break;
            case "monthly_production":
                $this->wechatObj->text($this->monthly_production())->reply();
                break;
            case "yesterday_production":
                $this->wechatObj->text($this->yesterday_production())->reply();
                break;
            case "daily_production":
                $this->wechatObj->text($this->daily_production())->reply();
                break;
            case "shift_consumption":
                $this->wechatObj->text($this->shift_consumption())->reply();
                break;
            case "daily_consumption":
                $this->wechatObj->text($this->daily_consumption())->reply();
                break;
            case "yesterday_consumption":
                $this->wechatObj->text($this->yesterday_consumption())->reply();
                break;
            case "monthly_consumption":
                $this->wechatObj->text($this->monthly_consumption())->reply();
                break;
            case "yearly_consumption":
                $this->wechatObj->text($this->yearly_consumption())->reply();
                break;
            default:
                break;
        }

        switch ($this->wechatObj->getRev()->getRevContent()) {
            case "1":
            case "1月":
            case "一月":
                if (strtotime('first day of January ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y');
                }
                $start = strtotime('first day of January ' . $year);
                $end = strtotime('last day of January ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "2":
            case "2月":
            case "二月":
                if (strtotime('first day of February ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y');
                }
                $start = strtotime('first day of February ' . $year);
                $end = strtotime('last day of February ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "3":
            case "3月":
            case "三月":
                if (strtotime('first day of March ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of March ' . $year);
                $end = strtotime('last day of March ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "4":
            case "4月":
            case "四月":
                if (strtotime('first day of April ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of April ' . $year);
                $end = strtotime('last day of April ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "5":
            case "5月":
            case "五月":
                if (strtotime('first day of May ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of May ' . $year);
                $end = strtotime('last day of May ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "6":
            case "6月":
            case "六月":
                if (strtotime('first day of June ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of June ' . $year);
                $end = strtotime('last day of June ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "7":
            case "7月":
            case "七月":
                if (strtotime('first day of July ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of July ' . $year);
                $end = strtotime('last day of July ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "8":
            case "8月":
            case "八月":
                if (strtotime('first day of August ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of August ' . $year);
                $end = strtotime('last day of August ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "9":
            case "9月":
            case "九月":
                if (strtotime('first day of September ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of September ' . $year);
                $end = strtotime('last day of September ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "10":
            case "10月":
            case "十月":
                if (strtotime('first day of October ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of October ' . $year);
                $end = strtotime('last day of October ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "11":
            case "11月":
            case "十一月":
                if (strtotime('first day of November ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of November ' . $year);
                $end = strtotime('last day of November ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            case "12":
            case "12月":
            case "十二月":
                if (strtotime('first day of December ' . date('Y')) < strtotime('today')) {
                    $year = date('Y');
                } else {
                    $year = date('Y') - 1;
                }
                $start = strtotime('first day of December ' . $year);
                $end = strtotime('last day of December ' . $year);
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            default:
                break;
        }
    }

}
