<style>
.profile {
  font-size: 16px;
}
</style>

<div class="card mb-3" style="margin-top: 15px">
    <div class="card-header" style="text-align:center">
        <b>
            PROFILE
        </b>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-2 text-center">
                 <div class="card">
                    <img class="card-img-top" src="assets/img/Darwhin.png" style="width:100%">
                </div>
                <?php if ($user->user_id == $SESSION_USER_ID) { ?>
                    <button class="btn btn-success btn-sm" id="btn_edit" style="margin-top: 15px">
                        <i class="far fa-edit"></i> Change Photo
                    </button>
                <?php } ?>
            </div>
            
            <div class="col-sm-2">
                <table class="profile">
                    <tr>
                        <td >Nama</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                    </tr>
                </table>
            </div>

            <div class="col-sm-5">
                <table class="profile">
                    <tr>
                        <td> : <?php echo $user->nama; ?> </td>
                    </tr>
                    <tr>
                        <td> : <?php echo $user->nik; ?> </td>
                    </tr>
                    <tr>
                        <?php if (!empty($user->no_hp)) { ?>
                            <td> : <?php echo $user->no_hp ?> </td>
                        <?php } else { ?>
                            <td> : <?php echo "-"?> </td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td> : <?php echo $user->email; ?> </td>
                    </tr>
                </table>
            
            </div>

        </div>
    </div>
</div>
