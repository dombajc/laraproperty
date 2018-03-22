<html>
<h3 align="center">LAPORAN TRANSAKSI BATAL RUMAHSUBSIDICERIA</h3>
<!-- Headings -->
<td><h4 align="center"><?= $header ?></h4></td>


<table width="100%" border=1 cellpadding=5>';
<thead>
<tr>
<th align="center">No.</th>
<th align="center">TGL BATAL</th>
<th align="center">ALASAN</th>
<th align="center">NAMA KONSUMEN</th>
<th align="center">No. HP</th>
<th align="center">TGL JUAL</th>
<th align="center">Alamat Kapling</th>
<th align="center">Tipe</th>
<th align="center">Proyek</th>
<th align="center">MARKETING</th>
</tr>
</thead>
<tbody>
<?php $no=1; ?>
@foreach( $load_data as $r )
    <tr>
        <td align="right">{{ $no }}</td>
        <td align="center">{{ $r->tgl_batal }}</td>
        <td>{{ $r->alasan }}</td>
        <td>{{ $r->nm_konsumen }}</td>
        <td align="center">{{ $r->no_hp }}</td>
        <td>{{ $r->alamat }}</td>
        <td align="center">{{ $r->tgl_jual }}</td>
        <td align="center">{{ $r->nm_tipe }}</td>
        <td align="center">{{ $r->nm_proyek }}</td>
        <td align="center">{{ $r->nm_marketing }}</td>
    </tr>
    <?php $no++; ?>
@endforeach
</tbody></table>
</html>