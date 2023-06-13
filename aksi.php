<?php
require_once 'functions.php';
/** LOGIN **/
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_responden WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        $_SESSION['level'] = 'responden';
        $_SESSION['id'] = $row->kode_responden;
        redirect_js("index.php");
    } else {
        $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
        if ($row) {
            $_SESSION['login'] = $row->user;
            $_SESSION['level'] = $row->level;
            redirect_js("index.php");
        } else {
            print_msg("Salah kombinasi username dan password.");
        }
    }
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login'], $_SESSION['level'], $_SESSION['id']);
    header("location:index.php");
} elseif ($mod == 'daftar') {
    $nama_responden = $_POST['nama_responden'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if ($nama_responden == '' || $alamat == '' || $telpon == '' || $user == '' || $pass == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_responden WHERE user='$user'"))
        print_msg("User sudah ada!");
    else {
        $kode_responden = kode_oto('kode_responden', 'tb_responden', 'A', 3);
        $db->query("INSERT INTO tb_responden (kode_responden, nama_responden, alamat, telpon, user, pass) 
            VALUES ('$kode_responden', '$nama_responden', '$alamat', '$telpon', '$user', '$pass')");
        alert('Pendaftaran berhasil, silahkan login untuk melanjutkan!');
        redirect_js("index.php?m=login");
    }
} else if ($mod == 'profil') {
    $nama_responden = $_POST['nama_responden'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $user = $_POST['user'];

    if ($nama_responden == '' || $alamat == '' || $telpon == '' || $user == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_responden WHERE user='$user' AND kode_responden<>'$_SESSION[id]'"))
        print_msg("User sudah ada!");
    else {
        $db->query("UPDATE tb_responden SET nama_responden='$nama_responden', alamat='$alamat', telpon='$telpon', user='$user' WHERE kode_responden='$_SESSION[id]'");

        foreach ($_POST['kode_crips'] as $key => $val) {
            $db->query("UPDATE tb_rel_responden SET kode_crips='$val' WHERE ID='$key'");
        }

        set_msg('Profil berhasil disimpan!');
        redirect_js('index.php?m=profil');
    }
}else if ($act == 'responden_hapus') {
    $db->query("DELETE FROM tb_responden WHERE kode_responden='$_GET[ID]'");
    header("location:index.php?m=responden");
}
/** ALTERNATIF */
elseif ($mod == 'alternatif_tambah') {
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $keterangan = $_POST['keterangan'];
    if ($kode_alternatif == '' || $nama_alternatif == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode_alternatif'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif, keterangan) VALUES ('$kode_alternatif', '$nama_alternatif', '$keterangan')");
        redirect_js("index.php?m=alternatif");
    }
} else if ($mod == 'alternatif_ubah') {
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $keterangan = $_POST['keterangan'];
    if ($kode_alternatif == '' || $nama_alternatif == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_alternatif SET nama_alternatif='$nama_alternatif', keterangan='$keterangan' WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }
} else if ($act == 'alternatif_hapus') {
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
}

/** KRITERIA */
elseif ($mod == 'kriteria_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];

    if ($kode_kriteria == '' || $nama_kriteria == '' || $atribut == '' || $bobot == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($bobot > 100)
        print_msg("Maksimal bobot 100!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, atribut, bobot) VALUES ('$kode_kriteria', '$nama_kriteria', '$atribut', '$bobot')");

        foreach ($db->get_results("SELECT kode_alternatif, kode_responden FROM tb_nilai GROUP BY kode_alternatif, kode_responden") as $row) {
            $db->query("INSERT INTO tb_nilai(kode_alternatif, kode_responden, kode_kriteria) VALUES('$row->kode_alternatif', '$row->kode_responden', '$kode_kriteria')");
        }
        redirect_js("index.php?m=kriteria");
    }
} else if ($mod == 'kriteria_ubah') {
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];

    if ($nama_kriteria == '' || $atribut == '' || $bobot == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($bobot > 100)
        print_msg("Maksimal bobot 100!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("UPDATE tb_kriteria SET nama_kriteria='$nama_kriteria', atribut='$atribut', bobot='$bobot' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }
} else if ($act == 'kriteria_hapus') {
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_crips WHERE kode_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_nilai WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
}

/** crips */
elseif ($mod == 'crips_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    if ($kode_kriteria == '' || $nilai == '' || $keterangan == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_crips (kode_kriteria, nilai, keterangan) VALUES ('$kode_kriteria', '$nilai', '$keterangan')");
        redirect_js("index.php?m=crips");
    }
} else if ($mod == 'crips_ubah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    if ($kode_kriteria == '' || $nilai == '' || $keterangan == '')
        print_msg("Nilai dan nama tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_crips SET kode_kriteria='$kode_kriteria', nilai='$nilai', keterangan='$keterangan' WHERE kode_crips='$_GET[ID]'");
        redirect_js("index.php?m=crips");
    }
} else if ($act == 'crips_hapus') {
    $db->query("DELETE FROM tb_crips WHERE kode_crips='$_GET[ID]'");
    header("location:index.php?m=crips");
}

/** RELASI ALTERNATIF */
else if ($mod == 'nilai_tambah') {
    $kode_alternatif = $_POST['kode_alternatif'];
    $kode_crips = $_POST['kode_crips'];
    $kode_responden = $_SESSION['id'];

    if (
        $kode_alternatif == ''
    ) {
        print_msg('Field bertanda * tidak boleh kosong!');
    } else if ($db->get_row("SELECT * FROM tb_nilai WHERE kode_responden='$kode_responden' AND kode_alternatif='$kode_alternatif'")) {
        print_msg('Anda sudah memberikan penilaian untuk alternatif ini!');
    } else {
        foreach ($kode_crips as $key => $val) {
            $db->query("INSERT INTO tb_nilai (kode_alternatif, kode_responden, kode_kriteria, kode_crips) VALUES ('$kode_alternatif', '$kode_responden', '$key', '$val')");
        }
        set_msg('Penilaian berhasil!');
        redirect_js("index.php?m=nilai");
    }
} else if ($mod == 'nilai_ubah') {
    $kode_crips = $_POST['kode_crips'];
    foreach ($kode_crips as $key => $val) {
        $db->query("UPDATE tb_nilai SET kode_crips='$val' WHERE ID='$key'");
    }
    set_msg('Ubah Penilaian Berhasil!');
    redirect_js("index.php?m=nilai");
} else if ($act == 'nilai_hapus') {
    $db->query("DELETE FROM tb_nilai WHERE kode_alternatif='$_GET[ID]' AND kode_responden='$_SESSION[id]'");
    set_msg('Hapus Penilaian Berhasil!');
    header("location:index.php?m=nilai");
}
