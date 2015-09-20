<?php if (!is_null($table->first())) { ?>
    <div class="table-responsive">
        <table id="tables" class="table  table-bordered table-hover table-responsive" >
            <thead>
                <tr class="small">
                    <th class="text-center">Kode</th>
                    <th>Kabupaten / Kota</th>
                    <th>Provinsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                <?php foreach ($table as $val) { ?>
                    <tr>
                        <td class="text-center">{{$val->id}}</td>
                        <td>{{$val->nama}}</td>
                        <td>{{$val->provinsi->nama}}</td>
                        <td class="text-center">
                            <div class="btn btn-group btn-group-sm" style="margin: 0px; padding: 0px;">
                                <a class="btn btn-small btn-success" title="Update"
                                   href="{{ URL::to('/dash/setting/kabkota/updateview/'.$val->id) }}">
                                    <span class=" glyphicon glyphicon-edit"></span> </a>
                                <a class="btn btn-small btn-danger" title="Delete"
                                   href="{{ URL::to('/dash/setting/kabkota/delete/'.$val->id) }}">
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
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        // "bSort": true,
        "bAutoWidth": false,
        "order":[[0,'asc']],
        "aaSorting":[[0,'asc']],
        "ordering": true,
    });
</script>
