<div class="pull-left">
    <?php if ($location == "search") { ?>
        <a class="btn btn-primary"
           href="{{URL::to('/dash/formka1')}}">
            <span class="glyphicon glyphicon-arrow-left"></span>
            Kembali
        </a>
    <?php } ?>

    <a class="btn btn-primary"
       href="{{URL::to('/dash/formka1')}}">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Kembali
    </a>

    <a class="btn btn-primary"
       href="{{URL::to('/dash/formka1multi/addview/'.$lka)}}">
        <span class="glyphicon glyphicon-plus"></span>
        Tambah
    </a>

    &nbsp;&nbsp;

    <div class="btn-group">
      <a class="btn btn-default"
         href="{{URL::to('/dash/formka1multi/view/'.$lka)}}">
          <span class="glyphicon glyphicon-th"></span>
          Semua
      </a>
      <a class="btn btn-default"
         href="{{URL::to('/dash/formka1multi/viewMe/'.$lka)}}">
          <span class="glyphicon glyphicon-user"></span>
          Kasus Saya
      </a>
    </div>



</div>
<br/>
<br/>
