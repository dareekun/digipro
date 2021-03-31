<html>
<head>
<title>Data PWK</title>
</head>
<table>
<!-- STARTER -->
<tr>
<td colspan="99"></td>
</tr>
<tr>
<td colspan="99">{{$bulan}} (MAN TIME CONTROL)</td>
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
<td colspan="3">{{$i+1}}</td>
@endfor
</tr>
<tr>
<!-- Kosong -->
<td colspan="5"></td>
<!-- Shift -->
@for ($i = 0; $i < $date; $i++)
<td>Shift 1</td>
<td>Shift 2</td>
<td>Shift 3</td>
@endfor
</tr>
<!-- Working Day -->
<tr>
<td colspan="3">Working Day</td>
<td colspan="2">Working Time</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- Working Day Row 2 -->
<tr>
<td colspan="3"></td>
<td colspan="2">Working Time</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- TTL REGISTERED EMPLOYEE -->
<tr>
<td colspan="5">A. TTL REGISTERED EMPLOYEE</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- Karyawan Tetap -->
<tr>
<td>1</td>
<td>Karyawan Tetap</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- Karyawan Kontrak -->
<tr>
<td>1</td>
<td>Karyawan Kontrak</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- Absence Employee -->
<tr>
<td>3</td>
<td>Absence Employee</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- IN/OUT Support -->
<tr>
<td>4</td>
<td>IN/OUT Support +/-</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- space -->
<tr>
<td colspan="99"></td>
</tr>
<!-- Avail Working Time -->
<tr>
<td>3</td>
<td>Avail Working Time</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- Overtime -->
<tr>
<td>2</td>
<td>Overtime</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- IN/OUT Support -->
<tr>
<td>1</td>
<td>In/Out Support +/-</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
<!-- TOTAL WORKING TIME -->
<tr>
<td colspan="5">C. TOTAL WORKING TIME</td>
@for ($i = 0; $i < $date; $i++)
<td></td>  <!-- Shift 1 -->
<td></td>  <!-- Shift 2 -->
<td></td>  <!-- Shift 3 -->
@endfor
</tr>
</table>
</html>