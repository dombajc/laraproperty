<html>
<h3 align="center">LAPORAN TRANSAKSI PENJUALAN RUMAHSUBSIDICERIA</h3>
<!-- Headings -->
<td><h4 align="center"><?= $header ?></h4></td>


<table width="100%" border=1 cellpadding=5>';
<thead>
<tr>
<th align="center">No.</th>
<th align="center">Tgl Jual</th>
<th align="center">Nama Konsumen</th>
<th align="center">No. HP</th>
<th align="center">Alamat Kapling</th>
<th align="center">Tipe</th>
<th align="center">Proyek</th>
<th align="center">TOTAL PEMBAYARAN</th>
<th align="center">CARA PEMBAYARAN</th>
<th align="center">WCR</th>
<th align="center">SP3K</th>
<th align="center">AKAD</th>
<th align="center">MARKETING</th>
</tr>
</thead>
<tbody>
<?php $no=1; ?>
@foreach( $load_data as $r )
    <tr>
        <td align="right">{{ $no }}</td>
        <td align="center">{{ $r->tgl_jual }}</td>
        <td>{{ $r->nm_konsumen }}</td>
        <td align="center">{{ $r->no_hp }}</td>
        <td>{{ $r->alamat }}</td>
        <td align="center">{{ $r->nm_tipe }}</td>
        <td align="center">{{ $r->nm_proyek }}</td>
        <td align="right">{{ number_format($r->total,0) }}</td>
        <td align="center">{{ $r->cara_pembayaran }}</td>
        <td align="center">{{ $r->tgl_wawancara }}</td>
        <td align="center">{{ $r->tgl_sp3k }}</td>
        <td align="center">{{ $r->tgl_akad }}</td>
        <td align="center">{{ $r->nm_marketing }}</td>
    </tr>
    <?php $no++; ?>
@endforeach
</tbody></table>
</html>