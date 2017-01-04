<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/26/2016 AD
 * Time: 14:14
 */

//$str = str_split("??????????");
//
//$Consonant = array("?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?");
//
//$Diphthongs= array("? ","?","?");
//
//$Vowel= array("?","?","?","?","?","?","?","?","??","?","??","?","??","?","???","?","???","??","????","???","????","???","???","??","?","??","?","??","?","?","?","??");
//
//$Itone_marks=array("?","?","?","?","?","?","?");
//
//foreach($str as $a){
//
//    if(in_array($a,$Consonant)){
//          echo '??????';
//}elseif(in_array($a,$Diphthongs)){
//        //..........?????????
//        echo '??????';
//    }
//}

	$seta = array("A","B","C","1","2","3");
	$setb = array("A","C","D","1","2","4");

	$result_of_new = compare_new_value($seta,$setb);
	$result_of_intersect = compare_intersect_value($seta,$setb);
	$result_of_lost = compare_lost_value($seta,$setb);

	echo '<pre>';
	print_r($result_of_new);
	print_r($result_of_intersect);
	print_r($result_of_lost);
	echo '</pre>';

	function compare_new_value($old,$new){
        $temp = array();
        $hit = false;
        foreach ($new as $ni => $nvalue) {
            $hit = false;
            foreach ($old as $oi => $ovalue) {
                if( $nvalue == $ovalue ){
                    $hit = true;
                }
            }
            if($hit == false){
                array_push($temp, $nvalue);
            }
        }
        return $temp;
    }

	function compare_intersect_value($old,$new){
        $temp = array();
        $hit = false;
        foreach ($new as $ni => $nvalue) {
            $hit = false;
            foreach ($old as $oi => $ovalue) {
                if( $nvalue == $ovalue ){
                    $hit = true;
                }
            }
            if($hit == true){
                array_push($temp, $nvalue);
            }
        }
        return $temp;
    }

	function compare_lost_value($old,$new){
        $temp = array();
        $hit = false;
        foreach ($old as $oi => $ovalue) {
            $hit = false;
            foreach ($new as $ni => $nvalue) {
                if( $nvalue == $ovalue ){
                    $hit = true;
                }
            }
            if($hit == false){
                array_push($temp, $ovalue);
            }
        }
        return $temp;
    }

$datas=array("one", "two", "one", "three", "four", "two"); //array ที่ต้องการตรวจสอบ

$check= array(); //array สำหรับการตรวจสอบ
for ($i=0; $i<count($datas); $i++) {
    $check[$datas[$i]]++; //mark array
    if ($check[$datas[$i]]>1) echo "รายการ $datas[$i] ซ้ำกัน<br />";
}


$a = array("A","B","C","D","E");
$b = array("A1","B1","C1","D1","E1");
$c = array("A11","B11","C11","D11","E11");
foreach($a as $key => $val){
    echo "$val,$b[$key],$c[$key]<br />\n";
}


$a[0]=1;
$a[1]=1;
$a[2]=3;
$a[3]=2;
$a[4]=3;
$a[5]=3;
$a[6]=3;
$a[7]=7;
$a[8]=7;
$a[9]=1;
$a[10]=1;

$b= array_unique ($a);
foreach($b as $value){
    echo $value;
    echo "<br>";
}
print_r($b);

$fruit_array = array('ส้ม', 'กล้วย', 'มะละกอ','มังคุด', 'มะพร้าว', 'องุ่น','มะพร้าว','กล้วย');

// ใช้ Function array_unique() ในการตัดค่าที่ซ้ำออกไป
$fruit_array = array_unique($fruit_array);

// ใช้คำสั่ง print_r() แสดงค่าจำนวน Array ที่เหลือออกมา
print_r($fruit_array);
?>

