<?php foreach ($table as $val) { ?>
  <?php
    $anak = isset($val->anak->first()->nama) ? $val->anak->first() : null;
    $pelapor = isset($anak->pelapor->first()->nama) ? $anak->pelapor->first() : null;
  ?>


  <tr>
          <?php if ($val->mode=="multiple"){ ?>
               <?php if ($val->multiple_sequence == 1) { ?>
                     <td data-rowspan="{{$val->multiple_total}}" style="vertical-align: middle;">
                        {{$val->no_lka}} &nbsp;
                        <?php $lka = base64_encode($val->no_lka); ?>
                        <a class="btn btn-small btn-info pull-right" title="Multi Kasus"
                           href="{{ URL::to('/dash/formka1multi/view/'.$lka)}}">
                             <span class=" glyphicon glyphicon-th-large"></span>
                        </a>
                     </td>

               <?php  } else{ ?>
                  <td data-hide="true">{{$val->no_lka}}</td>
               <?php  } ?>
          <?php  } else { ?>
            <td>
              {{$val->no_lka}}
              <?php $lka = base64_encode($val->no_lka); ?>
              <a class="btn btn-small btn-info pull-right" title="Multi Kasus"
                 href="{{ URL::to('/dash/formka1multi/view/'.$lka)}}">
                   <span class=" glyphicon glyphicon-th-large"></span>
              </a>
            </td>
          <?php  } ?>

          <td>{{strftime( "%d-%B-%Y", strtotime($val->tanggal))}}</td>
          <td><?php echo !is_null($pelapor) ? $pelapor->nama : ""; ?></td>
          <td><?php echo !is_null($anak) ? $anak->nama : ""; ?></td>
          <td><?php echo $val->user->name; ?></td>
          <td class="text-center">
            <?php if (UserHelper::isLoggedUserIncluded($val->user)){ ?>
              <div class="btn btn-group btn-group-sm" style="margin: 0px; padding: 0px;">
                <a class="btn btn-small btn-info" title="Detail Form"
                   href="{{ URL::to('/dash/formka1/detailview/'.$val->id) }}">
                    <span class=" glyphicon glyphicon-th-list"></span>
                </a>
                <a class="btn btn-small btn-warning" title="Update"
                   href="{{ URL::to('/dash/formka1/updateview/'.$val->id) }}">
                    <span class=" glyphicon glyphicon-edit"></span>
                </a>
                <a class="btn btn-small btn-danger" title="Delete"
                   href="{{ URL::to('/dash/formka1/delete/'.$val->id) }}">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
              </div>
        <?php } else { ?>
            <div class="btn btn-group btn-group-sm" style="margin: 0px; padding: 0px;">
              <a class="btn btn-small btn-info" title="Detail Form"
                 href="{{ URL::to('/dash/formka1/detailview/'.$val->id) }}">
                   <span class=" glyphicon glyphicon-th-list"></span>
              </a>
            </div>
        <?php } ?>
      </td>
    </tr>
<?php } ?>
