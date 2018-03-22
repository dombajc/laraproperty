<?php
$jml_unit = 0;
$sts_bf = 0;
$sts_wawancara = 0;
$sts_sp3k = 0;
$sts_akad = 0;
$sts_terjual = 0;
?>

<tr><td>Nama Proyek </td><td>: {{ $get_detil->nm_proyek }}</td></tr>
<tr><td>Alamat </td><td>: {{ $get_detil->alamat }}<br>: {{ $get_detil->nm_provinsi }} {{ $get_detil->nm_kecamatan }} Kec. {{ $get_detil->nm_kota }}  Kel. {{ $get_detil->nm_kelurahan }}</td></tr>
<tr><td>Periode </td><td>: {{ App\Fungsi::format_sql_to_indo($get_detil->periode_mulai) }} s.d {{  App\Fungsi::format_sql_to_indo($get_detil->periode_selesai) }}</td></tr>
<tr><td>Luas </td><td>: {{ number_format($get_detil->luas_proyek) }} HA</td></tr>
<br>
<tr><td>Nama Tipe </td><td>: {{ $t->nm_tipe }}</td></tr>
<br>
<table>';
<thead>
<tr>
<th align="center">No.</th>
<th align="center">KAPLING</th>
<th align="center">STATUS TERJUAL</th>
<th align="center">TGL TERJUAL</th>
<th align="center">PROSES TERAKHIR</th>
</tr>
</thead>
<tbody>
<?php $no=1; ?>
@if(isset($k[$t->id_tipe_proyek]))
<?php $jml_unit = count(collect($k[$t->id_tipe_proyek])); ?>
@foreach( $k[$t->id_tipe_proyek] as $r )
    <tr>
        <td align="right">{{ $no }}</td>
        <td>{{ $r->alamat }}</td>
        <td align="center">{{ $r->sts_terjual }}</td>
        <td align="center">{{ $r->tgl_terjual }}</td>
        <td align="center">{{ $r->sts_proses }}</td>
    </tr>
    <?php 
    $no++; 
    if ( $r->sts_terjual == 'Terjual' ) {
        $sts_terjual++;
    }

    switch( $r->sts_proses ):
        case 'Booking Fee':
            $sts_bf++;
        break;
        case 'Wawancara':
            $sts_wawancara++;
        break;
        case 'SP3K':
            $sts_sp3k++;
        break;
        case 'Akad':
            $sts_akad++;
        break;
    endswitch;
    ?>
@endforeach
@endif
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><b>TOTAL UNIT</b></td><td align="right" colspan="3"><b>{{ number_format($jml_unit) }}</b></td>
</tr>
<tr>
<td colspan="2" align="right"><b>BELUM TERJUAL</b></td><td align="right" colspan="3"><b>{{ number_format($jml_unit-$sts_terjual) }}</b></td>
</tr>
<tr>
<td colspan="2" align="right"><b>BOOKING FEE</b></td><td align="right" colspan="3"><b>{{ number_format($sts_bf) }}</b></td>
</tr>
<tr>
<td colspan="2" align="right"><b>WAWANCARA</b></td><td align="right" colspan="3"><b>{{ number_format($sts_wawancara) }}</b></td>
</tr>
<tr>
<td colspan="2" align="right"><b>SP3K</b></td><td align="right" colspan="3"><b>{{ number_format($sts_sp3k) }}</b></td>
</tr>
<tr>
<td colspan="2" align="right"><b>AKAD</b></td><td align="right" colspan="3"><b>{{ number_format($sts_akad) }}</b></td>
</tr>
</tfoot>
</table>