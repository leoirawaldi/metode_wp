<div class="page-header">
    <h1>Penilaian Alternatif</h1>
</div>
<?= show_msg() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="nilai" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=nilai_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php

            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_alternatif 
                WHERE 
                    kode_alternatif LIKE '%$q%'
                    OR nama_alternatif LIKE '%$q%'
                    OR keterangan LIKE '%$q%'  
                ORDER BY kode_alternatif");
            $nilai = get_nilai($_SESSION['id']);

            foreach ($rows as $row) : if (!$nilai[$row->kode_alternatif]) continue ?>
                <tr>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif; ?></td>
                    <?php foreach ($nilai[$row->kode_alternatif] as $k => $v) : ?>
                        <td><?= $CRIPS[$v]->keterangan ?></td>
                    <?php endforeach ?>
                    <td>
                        <a class="btn btn-xs btn-warning" href="?m=nilai_ubah&ID=<?= $row->kode_alternatif ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=nilai_hapus&ID=<?= $row->kode_alternatif ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>