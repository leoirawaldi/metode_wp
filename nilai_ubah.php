<div class="page-header">
    <h1>Ubah Penilaian</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="POST">
            <div class="form-group">
                <label>Alternatif <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_alternatif" disabled>
                    <?= get_alternatif_option(set_value('kode_alternatif', $_GET['ID'])) ?>
                </select>
            </div>
            <?php
            $rows = $db->get_results("SELECT * FROM tb_nilai WHERE kode_alternatif='$_GET[ID]' AND kode_responden='$_SESSION[id]' ORDER BY kode_kriteria");
            foreach ($rows as $row) : ?>
                <div class="form-group">
                    <label><?= $KRITERIA[$row->kode_kriteria]->nama_kriteria ?> <span class="text-danger">*</span></label>
                    <select class="form-control" name="kode_crips[<?= $row->ID ?>]">
                        <?= get_crips_option($row->kode_kriteria, $row->kode_crips) ?>
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