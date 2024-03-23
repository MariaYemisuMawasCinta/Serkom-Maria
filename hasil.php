<!DOCTYPE html> 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

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
            <li class="nav-item">
              <a class="nav-link" href="showdata.php">Hasil</a> 
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <?php
        // mengambil data dari form
        $MasukanNama = $_POST['MasukanNama'];
        $MasukanEmail = $_POST['MasukanEmail'];
        $NomorHP = $_POST['NomorHP'];
        $smt  = $_POST['smt'];
        $ipk = $_POST['ipk'];
        $beasiswa   = $_POST['beasiswa'];
        $status = $_POST['status_ajuan'];

        // membuat koneksi ke database
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'serkom';

        $koneksi = mysqli_connect($host, $username, $password, $database);

        // memasukkan data ke dalam tabel

        $sql = "INSERT INTO beasiswa VALUES ('$MasukanNama', '$MasukanEmail', '$NomorHP','$smt','$ipk','$beasiswa','$status')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            echo '
            <div class="p-5">
                <div class="container alert alert-warning alert-dismissible fade show w-50 mt-5" role="alert">
                    Data berhasil dikirim.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            ';
        } else {
            echo '
            <div class="p-5">
                <div class="container alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan: ' . mysqli_error($koneksi) . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            ';
        }
  
    // menutup koneksi
    mysqli_close($koneksi);
    ?>

    <!-- Card -->
    <div class="container p-3 mb-5">
      <div class="card custom-card">
        <div class="p-5">
          <h3 class="text-center mb-4">Hasil Form Pendaftaran</h3>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>Nama:</th>
                  <td><?= $_POST['MasukanNama'] ?></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td><?= $_POST['MasukanEmail'] ?></td>
                </tr>
                <tr>
                  <th>Nomor HP:</th>
                  <td><?= $_POST['NomorHP'] ?></td>
                </tr>
                <tr>
                  <th>Semester:</th>
                  <td><?= $_POST['smt'] ?></td>
                </tr>
                <tr>
                  <th>IPK:</th>
                  <td><?= $_POST['ipk'] ?></td>
                </tr>
                <tr>
                  <th>Beasiswa:</th>
                  <td><?= $_POST['beasiswa'] ?></td>
                </tr>
                <tr>
                  <th>Status Ajuan:</th>
                  <td><?= $_POST['status_ajuan'] ?></td>
                </tr>
                <tr>
                  <th>File Berkas:</th>
                  <td><?php 
                        // var_dump(count($_FILES['data']['name']));
                        $folder = "assets/uploads";
                        if(!is_dir($folder)){
                            mkdir($folder, 0777, $rekursif = true);
                        }
                        for($i = 0; $i<count($_FILES['data']['name']); $i++){
                            // echo $_FILES['data']['name'][$i];

                            $tmp = $_FILES["data"]["tmp_name"][$i];
                            $filename = $_FILES["data"]["name"][$i];
                            $location = $folder.'/'.$filename;

                            $proses_up = move_uploaded_file($tmp, $location);

                            echo '<a href="'
                            .$location.
                            '" target="_blank">'.$filename.'</a> ';

                            echo "<br>";

                            if($proses_up){

                            }
                        }
                      ?>
                 </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
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
