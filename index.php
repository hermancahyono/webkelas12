<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CRUD SISWA</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
      }
    table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: salmon;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    </style>
  </head>
  <body>
    <center><h1>Data siswa</h1><center>
    <center><a href="tambah_siswa.php">+ &nbsp; Tambah Siswa</a><center>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>NIS</th>
          <th>Nama siswa</th>
          <th>jenis kelamin</th>
          <th>tempat lahir</th>
          <th>tanggal lahir</th>
          <th>Alamat</th>
          <th>kelas</th>
          <th>gambar</th>
          <th>action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM siswa ORDER BY nis ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nis']; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['jns_kelamin']; ?></td>
          <td><?php echo $row['tmp_lahir']; ?></td>
          <td><?php echo $row['tgl_lahir']; ?></td>
          <td><?php echo $row['alamat']; ?></td>
          <td><?php echo $row['kelas']; ?></td>

        
          <td style="text-align: center;"><img src="gambar/<?php echo $row['foto']; ?>" style="width: 100px;"></td>
          <td>
              <a href="edit_siswa.php?id=<?php echo $row['id']; ?>">Edit</a> |
              <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //autoincrement agar nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
  </body>
</html>