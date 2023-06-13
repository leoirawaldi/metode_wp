<?php
$time_start = microtime(true);
?>
<style type="text/css">
<!--
.style1 {	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 24px;
}
.style2 {font-size: 22px}
.style5 {font-size: 12}
.style6 {font-size: 16px}
.style9 {font-size: 12px}
.style10 {font-size: 24px}
-->
</style>

<div class="page-header">
    <table width="1158" height="139" border="0">
      <tr>
        <td width="166" height="135"><img src="favicon.jpg" alt="" width="142" height="133" /></td>
        <td width="982" valign="top"><div align="center" class="style1">
          <p> YAYASAN PENDIDIKAN PPM SHADR EL-ISLAM ASAHAN
            <span class="style10">&nbsp;</span><br />
            SMKS PPM SHADR EL-ISLAM ASAHAN<br />
            <span class="style9"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jalan Sei Dua Dusun III NO : 49 &nbsp;Telp.081361755610 Email : </em><a href="mailto:mtsnuruliman88@yahoo.co.id"><em>mtsnuruliman88@yahoo.co.id</em></a><br />
            <em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</em>&nbsp;Desa Sipaku Area Kec. Simpang Empat Kab. Asahan &ndash;  Sumut Kode Pos : 21271</span><br />
            <span class="style9">&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;</span><br />
          </p>
        </div></td>
      </tr>
  </table>
  </div>
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
<p align="center"><strong>HASIL LAPORAN PENILAIAN  KINERJA GURU DALAM KEGIATAN SUPERVISI PEMBELAJARAN SMKS PPM SHADR EL-ISLAM ASAHAN</strong></p>
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
        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style5">Air Batu<span class="style6"></span></span><span class="style6">,
        <?php $tgl=date('d-m-Y'); echo $tgl; ?>
        </span>        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diketahui Kepala Sekolah<br />
      </p>
      <p align="center" class="style2">&nbsp;</p>
      <p align="center" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Abdullah Margolang S.pd, S.Kom</strong></p>
      <p>&nbsp;</p>
  </div>
  </div>
</div>