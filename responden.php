<div class="page-header">
    <h1>Nama Responden</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Responden</th>
                    <th>Kelas</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_responden
                WHERE 
                    kode_responden LIKE '%$q%'
                    OR nama_responden LIKE '%$q%'
                    OR alamat LIKE '%$q%' 
					   OR telpon LIKE '%$q%'  
                ORDER BY kode_responden");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $row->kode_responden ?></td>
                    <td><?= $row->nama_responden ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->telpon ?></td>
                    <td><a class="btn btn-xs btn-danger" href="aksi.php?act=responden_hapus&ID=<?= $row->kode_responden ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a></td>
          </tr>
            <?php endforeach ?>
        </table>
  </div>
</div>