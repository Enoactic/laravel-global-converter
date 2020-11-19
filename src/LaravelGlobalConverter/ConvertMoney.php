<?php

namespace LaravelGlobalConverter;

class ConvertMoney
{
    public $result;

    public function floatToBaht($number)
    {
        if(!preg_match( '/^([0-9]+)(\.[0-9]{0,4}){0,1}$/' , $number=str_replace(',', '', $number), $m ))
            return 'This is not currency format';
        $m[2]=count($m)==3? intval(('0'.$m[2])*100 + 0.5) : 0;
        $st = $this->convert( $m[2]);
        return $this->convert( $m[1]) . 'บาท' . $st . ($st>''? 'สตางค์' : '');
    }

    private function convert($num)
    {
        $thNumbers = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'),'สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
        $thDigits = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
        $length = strlen($num);
        $t='';
        for($i=$length; $i>0;$i--){
            $x=$i-1;
            $n = substr($num, $length-$i,1);
            $digit=$x % 6;
            if($n!=0){
                if( $n==1 ){ $t .= $digit==1? '' : $thNumbers[1][$digit==0? ($t? 1 : 0) : 0]; }
                elseif( $n==2 ){  $t .= $thNumbers[2][$digit==1? 1 : 0]; }
                else{ $t.= $thNumbers[$n]; }
                $t.= $thDigits[($digit==0 && $x>0 ? 6 : $digit )];
            }else{
                $t .= $thDigits[ $digit==0 && $x>0 ? 6 : 0 ];
            }
        }
        return $t;
    }
}
