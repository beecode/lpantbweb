<?php
$keluarga = null;
$ayah = null;
$loc_ayah = App\Helpers\LocationHelper::location();
if (!is_null($anak->keluarga)) {
    $keluarga = $anak->keluarga;
    if (!is_null($keluarga->ibu)) {
        $ibu = $keluarga->ibu;
        $loc_ibu = App\Helpers\LocationHelper::location($ibu->desa->id);
    }
}
?>

<?php if ($form_status == "edit") { ?>
    <?php if (!is_null($ayah)) { ?>
        {{Form::input('hidden','ayah[id]', $ayah->id)}}
    <?php } ?>
<?php } ?>

<div class="form-group has-primary">
    <label class="control-label" style="margin-left: 5.6%;">
        <p class="lead">Identitas Bapak</p>
    </label>
</div>

<div class="form-group has-primary">
    {{ Form::label('ayah[nama]', 'Nama', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $ayh['nama'] = (isset($ayah->nama)) ? $ayah->nama : null; ?>
        {{ Form::text('ayah[nama]', $ayh['nama'], ['class' => 'form-control'])  }}
    </div>
    {{ Form::label('ayah[telp]', 'Telpon', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $ayh['telp'] = (isset($ayah->telp)) ? $ayah->telp : null; ?>
        {{ Form::text('ayah[telp]', $ayh['telp'], ['class' => 'form-control'])  }}
    </div>
</div>

<div class="form-group has-primary">
    {{ Form::label('ayah[tempat_lahir]', 'Tempat Lahir', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $ayh['tempat_lahir'] = (isset($ayah->tempat_lahir)) ? $ayah->tempat_lahir : null; ?>
        {{ Form::input('text','ayah[tempat_lahir]', $ayh['tempat_lahir'], ['class' => 'form-control'])  }}
    </div>


    {{ Form::label('tgl', 'Tanggal Lahir',['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-1" style="margin-right:  0px; padding-right: 0px; width: 80px; ">
        <?php $ayh['tanggal_lahir'] = (isset($ayah->tanggal_lahir)) ? $ayah->tanggal_lahir : null; ?>
        <?php
          $hari_list = [];
          $hari_list["Hari"] = "Hari";
          for ($h = 1; $h<=31; $h++){
            $hari_list[$h] = $h;
          }
        ?>
        {{ Form::select('ayah[tanggal_lahir]',
                                             $hari_list ,
                                             $ayh['tanggal_lahir'],
                                             ['class'=>'form-control'])
        }}
    </div>
    <div class="col-sm-1" style="margin: 0px; padding: 0px; width: 89px;">
        <?php $ayh['bulan_lahir'] = (isset($ayah->bulan_lahir)) ? $ayah->bulan_lahir : null; ?>
        <?php
          $bulan_list = [];
          $bulan_list["Bulan"] = "Bulan";
          for ($b = 1; $b<=12; $b++){
            $bulan_list[$b] = $b;
          }
        ?>
        {{ Form::select('ayah[bulan_lahir]', $bulan_list, $ayh['bulan_lahir'], ['class'=>'form-control'])}}
    </div>
    <div class="col-sm-2" style="margin: 0px; padding: 0px; width: 89px;">
      <?php $ayh['tahun_lahir'] = (isset($ayah->tahun_lahir)) ? $ayah->tahun_lahir : null; ?>
      <?php
      $year_start = 1910;
      $year_end = date("Y");
      $tahun_list = [];
      $tahun_list["Tahun"] = "Tahun";
      for ($i = $year_start; $i<=$year_end; $i++){
        $tahun_list[$i]=$i;
      }
      ?>
      {{ Form::select('ayah[tahun_lahir]', $tahun_list, $ayh['tahun_lahir'], ['class'=>'form-control'])}}
    </div>
</div>


<div class="form-group has-primary">
    {{ Form::label('ayah[pendidikan]', 'Pendidikan', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $ayh['pendidikan'] = (isset($ayah->pendidikan_terakhir)) ? $ayah->pendidikan_terakhir : null; ?>
        {{ Form::text('ayah[pendidikan]', $ayh['pendidikan'], ['class' => 'form-control','placeholder'=>'Pendidikan'])  }}
    </div>

    {{ Form::label('ayah[pekerjaan]', 'Pekerjaan', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $ayh['pekerjaan'] = (isset($ayah->pekerjaan)) ? $ayah->pekerjaan : null; ?>
        {{ Form::text('ayah[pekerjaan]', $ayh['pekerjaan'], ['class' => 'form-control','placeholder'=>'Pekerjaan'])  }}
    </div>
</div>

<?php
$lay = $loc_ayah;
?>

<div class="form-group has-primary">
    {{ Form::label('ayah[provinsi]', 'Provinsi', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $la['provinsi'] = (isset($lay['provinsi_sel'])) ? $lay['provinsi_sel'] : null; ?>
        {{ Form::select('ayah[provinsi]',
                                             $lay['provinsi_lists'],
                                             $la['provinsi'],
                                             ['class'=>'form-control ayah_provinsi'])
        }}
    </div>
    {{ Form::label('ayah[kabkota]', 'Kabupaten / Kota', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $la['kabkota'] = (isset($lay['kabkota_sel'])) ? $lay['kabkota_sel'] : null; ?>
        {{ Form::select('ayah[kabkota]',
                                        $lay['kabkota_lists'],
                                        $la['kabkota'],
                                        ['class'=>'form-control ayah_kabkota'])  }}
    </div>

</div>



<div class="form-group has-primary">
    {{ Form::label('ayah[kecamatan]', 'Kecamatan', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $la['kecamatan'] = (isset($lay['kecamatan_sel'])) ? $lay['kecamatan_sel'] : null; ?>
        {{ Form::select('ayah[kecamatan]',
                                        $lay['kecamatan_lists'],
                                        $la['kecamatan'],
                                        ['class'=>'form-control ayah_kecamatan'])  }}
    </div>

    {{ Form::label('ayah[desa]', 'Desa', ['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-3">
        <?php $la['desa'] = (isset($lay['desa_sel'])) ? $lay['desa_sel'] : null; ?>
        {{ Form::select('ayah[desa]',
                                        $lay['desa_lists'],
                                        $la['desa'],
                                        ['class'=>'form-control ayah_desa'])  }}
    </div>
</div>


<div class="form-group has-primary">
    {{ Form::label('ayah[alamat]', 'Alamat',['class'=>'col-sm-2 control-label']) }}
    <div class="col-sm-8">
        <?php $ayh['alamat'] = (isset($ayah->alamat)) ? $ayah->alamat : null; ?>
        {{ Form::textarea('ayah[alamat]', $ayh['alamat'], ['class' => 'form-control','rows'=>'2'])  }}
    </div>
</div>

<script type="text/javascript">
    ajaxSelectLocation(
            '.ayah_provinsi',
            '<?php echo URL::to("dash/location/kabkota") ?>',
            '.ayah_kabkota'
            );
    ajaxSelectLocation(
            '.ayah_kabkota',
            '<?php echo URL::to("dash/location/kecamatan") ?>',
            '.ayah_kecamatan'
            );
    ajaxSelectLocation(
            '.ayah_kecamatan',
            '<?php echo URL::to("dash/location/desa") ?>',
            '.ayah_desa'
            );
</script>
