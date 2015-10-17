<div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo URL::to("images/user.png"); ?>"
             class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>Hai, {{Auth::user()->username}}</p>
        <p>{{ucfirst(Auth::user()->level)}}</p>
    </div>
</div>
