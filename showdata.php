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
                    echo '<tr>';
                    echo '<td>' . $row['MasukanNama'] . '</td>';
                    echo '<td>' . $row['MasukanEmail'] . '</td>';
                    echo '<td>' . $row['NomorHP'] . '</td>';
                    echo '<td>' . $row['smt'] . '</td>';
                    echo '<td>' . $row['ipk'] . '</td>';
                    echo '<td>' . $row['beasiswa'] . '</td>';
                    echo '<td>' . $row['status_ajuan'] . '</td>';
                    echo '</tr>';
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
    document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("pendaftarChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
                    labels: [<?php while($row = mysqli_fetch_array($data_beasiswa)){echo '"'.$row['beasiswa'].'",';}?>],
                    datasets: [{
                        label: 'Jumlah Pendaftar',
                        data: [<?php while($row = mysqli_fetch_array($pendaftar)){echo $row['MasukanNama'].',';}?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 3,
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
