<div class="pull-left">
    <?php if ($location == "search") { ?>
        <a class="btn btn-primary"
           href="{{URL::to('/dash/anak')}}">
            <span class="glyphicon glyphicon-arrow-left"></span>
            Kembali
        </a>
    <?php } ?>

    <a class="btn btn-primary"
       href="{{URL::to('/dash/anak')}}">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Kembali
    </a>
    <a class="btn btn-default"
       href="{{URL::to('/dash/anak/files/addview/'.$anak->id)}}">
        <span class="glyphicon glyphicon-plus"></span>
        Add
    </a>
</div>
<div class="clearfix"></div>
