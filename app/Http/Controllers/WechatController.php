<?php

namespace App\Http\Controllers;

use App\Http\Wechat;
use App\Paper_moisture;
use App\Paper_substance;
use App\Paper_thick;
use App\Sizing_machine_status;
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


        $string = "纸机产品状况\n";
        $string .= date("Y-m-d  H:i:s") . "\n";
        $string .= "---------------------\n";
        $data = Paper_substance::DataBetween(strtotime('today'), time())->first();
//        dd(DB::getQueryLog());
        if (is_bool($data)|| empty($data)) {
            $string .= "定量：" . "未知" . "\n";
        } else {
            $string .= "定量：" . round($data, 1) . " 克\n";
        }



        return $string;
    }

    public function production_status()
    {
//        date_default_timezone_set('PRC');


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
        $data = Sizing_machine_status::lengthOfStatus(strtotime('today'), time(),0);
        $temp = $data;
        if (is_bool($data)||$data->isEmpty()) {
            $string .= "连续时间：" . "未知" . "\n";
        } else {
            $string .= "连续时间：" . round($data/3600, 2) . " 小时\n";
        }

        $data = Sizing_machine_status::DataBetween(strtotime('today'), time())->get();
        if ($data->isEmpty()) {
            $string .= "断纸次数：" . "未知" . "\n";
        } else {
            $string .= "断纸次数：" . $data->where('value',0)->count() . " 次\n";
        }

        $data = Sizing_machine_status::lengthOfStatus(strtotime('today'), time(),1);
        if (is_bool($data)||$data->isEmpty()) {
            $string .= "断纸时间：" . "未知" . "\n";
        } else {
            $string .= "断纸时间：" . round($data/60, 2) . " 小时\n";
        }


        if (is_bool($temp)||$data->isEmpty()) {
            $string .= "运行率：" . "未知" . "\n";
        } else {
            $string .= "运行率：" . round(($temp / (time() - strtotime('today'))),4) * 100 . " %\n";
        }

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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
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
                $this->wechatObj->text(date('Y 年 m 月产量', $start) . $this->production_message(date('Y-m-d  H:i:s', $start), date('Y-m-d  H:i:s', $end)))->reply();
                break;
            default:
                break;
        }
    }

}
