<?php
namespace common\components\web;


use yii\helpers\Url;

class Ics
{
    private $events = [];

    function output()
    {
        return "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nMETHOD:PUBLISH\r\nPRODID:-//Paradigm//Europe/Amsterdam//EN\r\n" . $this->eventsToString() . "END:VCALENDAR\r\n";
    }

    public function addEvent($id,$start, $end = null, $description = 'none',$sumary = 'none'){
            $datetime = new \Datetime((is_null($end) ? $start : $end));
            $datetime->add(new \DateInterval('PT30M'));

        $this->events[] = "BEGIN:VEVENT\r\nDTSTART:" . date("Ymd\THis\Z", strtotime($start)) . "\r\nDTEND:" . $datetime->format('Ymd\THis\Z') . "\r\nLOCATION:Groningen\r\nTRANSP:OPAQUE\r\nSEQUENCE:0\r\nUID:".intval($id)."\r\nDTSTAMP:" . date("Ymd\THis\Z") . "\r\nDESCRIPTION:" . $description . "\r\nSUMMARY:" . $sumary . "\r\nPRIORITY:1\r\nCLASS:PUBLIC\r\nURL:" . Url::base(true).'/notification/view?id='. $id . "\r\nEND:VEVENT\r\n";
    }

    private function eventsToString(){
        $output = '';
        for($i=0;count($this->events) > $i;$i++){
            $output .= $this->events[$i];
        }
        return $output;
    }

}

?>