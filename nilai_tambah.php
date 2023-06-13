<div class="page-header">
    <h1>Tambah Penilaian</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="POST">
            <div class="form-group">
                <label>Alternatif <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_alternatif">
                    <?= get_alternatif_option(set_value('kode_alternatif')) ?>
                </select>
            </div>
            <?php foreach ($KRITERIA as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val->nama_kriteria ?> <span class="text-danger">*</span></label>
                    <select class="form-control" name="kode_crips[<?= $key ?>]">
                        <?= get_crips_option($key, $_POST['kode_crips'][$key]) ?>
                    </select>
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=nilai"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>