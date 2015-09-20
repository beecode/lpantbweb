<?php if (!is_null($table->first())) { ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-responsive" >
            <thead>
                <tr class="small">
                    <th class="text-center">Kode</th>
                    <th class="text-center">Agama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($table as $val) { ?>
                    <tr class="text-center small">
                        <td>{{$val->id}}</td>
                        <td>{{$val->nama}}</td>
                        <td style="text-align: center;">
                            <div class="btn btn-group btn-group-sm" style="margin: 0px; padding: 0px;">
                                <a class="btn btn-small btn-success" title="Update"
                                   href="{{ URL::to('/dash/setting/agama/updateview/'.$val->id) }}">
                                    <span class=" glyphicon glyphicon-edit"></span> </a>
                                <a class="btn btn-small btn-danger" title="Delete"
                                   href="{{ URL::to('/dash/setting/agama/delete/'.$val->id) }}">
                                    <span class="glyphicon glyphicon-trash"></span> </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-info">
            Data tidak tersedia atau tidak ditemukan...
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
    $(".table").dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
    });
</script>
