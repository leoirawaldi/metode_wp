<?php
$time_start = microtime(true);
?>
<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 18px;
}
-->
</style>
<p>
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
</p>
<p align="center" class="style1">HASIL LAPORAN PENILAIAN KINERJA GURU SMK NEGERI 1 SETIA JANJI</p>
<div class="panel panel-primary"><div class="panel-heading"></div>
    <div class="table-responsive">
        <table align="center" class="table table-bordered table-striped table-hover">
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
        <p>&nbsp;</p>

</div>