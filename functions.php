<?php
error_reporting(~E_NOTICE);
session_start();
include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/paging.php';
include 'includes/saw_class.php';
include 'includes/wp_class.php';

function _post($key, $val = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];
    else
        return $val;
}

function _get($key, $val = null)
{
    global $_GET;
    if (isset($_GET[$key]))
        return $_GET[$key];
    else
        return $val;
}

function _session($key, $val = null)
{
    global $_SESSION;
    if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    else
        return $val;
}

$mod = _get('m');
$act = _get('act');

$rows = $db->get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row;
}
$rows = $db->get_results("SELECT kode_responden, nama_responden FROM tb_responden ORDER BY kode_responden");
foreach ($rows as $row) {
    $RESPONDEN[$row->kode_responden] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_crips ORDER BY kode_crips");
foreach ($rows as $row) {
    $CRIPS[$row->kode_crips] = $row;
}

$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria, atribut, bobot FROM tb_kriteria ORDER BY kode_kriteria");
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row;
}

function is_able($mod)
{
    $role = array(
        'admin' => array(
            'kriteria',
            'alternatif',
            'rekap',
            'wp',
			'responden',
			'hitung',
            'password',
            'logout',
        ),
        'kepsek' => array(
            // 'kriteria',
            // 'alternatif',
            'rekap',
            'hitung',
			 'wp',
            'password',
            'logout',
        ),
        'responden' => array(
            // 'alternatif',
            'nilai',
            'password',
            'logout',
        ),
        'guest' => array(
           // 'saw',
             'login',
            'daftar',
        ),
    );
    $level = strtolower(_session('level'));
    if (!$level) {
        $_SESSION['level'] = 'guest';
        $level = 'guest';
    }
    return in_array($mod, (array)$role[$level]);
}
function is_hidden($mod)
{
    return (is_able($mod)) ? '' : 'hidden';
}
function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $val) {
        $new[$key] = $no++;
    }
    return $new;
}

function get_nilai($kode_responden)
{
    global $db;
    $rows = $db->get_results("SELECT *  FROM tb_nilai WHERE kode_responden='$kode_responden' ORDER BY kode_alternatif, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_crips;
    }
    return $arr;
}

function get_rekap()
{
    global $db;
    $rows = $db->get_results("SELECT *  FROM tb_nilai ORDER BY kode_alternatif, kode_responden, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif][$row->kode_responden][$row->kode_kriteria] = $row->kode_crips;
    }
    return $arr;
}

function get_kriteria_option($selected = 0)
{
    global $KRITERIA;
    $a = '';
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_kriteria</option>";
        else
            $a .= "<option value='$key'>$val->nama_kriteria</option>";
    }
    return $a;
}

function get_alternatif_option($selected = "")
{
    global $ALTERNATIF;
    $a = '';
    foreach ($ALTERNATIF as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_alternatif</option>";
        else
            $a .= "<option value='$key'>$val->nama_alternatif</option>";
    }
    return $a;
}


function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    $a = '';
    foreach ($atribut as $key => $val) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function esc_field($str)
{
    if ($str)
        return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function tgl_indo($date)
{
    $tanggal = explode('-', $date);

    $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $bulan = $array_bulan[$tanggal[1] * 1];

    return $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0];
}
function get_crips_option($kode_kriteria, $selected = 0)
{
    global $CRIPS;
    $a = '';
    foreach ($CRIPS as $key => $val) {
        if ($val->kode_kriteria == $kode_kriteria) {
            if ($val->kode_crips == $selected)
                $a .= "<option value='$val->kode_crips' selected>$val->keterangan</option>";
            else
                $a .= "<option value='$val->kode_crips'>$val->keterangan</option>";
        }
    }
    return $a;
}
function set_msg($msg, $type = 'success')
{
    $_SESSION['message'] = array('msg' => $msg, 'type' => $type);
}

function show_msg()
{
    if (_session('message')) {
        print_msg($_SESSION['message']['msg'], $_SESSION['message']['type']);
        unset($_SESSION['message']);
    }
}
