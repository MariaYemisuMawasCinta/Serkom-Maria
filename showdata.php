<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Home</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.html">Beasiswa</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="daftar.php">Daftar</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="showdata.php">Hasil</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container text-center p-5 mt-5">
      <h3>Data Beasiswa</h3>
    </div>

    <?php
    // Koneksi ke database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'serkom';

    $connect = mysqli_connect($host, $username, $password, $database);

    if (!$connect) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Mengambil data dari tabel
    $sql = "SELECT * FROM beasiswa";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      // menampilkan data pada halaman hasil
      //<!-- Table Hasil -->

    echo '<div class="container">';
        echo '<table class="table">';
            echo' <thead class="thead-dark">';
                echo '
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Semester</th>
                        <th scope="col">IPK</th>
                        <th scope="col">Jenis Beasiswa</th>
                        <th scope="col">Status</th>
                    </tr>';
            echo'</thead>';
            echo'<tbody>';
                while ($row = mysqli_fetch_assoc($result)) { // Melakukan iterasi melalui setiap baris hasil query dan menetapkan nilainya ke dalam $row
                    echo '<tr>'; // Mencetak tag pembuka <tr> untuk setiap baris tabel.
                    echo '<td>' . $row['MasukanNama'] . '</td>'; // Mencetak nilai dari kolom 'MasukanNama' di dalam tag <td>.
                    echo '<td>' . $row['MasukanEmail'] . '</td>'; // Mencetak nilai dari kolom 'MasukanEmail' di dalam tag <td>.
                    echo '<td>' . $row['NomorHP'] . '</td>'; // Mencetak nilai dari kolom 'NomorHP' di dalam tag <td>.
                    echo '<td>' . $row['smt'] . '</td>'; // Mencetak nilai dari kolom 'smt' di dalam tag <td>.
                    echo '<td>' . $row['ipk'] . '</td>'; // Mencetak nilai dari kolom 'ipk' di dalam tag <td>.
                    echo '<td>' . $row['beasiswa'] . '</td>'; // Mencetak nilai dari kolom 'beasiswa' di dalam tag <td>.
                    echo '<td>' . $row['status_ajuan'] . '</td>'; // Mencetak nilai dari kolom 'status_ajuan' di dalam tag <td>
                    echo '</tr>'; // Mencetak tag penutup </tr> untuk menyelesaikan baris saat ini
                }
            echo '</tbody>';
        echo '</table>';
    echo '</div>';
      

    } else {
        echo "Data tidak ditemukan";
    }

    // Mengambil data untuk grafik
    $data_beasiswa = mysqli_query($connect, "SELECT beasiswa FROM beasiswa GROUP BY beasiswa");
    $pendaftar = mysqli_query($connect, "SELECT COUNT(ipk) AS MasukanNama FROM beasiswa GROUP BY beasiswa");

    // menutup koneksi
    mysqli_close($connect);
    ?>


    <!-- Grafik -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card custom-card bg-white my-5">
                    <div class="card-body">
                        <canvas id="pendaftarChart" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- And Grafik -->
    

    <script>
    // Menambahkan event listener yang akan dieksekusi saat DOM telah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan konteks 2D dari elemen dengan id "pendaftarChart"
    var ctx = document.getElementById("pendaftarChart").getContext('2d');
    // Membuat objek Chart baru dengan konteks yang telah didapatkan sebelumnya
    var myChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik yang akan digunakan adalah bar
        data: { // Data untuk grafik
                    labels: [<?php while($row = mysqli_fetch_array($data_beasiswa)){echo '"'.$row['beasiswa'].'",';}?>], // Label untuk sumbu x, diambil dari hasil query PHP $data_beasiswa
                    // Data pendaftar, diambil dari hasil query PHP $pendaftar
                    datasets: [{
                        label: 'Jumlah Pendaftar', // Data jumlah pendaftar, diambil dari hasil query PHP $pendaftar
                        data: [<?php while($row = mysqli_fetch_array($pendaftar)){echo $row['MasukanNama'].',';}?>],
                        // Warna latar belakang batang
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                        ],
                        borderWidth: 2 // Lebar garis batas
                    }]
                },
                options: { // Opsi konfigurasi grafik
                    scales: {  // Konfigurasi skala sumbu y, dimulai dari nilai nol
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true, // Grafik responsif
                    maintainAspectRatio: false, // Memelihara rasio aspek
                    aspectRatio: 3, // Rasio aspek yang diinginkan
                    // Konfigurasi plugin, dalam hal ini, menonaktifkan tampilan legenda
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
