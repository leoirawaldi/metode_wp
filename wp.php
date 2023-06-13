<?php
$time_start = microtime(true);
?>
<div class="page-header">
    <h1>Perhitungan WP</h1>
</div>
<?php
$rekap = get_rekap();
$arr = array();
foreach ($rekap as $key => $val) {
    foreach ($val as $k => $v) {
        foreach ($v as $a => $b) {
            $arr[$key][$a][$k] = $CRIPS[$b]->nilai;
        }
    }
}
$data = array();
foreach ($arr as $key => $val) {
    foreach ($val as $k => $v) {
        $data[$key][$k] = array_sum($v) / count($v);
    }
}
foreach ($KRITERIA as $key => $val) {
    $atribut[$key] = $val->atribut;
    $bobot[$key] = $val->bobot;
}
$wp = new WP($data, $atribut, $bobot);
//echo '<pre>' . print_r($wp, 1) . '</pre>';
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Kriteria</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Bobot</th>
                    <th>Normal</th>
                    <th>Pangkat</th>
                </tr>
            </thead>
            <?php foreach ($KRITERIA as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $val->nama_kriteria ?></td>
                    <td><?= $wp->bobot[$key] ?></td>
                    <td><?= round($wp->bobot_normal[$key], 3) ?></td>
                    <td><?= round($wp->bobot_pangkat[$key], 3) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Rekap Penilaian</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Responden</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rekap as $key => $val) : ?>
                <?php foreach ($val as $k => $v) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                        <td><?= $RESPONDEN[$k]->nama_responden ?></td>
                        <?php foreach ($v as $a => $b) : ?>
                            <td><?= $CRIPS[$b]->keterangan ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nilai</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Responden</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rekap as $key => $val) : ?>
                <?php foreach ($val as $k => $v) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                        <td><?= $RESPONDEN[$k]->nama_responden ?></td>
                        <?php foreach ($v as $a => $b) : ?>
                            <td><?= $CRIPS[$b]->nilai ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Rata Nilai</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($data as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Normalisasi</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($wp->normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 3) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perangkingan</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Vektor S</th>
                    <th>Vektor V</th>
            </thead>
            <?php
            $rank = get_rank($wp->vektor_v);
            foreach ($rank as $key => $val) : ?>
                <tr>
                    <td><?= $val ?></td>
                    <td><?= $key ?></td>
                    <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                    <td><?= round($wp->vektor_s[$key], 3) ?></td>
                    <td><?= round($wp->vektor_v[$key], 3) ?></td>
                </tr>
            <?php endforeach;
            $total = array_sum($wp->vektor_v);
            $rata = $total / count($wp->vektor_v);
            ?>
        </table>
  </div>
    <div class="panel-body">
        <a class="btn btn-default" target="_blank" href="cetak.php?m=wp"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
    <div class="panel-footer">
        <?php
        $time_end = microtime(true);
        $time = $time_end - $time_start;

        /**
         * menampilan hasil algoritma
         */
        echo "<pre>";
        echo "\nExecution Time: $time seconds";
        echo "\nMemory Usage: " . memory_get_usage() / 1024 . " kilo bytes</pre>";
        ?>
    </div>
</div>