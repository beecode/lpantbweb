<?php
$keluarga = $data->anak->first()->keluarga;
$ayah = $keluarga->ayah;
$ibu = $keluarga->ibu;
?>

<div class="table-responsive">
    <table class="table small">
        <tbody>
            <tr>
                <th style="width:23.6%">Nama Bapak</th>
                <td>{{$ayah->nama}}</td>
            </tr>
            <tr>
                <th>Tempat/Tanggal Lahir</th>
                <?php
                  $tgl = DateHelper::showDate(
                    $ayah->tanggal_lahir,
                    $ayah->bulan_lahir,
                    $ayah->tahun_lahir
                  );
                ?>
                <td>{{$ayah->tempat_lahir.", "}}{{$tgl}}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>
                    {{$ayah->alamat}}<br/>
                    Desa {{$ayah->desa->nama}} -
                    Kecamatan {{$ayah->desa->kecamatan->nama}}<br/>
                    {{$ayah->desa->kecamatan->kabkota->nama}} -
                    Provinsi {{$ayah->desa->kecamatan->kabkota->provinsi->nama}}
                </td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td><?php echo (!empty($ayah->pekerjaan)) ? $ayah->pekerjaan : "-"; ?></td>
            </tr>
            <tr>
                <th>Pendidikan Terakhir</th>
                <td><?php echo (!empty($ayah->pendidikan_terakhir)) ? $ayah->pendidikan_terakhir : "-"; ?></td>
            </tr>
            <tr>
                <th>Telpon</th>
                <td><?php echo (!empty($ayah->telp)) ? $ayah->telp : "-"; ?></td>
            </tr>
        </tbody>
    </table>
</div>
