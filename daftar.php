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
            <li class="nav-item active">
              <a class="nav-link" href="daftar.php">Daftar</a> 
            </li>
            <li class="nav-item">
              <a class="nav-link" href="showdata.php">Hasil</a> 
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container text-center p-5 mt-5">
      <h3>Form Pendaftaran</h3>
    </div>

    <!-- Form Daftar -->
    <div id="FormDaftar" class="container mb-5">
      <div class="card custom-card">
        <div class="p-5">
          <form action="hasil.php" method="post" enctype="multipart/form-data">
            <div class="form-group d-flex justify-content-between">
              <label for="exampleInputNama">Masukkan Nama</label>
              <input
                type="text"
                class="form-control"
                name="MasukanNama" 
                id= "MasukanNama"
                required
                placeholder="Enter Nama"
              />
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleInputEmail1">Email address</label>
              <input
                type="email"
                class="form-control"
                name="MasukanEmail"
                required
                placeholder="Enter email"
              />
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleInputNomorHP">Nomor HP</label>
              <input
                type="number"
                class="form-control"
                name="NomorHP" 
                onchange="console.log(this.value)"
                required
                placeholder="Enter NomorHP"
              />
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleFormControlSelect1" id="form-pilih"
                >Semester saat ini</label>
              <select
                name="smt"
                class="form-control"
                id=""
                onchange="semester(this)"
                required
              > 
                <option value="0">-- Pilih --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleInputIPK">IPK Terakhir</label> 
              <input
                type="text"
                class="form-control"
                id="ipk"
                name="ipk"
                readonly
              />
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleFormControlSelect2" id="form-pilih"
                >Pilihan Beasiswa</label> 
              <select
                class="form-control"
                name="beasiswa"
                id="beasiswa"
                required
                disabled="false"
              >
                <option value="">-- Pilih --</option>
                <option value="Beasiswa Akademik">Beasiswa Akademik</option>
                <option value="Beasiswa Non-Akademik">
                  Beasiswa Non-Akademik
                </option>
                <option value="Beasiswa Bidikmisi">Beasiswa Bidikmisi</option>
              </select>
            </div>
            <div class="form-group d-flex justify-content-between">
              <label for="exampleFormControlFile1">Upload Berkas</label>
              <input
                name="data[]"
                type="file"
                class="form-control-file"
                id="berkas"
                required
                accept="application/pdf/png/jpg"
                disabled="false"
              />
            </div>
            <!--status ajuan-->
            <div class="form-group">
              <input
                type="text"
                name="status_ajuan"
                hidden
                value="belum diverifikasi"
              />
            </div>
            <div class="d-flex justify-content-between">
              <button
                id="btnSubmit"
                type="submit"
                class="btn btn-primary"
                disabled="false"
              >
                Daftar
              </button>
              <a class="btn btn-danger" href="daftar.html">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Form Daftar -->

    <script>
      /*
      Fungsi semester(smt) mengambil satu argumen smt yang merupakan objek.
      Pada kode ini, smt diharapkan adalah elemen input yang mewakili semester yang dipilih pengguna.
      Nilai-nilai IPK yang mungkin telah diprediksi sebelumnya disimpan dalam array nilai.
      Kemudian, fungsi ini mencoba mengambil IPK sesuai dengan semester yang dipilih oleh pengguna dari array nilai.
      Jika smt bukan nol (artinya pengguna telah memilih semester),
      nilai IPK yang sesuai ditampilkan di dalam elemen input dengan id #ipk,
      dan kemudian dipanggil fungsi checkIpk() dengan nilai IPK sebagai argumen.
      */
      function semester(smt) {
        const nilai = [2.4, 3.5, 3.0, 2.5, 3.4, 1.8, 3.8, 3.1]; // Array nilai IPK 
        const ipk = nilai[smt.value - 1]; // Mengambil IPK dari array berdasarkan nilai semester yang dipilih

        if (smt.value != 0) { // Memeriksa apakah pengguna telah memilih semester (tidak 0)
          document.querySelector("#ipk").value = ipk; // Menampilkan IPK di elemen input dengan id #ipk
          checkIpk(ipk); // Memanggil fungsi checkIpk() dengan IPK sebagai argumen
        } else {
          document.querySelector("#ipk").value = ""; // Jika tidak memilih semester, mengosongkan input IPK
        }
      }

      // Fungsi checkIpk(ipkku) digunakan untuk memeriksa apakah IPK yang diberikan melebihi 3.
      function checkIpk(ipkku) {
        if (ipkku > 3) { // Memeriksa apakah IPK melebihi 3
          document.querySelector("#beasiswa").disabled = false; // Mengaktifkan elemen beasiswa
          document.querySelector("#beasiswa").focus(); // Fokus ke elemen beasiswa
          document.querySelector("#berkas").disabled = false; // Mengaktifkan elemen berkas
          document.querySelector("#btnSubmit").disabled = false; // Mengaktifkan tombol submit
        } else {
          document.querySelector("#beasiswa").disabled = true; // Menonaktifkan elemen beasiswa
          document.querySelector("#berkas").disabled = true; // Menonaktifkan elemen berkas
          document.querySelector("#btnSubmit").disabled = true; // Menonaktifkan tombol submit
        }
      }
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
