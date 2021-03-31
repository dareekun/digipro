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
        <td colspan="99"> - {{$bulan}} (MAN TIME CONTROL) / {{$tipe}}</td>
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
        <td colspan="2">Working Day</td>
        <td colspan="3">Working Time</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Working Day Row 2 -->
    <tr>
        <td colspan="2"></td>
        <td colspan="3">Working Time</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- TTL REGISTERED EMPLOYEE -->
    <tr>
        <td colspan="5">A. TTL REGISTERED EMPLOYEE</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Karyawan Tetap -->
    <tr>
        <td></td>
        <td colspan="4">Karyawan Tetap</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Karyawan Kontrak -->
    <tr>
        <td></td>
        <td colspan="4">Karyawan Kontrak</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Absence Employee -->
    <tr>
        <td></td>
        <td colspan="4">Absence Employee</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- IN/OUT Support -->
    <tr>
        <td></td>
        <td colspan="4">IN/OUT Support +/-</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- Avail Working Time -->
    <tr>
        <td></td>
        <td colspan="4">Avail Working Time</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Overtime -->
    <tr>
        <td></td>
        <td colspan="4">Overtime</td>
        @for ($i = 0; $i < $date; $i++)             
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- IN/OUT Support -->
    <tr>
        <td></td>
        <td colspan="4">In/Out Support +/-</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- TOTAL WORKING TIME -->
    <tr>
        <td colspan="5">C. TOTAL WORKING TIME</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- space -->
    <tr>
    <td colspan="99"></td>
    </tr>
    <!-- TOTAL LOST TIME GROUP START -->
    <!-- /////////////////////////// -->
    <!-- REGULATED LOST GROUP -->
    @foreach ($regloss as $loss1)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$loss1->loss}}</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    @endforeach
    <!-- Regulated LOSS TOTAL -->
    <tr>
    <td></td>
        <td colspan="4">D. REGULATED LOSS TOTAL</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- Working LOSS GROUP -->
    <!-- ////////////////// -->
    @foreach ($workloss as $loss2)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$loss2->loss}}</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    @endforeach
        <!-- Working LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">E. WORKING LOSS TOTAL</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- ORGANIZATION LOSS GROUP -->
    <!-- ////////////////// -->
    @foreach ($orgloss as $loss3)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$loss3->loss}}</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    @endforeach
        <!-- Organization LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">F. ORGANIZATION LOSS TOTAL</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- DEFECT LOSS GROUP -->
    <!-- ////////////////// -->
    @foreach ($defloss as $loss4)
    <tr>
    <td></td>
    <td></td>
    <td colspan="3">{{$loss4->loss}}</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    @endforeach
        <!-- Defect LOSS TOTAL -->
        <tr>
    <td></td>
        <td colspan="4">G. DEFECT LOSS TOTAL</td>
        @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
        <td align="right">0</td>
    </tr>
    <!-- CALCULATION LOST TIME TOTAL -->
    <!-- ////////////////// -->
    <tr>
    <td colspan="5">H. LOST TIME TOTAL</td>
    @for ($i = 0; $i < $date; $i++) 
            <td align="center">data</td> <!-- Shift 1 -->
            <td align="center">data</td> <!-- Shift 2 -->
            <td align="center">data</td> <!-- Shift 3 -->
        @endfor
    <!-- /////////////////////////// -->
    <!-- TOTAL LOST TIME GROUP END -->
    <td align="right">0</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- NET WORTH TIME TOTAL -->
    <tr>
    <td colspan="5">I. NET WORKING TIME</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- GOOD PRODUCTIVITY QTY -->
    <tr>
    <td colspan="5">J. GOOD PRODUCTIVITY QTY</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- DEFICIENCY QTY -->
    <tr>
    <td colspan="5">K. DEFICIENCY QTY</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- DEF.RATIO=(K)/(K+J)x100% -->
    <tr>
    <td colspan="5">DEF.RATIO=(K)/(K+J)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- (L)STD PROCESS TIME=ST TIMEx(J+K) -->
    <tr>
    <td colspan="5">(L)STD PROCESS TIME=ST TIMEx(J+K)</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- OPR. RATIO=((C-H)/(C-D1)x100% -->
    <tr>
    <td colspan="5">OPR. RATIO=((C-H)/(C-D1)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- T/LOSS RATIO=(H)/(C)x100% -->
    <tr>
    <td colspan="5">T/LOSS RATIO=(H)/(C)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- EFFICIENCY=(L)/(I)x100% -->
    <tr>
    <td colspan="5">EFFICIENCY=(L)/(I)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- TTL PRODUCTIVITY=(L)/(C)x100% -->
    <tr>
    <td colspan="5">TTL PRODUCTIVITY=(L)/(C)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- PRODUCTIVITY/HEAD/HOUR=((J+K)/ (C-D1))*60 -->
    <tr>
    <td colspan="5">PRODUCTIVITY/HEAD/HOUR=((J+K)/ (C-D1))*60</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>



    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>

    <!-- ATTENDANCE=(A-B)/(A)x100% -->
    <tr>
    <td colspan="5">ATTENDANCE=(A-B)/(A)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- (M)NET OPERATION TIME=(C)-(D+E) -->
    <tr>
    <td colspan="5">(M)NET OPERATION TIME=(C)-(D+E)</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- LINE BALANCE RATIO=(M-F)/(M)x100% -->
    <tr>
    <td colspan="5">LINE BALANCE RATIO=(M-F)/(M)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- (N)EFFICIENT TIME=C-(D+E+F) -->
    <tr>
    <td colspan="5">(N)EFFICIENT TIME=C-(D+E+F)</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- VALUE TIME RATIO=(N-G)/(N)x100% -->
    <tr>
    <td colspan="5">VALUE TIME RATIO=(N-G)/(N)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- EFFICIENCY=(L)/(I)x100% -->
    <tr>
    <td colspan="5">EFFICIENCY=(L)/(I)x100%</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
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
    <td align="right">0</td>
    </tr>
    <!-- HASIL PRODUKSI -->
    <tr>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    @foreach ($type as $tp) 
    <tr>
    <td colspan="4">{{$tp->tipe}}</td>
    <td>time</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    </tr>
    @endforeach
    <!-- Plan Waktu Kerja -->
    <tr>
    <td colspan="5" rowspan="2">PLAN WAKTU KERJA</td>
    @for ($i = 0; $i < $date; $i++)  
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- Plan Waktu Kerja FOOTER -->
    <tr>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
    <!-- space -->
    <tr>
        <td colspan="99"></td>
    </tr>
    <!-- Efficiency Line -->
    <tr>
    <td colspan="5">Efficiency Line</td>
    @for ($i = 0; $i < $date; $i++) 
        <td align="center">data</td> <!-- Shift 1 -->
        <td align="center">data</td> <!-- Shift 2 -->
        <td align="center">data</td> <!-- Shift 3 -->
    @endfor
    <td align="right">0</td>
    </tr>
</table>

</html>