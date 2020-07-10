<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

	// membuat variabel untuk menampung data dari form
      $nis = $_POST['nis'];
      $nama = $_POST['nama'];
      $jns_kelamin = $_POST['jns_kelamin'];
      $tmp_lahir = $_POST['tmp_lahir'];
      $alamat = $_POST['alamat'];
      $kelas = $_POST['kelas'];
      $foto = $_FILES['foto']['name'];

  // $nama_produk   = $_POST['nama_produk'];
  // $deskripsi     = $_POST['deskripsi'];
  // $harga_beli    = $_POST['harga_beli'];
  // $harga_jual    = $_POST['harga_jual'];
  // $gambar_produk = $_FILES['gambar_produk']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($foto != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $foto); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['foto']['name'];   
  $angka_acak     = rand(1,999);
  $foto_baru = $angka_acak.'-'.$foto; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, 'gambar/'.$foto_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO siswa (nis, nama, jns_kelamin, tmp_lahir, tgl_lahir, alamat, kelas, foto) VALUES ('$nis', '$nama', '$jns_kelamin', '$tmp_lahir', '$tgl_lahir', '$alamat', '$kelas', '$foto')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_siswa.php';</script>";
            }
} else {
   $query = "INSERT INTO siswa (nis, nama, jns_kelamin, tmp_lahir, tgl_lahir, alamat, kelas, foto) VALUES ('$nis', '$nama', '$jns_kelamin', '$tgl_lahir', '$alamat', 'kelas', null)";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }
}

 

