<div class="page-header">
    <h1>Rekap Penilaian Alternatif</h1>
</div>
<?= show_msg() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="rekap" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>Responden</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php

            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_nilai n INNER JOIN tb_alternatif a ON a.kode_alternatif=n.kode_alternatif INNER JOIN tb_responden r ON r.kode_responden=n.kode_responden WHERE  a.kode_alternatif LIKE '%$q%' OR nama_alternatif LIKE '%$q%' OR keterangan LIKE '%$q%' GROUP BY a.kode_alternatif, r.kode_responden");
            $rekap = get_rekap($_SESSION['id']);

            foreach ($rows as $row) :  ?>
                <tr>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td><?= $row->nama_responden ?></td>
                    <?php foreach ($rekap[$row->kode_alternatif][$row->kode_responden] as $k => $v) : ?>
                        <td><?= $CRIPS[$v]->keterangan ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>