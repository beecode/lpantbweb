<?php
$anak = $data->anak->first();
$sumber = $anak->sumber_informasi->first();
?>

<div class="col-xs-12">
  <h5>
    <strong>Sumber Informasi</strong>
  </h5>
    <div class="table-responsive">
        <table class="table small">
            <tbody>
                <tr>
                    <th style="width:23.6%">Nama  </th>
                    <td>{{$sumber->sumber}}</td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <?php
                    $tgl = DateHelper::showDate(
                      $sumber->tanggal_informasi,
                      $sumber->bulan_informasi,
                      $sumber->tahun_informasi
                    );
                  ?>
                  <td>{{$tgl}}</td>
                </tr>
                <tr>
                    <th>Dasar Rujukan</th>
                    <td>{{$sumber->dasar_rujukan}}</td>
                </tr>
                <tr>
                    <th>Contact Person</th>
                    <td>{{$sumber->contact_person}}</td>
                </tr>
                <tr>
                    <th>Telp</th>
                    <td>{{$sumber->telp}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
