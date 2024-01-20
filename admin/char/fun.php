<?php
function HipoTreng($array){
    $array = array_values($array);
    echo 'Проверка гипотезы по критерию основанному на медиане<br>';
    //var_dump($array);
    $sortarray = $array;
    sort($sortarray);
    $length = count($array);
    if ($length%2==0) $median = ($sortarray[(int)$length/2-1]+$sortarray[(int)$length/2])/2;
    else if($length%2==1) $median = $sortarray[(int)($length/2)];
    echo 'Медиана: '.$median.'<br>ẟ:';
    $tr1='<tr ><td>Период</td>'; $tr2='<tr ;><td>Значение</td>'; $tr3='<tr ;><td>ẟ:</td>';
    $deltat = array();
    for ($i=0;$i<$length;$i++){
        if ($array[$i]>$median){
            array_push($deltat,1);
            echo '+';
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.$array[$i].'</td>';
            $tr3.='<td>+</td>';
        } else if ($array[$i]<$median) {
            array_push($deltat,0);
            echo '-';
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.$array[$i].'</td>';
            $tr3.='<td>-</td>';
        } else {
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.$array[$i].'</td>';
            $tr3.='<td></td>';
        }
    }
    $tr1.='</tr>'; $tr2.='</tr>'; $tr3.='</tr>';
    echo '<br style="color:white";><table style="color:white"; border="1" class="tab1">'.$tr1.$tr2.$tr3.'</table>';
    //var_dump($array);
    //echo var_dump($deltat);
    $vn=1;
    $tmax=-1;
    $tlength=1;
    for ($i=0;$i<count($deltat);$i++){
        if ($deltat[$i]==isset($deltat[$i+1])){
            $tlength++;
        } else {
            if ($i!=count($deltat)-1) $vn++;
            if ($tlength>$tmax){
                $tmax=$tlength;
                $tlength=1;
            }
        }
    }
    if ($tmax==-1) $tmax=count($deltat);
    echo '<br>Серий: '.$vn.', наибольшая длина серии: '.$tmax.'<br>';
    $numsr1 = (int)(($length+1-1.96*sqrt($length-1))/2);
    $numsr2 = (int)(1.431*log($length+1));
    echo  'Сравниваемое с числом серий: '.$numsr1.', сравниваемое с наибольшей длиной серии: '.$numsr2.'<br>';
    if (($vn>$numsr1)and($tmax<$numsr2)){
        echo 'Гипотеза принимается по критерию на основе медианы!';
    } else {
        echo 'Гипотеза отвергается по критерию на основе медианы!';
    }
//////--------------------------------------------------------------
echo '<br style="color:white";>Проверка гипотезы по критерию "восходящих и нисходящих серий"<br>';
echo 'ẟ:';    
$deltat = array();
$tr1='<tr style="color:white";><td>Период</td>'; $tr2='<tr style="color:white";><td>Значение</td>'; $tr3='<tr style="color:white";><td>ẟ:</td>';
    for ($i=0;$i<$length-1;$i++){
        if (($array[$i+1]-$array[$i])>0){
            array_push($deltat,1);
            echo '+';
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.($array[$i+1]-$array[$i]).'</td>';
            $tr3.='<td>+</td>';
        } else if (($array[$i+1]-$array[$i])<0) {
            array_push($deltat,0);
            echo '-';
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.($array[$i+1]-$array[$i]).'</td>';
            $tr3.='<td>-</td>';
        } else {
            $tr1.='<th>'.($i+1).'</th>';
            $tr2.='<td>'.($array[$i+1]-$array[$i]).'</td>';
            $tr3.='<td></td>';
        }
    }
    $tr1.='</tr>'; $tr2.='</tr>'; $tr3.='</tr>';
    echo '<br style="color:white";><table style="color:white"; border="1" class="tab1">'.$tr1.$tr2.$tr3.'</table>';
    $vn=1;
    $tmax=-1;
    $tlength=1;
    for ($i=0;$i<count($deltat);$i++){
        if ($deltat[$i]==isset($deltat[$i+1])){
            $tlength++;
        } else {
            if ($i!=count($deltat)-1) $vn++;
            if ($tlength>$tmax){
                $tmax=$tlength;
                $tlength=1;
            }
        }
    }
    if ($tmax==-1) $tmax=count($deltat);
    echo '<br style="color:white";>Серий: '.$vn.', наибольшая длина серии: '.$tmax.'<br>';
    $numsr1 = (int)((2*$length-1)/3-1.96*sqrt((16*$length-29)/90));
    $numsr2 = 5 + ($length>26)+($length>153)+($length>1170);
    echo  'Сравниваемое с числом серий: '.$numsr1.', сравниваемое с наибольшей длиной серии: '.$numsr2.'<br>';
    if (($vn>$numsr1)and($tmax<$numsr2)){
        echo 'Гипотеза принимается по критерию "восходящих и нисходящих серий"!';
    } else {
        echo 'Гипотеза отвергается по критерию "восходящих и нисходящих серий"!';
    }

}////////////////////////////////////////////
function lr82($array){
    $array = array_values($array);
    $table = '<table style="color:white"; border="1" class="tab1">';
    $table.='<th>№</th><th>Yt</th><th>t</th><th>Yt*t</th><th>t^2</th><th>Yt*t^2</th><th>t^4</th><th>lnYt</th><th>ln(Yt)t</th>';
    $length = count($array); $midle = (int)($length/2);
    $sum2=0;$sum4=0;$sum5=0;$sum6=0;$sum7=0;$sum8=0;$sum9=0;
    for ($i=0;$i<$length;$i++){
        $table.= '<tr><td>'.($i+1).'</td><td>'.$array[$i].'</td><td>'.($i-$midle).'</td><td>'.$array[$i]*($i-$midle).'</td><td>'.($i-$midle)*($i-$midle).'</td><td>'.$array[$i]*($i-$midle)*($i-$midle).'</td><td>'.($i-$midle)*($i-$midle)*($i-$midle)*($i-$midle).'</td><td>'.number_format(log($array[$i]), 2, '.', ',').'</td><td>'.number_format(log($array[$i])*($i-$midle), 2, '.', ',').'</td></tr>';
        $sum2+=$array[$i];
        $sum4+=$array[$i]*($i-$midle);
        $sum5+=($i-$midle)*($i-$midle);
        $sum6+=$array[$i]*($i-$midle)*($i-$midle);
        $sum7+=($i-$midle)*($i-$midle)*($i-$midle)*($i-$midle);
        $sum8+=log($array[$i]);
        $sum9+=log($array[$i])*($i-$midle);
    }
    $table.= '<tr><td>Суммы</td><td>'.$sum2.'</td><td></td><td>'.$sum4.'</td><td>'.$sum5.'</td><td>'.$sum6.'</td><td>'.$sum7.'</td><td>'.number_format($sum8, 2, '.', ',').'</td><td>'.number_format($sum9, 2, '.', ',').'</td></tr>';
      
    if ($length>1){

    $a1 = $sum2/$length;
    $b1 = $sum4/$sum5;
    $expr1 = 'y=('.$a1.')+('.$b1.'t)';
    $c2 = ($length*$sum6-$sum5*$sum2)/($length*$sum7-$sum5*$sum5);
    $a2 = $a1-($sum5/$length)*$c2;
    $b2 = $b1;    
    $expr2 ='y=('.$a2.')+('.$b2.'t)+('.$c2.'t^2)';
    $a3 = exp($sum8/$length);
    $b3 = exp($sum9/$sum5);
    $expr3 = 'y=('.$a3.')*('.$b3.'^t)';
    $arr2 = array();
    $str = '';
    array_push($arr2,$str);
    for($i=0;$i<$length;$i++){
        $str = '["'.($i+1).'",'.round($array[$i], 2).','.round($a1+$b1*($i-$midle), 2).','.round($a2+$b2*($i-$midle)+$c2*($i-$midle)*($i-$midle), 2).','.round($a3*(Pow($b3,($i-$midle))), 2).'],';
        array_push($arr2,$str);
    }
    $str = implode($arr2);
    } else $str = '["'.(1).'",'.round($array[0], 2).','.round($array[0], 2).','.round($array[0], 2).','.round($array[0], 2).'],';
    
    $table.='</table>';
    $str = implode("", $arr2);
    $newarr = array(
        "table"=>$table,
        "data"=>$str,
        "expr1"=>$expr1,
        "expr2"=>$expr2,
        "expr3"=>$expr3
    );
    return $newarr;
}

?>