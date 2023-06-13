<style type="text/css">
<!--
.style2 {font-size: 14px; font-family: "Times New Roman", Times, serif;}
-->
</style>
<div class="page-header">
    <h1>Permintaan Password Baru  |<span class="style2"> pastikan alamat email anda benar dan terdaftar pada kami</span></h1>
</div>
<div class="row">
    <div class="col-md-4">
        <?php if ($_POST) include 'aksi.php'; ?>
        <form method="post">
            <div class="form-group">
                <label>Masukan Email Anda: </label>
                <input type="text" class="form-control" placeholder="email" name="user" autofocus />
            </div>
            <div class="form-group">
                <label></label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-log-in"></span> Kirim </button>
            </div>
        </form>
    </div>
</div>