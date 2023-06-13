<!-- Form pendaftaran user baru-->
<div class="page-header">
    <h1>Daftar Responden</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_responden" value="<?= set_value('nama_responden') ?>" />
            </div>
            <div class="form-group">
                <label>Kelas <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat') ?>" />
            </div>
            <div class="form-group">
                <label>Telpon <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="telpon" value="<?= set_value('telpon') ?>" />
            </div>
            <div class="form-group">
                <label> Username <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="user" value="<?= set_value('user') ?>" />
            </div>
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass" value="<?= set_value('pass') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=diagnosa"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>