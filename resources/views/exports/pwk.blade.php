<html>

<head>
    <title>Data PWK</title>
    <style>
table, th, td {
  width:100%;
  border: 1px solid black;
  border-collapse: collapse;
  white-space: nowrap;
}
</style>
</head>
<table>
    <!-- STARTER -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <tr>
        <td colspan="99"> - {{$bulan}} (MAN TIME CONTROL) / {{$lini}}</td>
    </tr>
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- HEADER TABLE -->
    <tr>
        <!-- Kosong -->
        <td colspan="5"></td>
        <!-- Tanggal -->
        @for ($i = 0; $i < $date; $i++) 
        <td colspan="3" align="center">{{$i+1}}</td>
        @endfor
        <td>Total</td>
    </tr>
    <tr>
        <!-- Kosong -->
        <td colspan="5"></td>
        <!-- Shift -->
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">Shift 1</td> <!-- Shift 1 -->
            <td align="center">Shift 2</td> <!-- Shift 2 -->
            <td align="center">Shift 3</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Working Day -->
    <tr>
        <td colspan="2" rowspan="2">Working Day</td>
        <td colspan="3">Working Time</td>
        @for ($i = 0; $i < count($baris1); $i++)             
            <td align="center">{{$baris1[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris1)}}</td>
    </tr>
    <!-- Working Day Row 2 -->
    <tr>
        <td colspan="3">Overtime</td>
        @for ($i = 0; $i < count($baris2); $i++)             
            <td align="center">{{$baris2[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris2)}}</td>
    </tr>
    <!-- Working Day Total -->
    <tr>
        <td colspan="5"></td>
        @for ($i = 0; $i < count($baris3); $i++)             
            <td align="center">{{$baris3[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris3)}}</td>
    </tr>
    <!-- TTL REGISTERED EMPLOYEE -->
    <tr>
        <td colspan="5">A. TTL REGISTERED EMPLOYEE</td>
        @for ($i = 0; $i < count($baris4); $i++)             
            <td align="center">{{$baris4[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris4)}}</td>
    </tr>
    <!-- Karyawan Tetap -->
    <tr>
        <td rowspan="4"></td>
        <td colspan="4">Karyawan Tetap</td>
        @for ($i = 0; $i < count($baris5); $i++)             
            <td align="center">{{$baris5[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris5)}}</td>
    </tr>
    <!-- Karyawan Kontrak -->
    <tr>
        <td colspan="4">Karyawan Kontrak</td>
        @for ($i = 0; $i < count($baris6); $i++)             
            <td align="center">{{$baris6[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris6)}}</td>
    </tr>
    <!-- Absence Employee -->
    <tr>
        <td colspan="4">B. Absence Employee</td>
        @for ($i = 0; $i < count($baris7); $i++)             
            <td align="center">{{$baris7[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris7)}}</td>
    </tr>
    <!-- IN/OUT Support -->
    <tr>
        <td colspan="4">IN/OUT Support +/-</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">0</td> <!-- Shift 1 -->
            <td align="center">0</td> <!-- Shift 2 -->
            <td align="center">0</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- Avail Working Time -->
    <tr>
        <td rowspan="3"></td>
        <td colspan="4">Avail Working Time</td>
        @for ($i = 0; $i < count($baris8); $i++)             
            <td align="center">{{$baris8[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris8)}}</td>
    </tr>
    <!-- Overtime -->
    <tr>
        <td colspan="4">Overtime</td>
        @for ($i = 0; $i < count($baris9); $i++)             
            <td align="center">{{$baris9[$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{array_sum($baris9)}}</td>
    </tr>
    <!-- IN/OUT Support -->
    <tr>
        <td colspan="4">In/Out Support +/-</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">0</td> <!-- Shift 1 -->
            <td align="center">0</td> <!-- Shift 2 -->
            <td align="center">0</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- TOTAL WORKING TIME -->
    <tr>
    <td colspan="5">C. TOTAL WORKING TIME</td>
    @for ($i = 0; $i < count($baris10); $i++)             
    <td align="center">{{$baris10[$i]}}</td> 
    @endfor
    <td align="right">{{array_sum($baris10)}}</td>
    </tr>
    <!-- space -->
    <tr>
    <td colspan="99"></td>
    </tr>
    <!-- TOTAL LOST TIME GROUP START -->
    <!-- /////////////////////////// -->

    <!-- REGULATED LOST GROUP -->
    <!-- /////////////////////////// -->
    @for ($i = 0; $i < count($regloss[0]); $i++)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$regloss[0][$i]}}</td>
        @for ($n = 1, $sum1 = 0; $n < count($regloss); $n++) 
        @php
            $sum1 = $sum1 + $regloss[$n][$i];
        @endphp
            <td align="center">{{$regloss[$n][$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$sum1}}</td>
    </tr>
    @endfor
    <!-- Regulated LOSS TOTAL -->
    <tr>
    <td></td>
        <td colspan="4">D. FIXED LOSS TOTAL</td>
        @for ($n = 1, $ttl1 = 0; $n < count($regloss); $n++) 
        @php
        $ttl1 = $ttl1 + array_sum($regloss[$n]);
        @endphp
            <td align="center">{{array_sum($regloss[$n])}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$ttl1}}</td>
    </tr>
    <!-- Working LOSS GROUP -->
    <!-- ////////////////// -->
    @for ($i = 0; $i < count($workloss[0]); $i++)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$workloss[0][$i]}}</td>
        @for ($n = 1, $sum2 = 0; $n < count($workloss); $n++) 
        @php
            $sum2 = $sum2 + $workloss[$n][$i];
        @endphp
            <td align="center">{{$workloss[$n][$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$sum2}}</td>
    </tr>
    @endfor
        <!-- Working LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">E. WORKING LOSS TOTAL</td>
        @for ($n = 1, $ttl2 = 0; $n < count($workloss); $n++) 
        @php
        $ttl2 = $ttl2 + array_sum($workloss[$n]);
        @endphp
            <td align="center">{{array_sum($workloss[$n])}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$ttl2}}</td>
    </tr>
    <!-- ORGANIZATION LOSS GROUP -->
    <!-- /////////////////////// -->
    @for ($i = 0; $i < count($orgloss[0]); $i++)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$orgloss[0][$i]}}</td>
        @for ($n = 1, $sum3 = 0; $n < count($orgloss); $n++) 
        @php
            $sum3 = $sum3 + $orgloss[$n][$i];
        @endphp
            <td align="center">{{$orgloss[$n][$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$sum3}}</td>
    </tr>
    @endfor
        <!-- Organization LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">F. ORGANIZATION LOSS TOTAL</td>
        @for ($n = 1, $ttl3 = 0; $n < count($orgloss); $n++) 
        @php
        $ttl3 = $ttl3 + array_sum($orgloss[$n]);
        @endphp
            <td align="center">{{array_sum($orgloss[$n])}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$ttl3}}</td>
    </tr>
    <!-- DEFECT LOSS GROUP -->
    <!-- ////////////////// -->
    @for ($i = 0; $i < count($defloss[0]); $i++)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$defloss[0][$i]}}</td>
        @for ($n = 1, $sum4 = 0; $n < count($defloss); $n++) 
        @php
            $sum4 = $sum4 + $defloss[$n][$i];
        @endphp
            <td align="center">{{$defloss[$n][$i]}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$sum4}}</td>
    </tr>
    @endfor
        <!-- Defect LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">G. DEFECT LOSS TOTAL</td>
        @for ($n = 1, $ttl4 = 0; $n < count($defloss); $n++) 
        @php
        $ttl4 = $ttl4 + array_sum($defloss[$n]);
        @endphp
            <td align="center">{{array_sum($defloss[$n])}}</td> <!-- Shift 1 -->
        @endfor
        <td align="right">{{$ttl4}}</td>
    </tr>
    <!-- CALCULATION LOST TIME TOTAL -->
    <!-- ////////////////// -->
    <tr>
    <td colspan="5">H. LOST TIME TOTAL</td>
    @for ($i = 1, $ttlall = 0; $i < count($defloss); $i++) 
        <td align="center">{{$sum = array_sum($regloss[$i]) + array_sum($workloss[$i]) + array_sum($orgloss[$i]) + array_sum($defloss[$i])}}</td> <!-- Shift 1 -->
        @php
        $ttlall = $ttlall + $sum;
        @endphp
    @endfor
    <!-- /////////////////////////// -->
    <!-- TOTAL LOST TIME GROUP END -->
    <td align="right">{{$ttlall}}</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- NET WORTH TIME TOTAL -->
    <tr>
    <td colspan="5">I. NET WORKING TIME</td>
    @for ($i = 0, $ttli = 0; $i < $date * 3; $i++) 
        @php
        $LTT = array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]) + array_sum($defloss[$i+1]);
        $ttli = $ttli + $LTT
        @endphp
        <td align="center">{{$baris10[$i] - $LTT}}</td> <!-- Shift 1 -->
    @endfor
    <td align="right">{{$ttli}}</td>
    </tr>
    <!-- GOOD PRODUCTIVITY QTY -->
    <tr>
    <td colspan="5">J. GOOD PRODUCTIVITY QTY</td>
    @for ($i = 0; $i < count($baris11); $i++)             
            <td align="center">{{$baris11[$i]}}</td> <!-- Shift 1 -->
    @endfor
    <td align="right">{{array_sum($baris11)}}</td>
    </tr>
    <!-- DEFICIENCY QTY -->
    <tr>
    <td colspan="5">K. DEFICIENCY QTY</td>
    @for ($i = 0; $i < count($baris12); $i++)             
            <td align="center">{{$baris12[$i]}}</td> <!-- Shift 1 -->
    @endfor
    <td align="right">{{array_sum($baris12)}}</td>
    </tr>
    <!-- DEF.RATIO=(K)/(K+J)x100% -->
    <tr>
    <td colspan="5">DEF.RATIO=(K)/(K+J)x100%</td>
    @for ($i = 0; $i < count($baris12); $i++)  
        @if ($baris12[$i] == 0) 
        <td align="center">0</td>  
        @else 
        <td align="center">{{number_format((float)(($baris12[$i] / ($baris12[$i] + $baris11[$i])) * 100), 2, '.', '')}} %</td> <!-- Shift 1 -->
        @endif
    @endfor
    <td align="right">{{number_format((float)(array_sum($baris12) / (array_sum($baris12) + array_sum($baris11)) * 100), 2, '.', '')}} %</td>
    </tr>
    <!-- L. STD PROCESS TIME=ST TIMEx(J+K) -->
    <tr>
    <td colspan="5">L. STD PROCESS TIME=ST TIMEx(J+K)</td>
    @for ($i = 0; $i < count($baris13); $i++) 
        <td align="center">{{$baris13[$i]}}</td>
    @endfor
    <td align="right">{{array_sum($baris13)}}</td>
    </tr>
    <!-- OPR. RATIO=((C-H)/(C-D1)x100% -->
    <tr>
    <td colspan="5">OPR. RATIO=((C-H)/(C-D1)x100%</td>
    @for ($i = 0, $hltt = 0; $i < count($baris10); $i++)     
        @if ($baris10[$i] == 0)
        <td align="center">0</td>
        @else  
        @php
        $hltt = array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]) + array_sum($defloss[$i+1]);
        $opratio = (($baris10[$i] - $hltt) / ($baris10[$i] - $subloss1a[$i+1]) ) * 100;
        @endphp      
        <td align="center">{{number_format((float)$opratio, 2, '.', '')}}%</td> 
        @endif
        @endfor
        <td align="right">{{array_sum($baris10)}}</td>
    </tr>
    <!-- T/LOSS RATIO=(H)/(C)x100% -->
    <tr>
    <td colspan="5">T.LOSS RATIO=(H)/(C)x100%</td>
    @for ($i = 0, $ttlsr = 0; $i < count($baris10); $i++)
    @if ($baris10 == 0 || $sum == 0)
    <td align="center">0</td>
    @else 
        @php
        $hsllsr = $sum / $baris10[$i] * 100;
        $ttlsr  = $ttlsr + $hsllsr;
        @endphp
        <td align="center">{{number_format((float)$hsllsr, 2, '.', '')}}%</td> <!-- Shift 1 -->
    @endif
    @endfor
    <td align="right">{{number_format((float)($ttlsr / array_sum($baris10) * 100), 2, '.', '')}}%</td>
    </tr>
    <!-- TTL PRODUCTIVITY=(L)/(C)x100% -->
    <tr>
    <td colspan="5">TTL PRODUCTIVITY=(L)/(C)x100%</td>
    @for ($i = 0; $i < count($baris13); $i++) 
    @if ($baris13[$i] == 0 || $baris10[$i] == 0) 
        <td align="center">0</td>
    @else 
    @php
    $ttlp = $baris13[$i] / $baris10[$i] * 100;
    @endphp
        <td align="center">{{number_format((float)$ttlp, 2, '.', '')}}%</td>+
    @endif
    @endfor
    <td align="right">{{number_format((float)(array_sum($baris13) / array_sum($baris10) * 100), 2, '.', '')}}%</td>
    </tr>
    <!-- PRODUCTIVITY/HEAD/HOUR=((J+K)/ (C-D1))*60 -->
    <tr>
    <td colspan="5">PRODUCTIVITY/HEAD/HOUR=((J+K)/ (C-D1))*60</td>
    @for ($i = 0; $i < count($baris14); $i++) 
        <td align="center">{{$baris14[$i]}}</td>
    @endfor
    <td align="right">{{number_format((float)(((array_sum($baris11)+array_sum($baris12))/array_sum($baris10))*60), 2, '.', '')}}</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- ATTENDANCE=(A-B)/(A)x100% -->
    <tr>
    <td colspan="5">ATTENDANCE=(A-B)/(A)x100%</td>
    @for ($i = 0; $i < count($baris4); $i++)  
    @if ($baris4[$i] == 0)
    <td align="center">0</td> <!-- Shift 1 -->
    @else            
    <td align="center">{{(($baris4[$i]-$baris7[$i])/$baris4[$i])*100}}%</td> <!-- Shift 1 -->
    @endif
    @endfor
    <td align="right">{{number_format((float)(((array_sum($baris4)-array_sum($baris7))/array_sum($baris4))*100), 2, '.', '')}}%</td>
    </tr>
    <!-- (M)NET OPERATION TIME=(C)-(D+E) -->
    <tr>
    <td colspan="5">M.NET OPERATION TIME=(C)-(D+E)</td>
    @for ($i = 0; $i < count($baris10); $i++)   
    <td align="center">{{$baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]))}}</td>    
    @endfor
    <td align="right">{{(array_sum($baris10)-($ttl1+$ttl2))}}</td>
    </tr>
    <!-- LINE BALANCE RATIO=(M-F)/(M)x100% -->
    <tr>
    <td colspan="5">LINE BALANCE RATIO=(M-F)/(M)x100%</td>
    @for ($i = 0; $i < count($baris10); $i++)  
    @if (($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]))) == 0)
    <td align="center">0</td>  
    @else
    @php
    $m = (($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]))) - array_sum($orgloss[$i+1])) / ($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]))) * 100;
    @endphp
    <td align="center">{{number_format((float)$m, 2, '.', '')}}%</td>   
    @endif  
    @endfor
    @php
    $endm = ((array_sum($baris10) - ($ttl1 + $ttl2) - $ttl3) / array_sum($baris10) - ($ttl1 + $ttl2)) * 100;
    @endphp
    <td align="right">{{number_format((float)$endm, 2, '.', '')}}%</td>
    </tr>
    <!-- (N)EFFICIENT TIME=C-(D+E+F) -->
    <tr>
    <td colspan="5">N.EFFICIENT TIME=C-(D+E+F)</td>
    @for ($i = 0; $i < count($baris10); $i++)   
    <td align="center">{{$baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]))}}</td>    
    @endfor
    <td align="right">{{(array_sum($baris10)-($ttl1+$ttl2+$ttl3))}}</td>
    </tr>
    <!-- VALUE TIME RATIO=(N-G)/(N)x100% -->
    <tr>
    <td colspan="5">VALUE TIME RATIO=(N-G)/(N)x100%</td>
    @for ($i = 0; $i < count($baris10); $i++)  
    @if (($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]))) == 0)
    <td align="center">0</td>
    @else
    @php 
    $valuetime = ( ( ($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]))) - (array_sum($defloss[$i+1]))) / ($baris10[$i] - (array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]))) ) * 100;
    @endphp
    <td align="center">{{number_format((float)$valuetime, 2, '.', '')}}%</td>   
    @endif 
    @endfor
    @php 
    $sumvalueratio = ( ( (array_sum($baris10)-($ttl1+$ttl2+$ttl3)) - $ttl4 ) / (array_sum($baris10)-($ttl1+$ttl2+$ttl3)) ) * 100;
    @endphp
    <td align="right">{{number_format((float)$sumvalueratio, 2, '.', '')}}%</td>
    </tr>
    <!-- EFFICIENCY=(L)/(I)x100% -->
    <tr>
    <td colspan="5">EFFICIENCY=(L)/(I)x100%</td>
    @for ($i = 0; $i < count($baris13); $i++) 
    @if ($baris13[$i] == 0 || $baris10[$i] == 0)
        <td align="center">0</td>
    @else 
        @php
        $LTT    = array_sum($regloss[$i+1]) + array_sum($workloss[$i+1]) + array_sum($orgloss[$i+1]) + array_sum($defloss[$i+1]);
        $varEFF = $baris10[$i] - $LTT;
        $eff    = $baris13[$i] / $varEFF * 100;
        @endphp
        <td align="center">{{number_format((float)$eff, 2, '.', '')}}%</td>
    @endif
    @endfor
    <td align="right">{{number_format((float)(array_sum($baris13) / $ttli * 100), 2, '.', '')}} %</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- TGL PRODUKSI -->
    <tr>
    <td colspan="5" rowspan="2">HASIL PRODUKSI</td>
    @for ($i = 0; $i < $date; $i++) 
        <td colspan="3" align="center">{{$i+1}}</td>
    @endfor
    <td align="right">Total</td>
    </tr>
    <!-- HASIL PRODUKSI -->
    <tr>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">Shift 1</td> <!-- Shift 1 -->
        <td align="center">Shift 2</td> <!-- Shift 2 -->
        <td align="center">Shift 3</td> <!-- Shift 3 -->
    @endfor
    <td align="right">Total</td>
    </tr>
    @for ($i = 0; $i < count($type[0]); $i++)
    <tr>
    <td colspan="4">{{$type[0][$i]}}</td>
    <td>{{$type[1][$i]}} s</td>
    @for ($n = 2, $hslttl = 0; $n < count($type); $n++) 
        <td align="center">{{$type[$n][$i]}}</td> <!-- Shift 1 -->
        @php
        $hslttl = $hslttl + $type[$n][$i];
        @endphp
    @endfor
    <td align="right">{{$hslttl}}</td>
    </tr>
    @endfor
</table>

</html>