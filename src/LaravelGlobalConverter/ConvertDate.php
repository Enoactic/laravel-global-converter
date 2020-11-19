<?php

namespace LaravelGlobalConverter;

class ConvertDate
{
    public $result;

    public static function anyToAny($date, $from = 'thai', $format = 'd M Y', $type = "BE")
    {
        $thaiShortMonthArray = array(
            "01" => "ม.ค.",
            "02" => "ก.พ.",
            "03" => "มี.ค.",
            "04" => "เม.ย.",
            "05" => "พ.ค.",
            "06" => "มิ.ย.",
            "07" => "ก.ค.",
            "08" => "ส.ค.",
            "09" => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค."
        );

        $day = "";
        $month = "";
        $year = "";

        if($from == 'thai' && $format == 'd M Y' && $type == 'BE'){
            $inputs = explode(" ", $date);

            $day = $inputs[0];
            foreach($thaiShortMonthArray as $index => $thaiShortMonth){
                if(html_entity_decode($thaiShortMonth) == html_entity_decode($inputs[1])) $month = $index;
            }
            $year = $inputs[2] - 543;

            $date = $year."-".$month."-".$day;
        }

        return $date;
    }

    public static function anyToBC($date, $format = 'w d F Y')
    {
        $thaiLongDayArray = array(
            "0" => "วันอาทิตย์",
            "1" => "วันจันทร์",
            "2" => "วันอังคาร",
            "3" => "วันพุธ",
            "4" => "วันพฤหัสบดี",
            "5" => "วันศุกร์",
            "6" => "วันเสาร์"
        );

        $thaiLongMonthArray = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );

        if($format == 'w d F Y'){
            $date = $thaiLongDayArray[date('w', strtotime($date))]." ".date('d', strtotime($date))." ".$thaiLongMonthArray[date('m', strtotime($date))]." ".(date('Y', strtotime($date)) + 543);
        }

        return $date;
    }
}
