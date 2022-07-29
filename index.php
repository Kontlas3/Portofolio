<?php

session_start();

// Membatasi Akses Login

if (!isset($_SESSION["login"])) {
  echo "<script>
  alert('Login Terlebih Dahulu');
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = 'Dashboard';

include 'config/app.php';

// mengambil data user
$data_user = mysqli_query($db, "SELECT * FROM user");

// menghitung data user
$jumlah_user = mysqli_num_rows($data_user);

// mengambil data akta
$data_akta = mysqli_query($db, "SELECT * FROM akta");

// menghitung data akta
$jumlah_akta = mysqli_num_rows($data_akta);

// mengambil data pernikahan
$data_pernikahan = mysqli_query($db, "SELECT * FROM pernikahan");

// menghitung data pernikahan
$jumlah_pernikahan = mysqli_num_rows($data_pernikahan);

// mengambil data kematian
$data_kematian = mysqli_query($db, "SELECT * FROM kematian");

// menghitung data kematian
$jumlah_kematian = mysqli_num_rows($data_kematian);

include "layout/header.php";

?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-file-medical"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Data Akta</h4>
            </div>
            <div class="card-body">
              <?php echo $jumlah_akta; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Data Pernikahan</h4>
            </div>
            <div class="card-body">
              <?php echo $jumlah_pernikahan; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-bed"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Data Kematian</h4>
            </div>
            <div class="card-body">
              <?php echo $jumlah_kematian; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Data User</h4>
            </div>
            <div class="card-body">
              <?php echo $jumlah_user; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-primary">
          <div class="card-header" style="height:10px;">
            <h4>Dinas Kependudukan dan Capil Kab. Luwu</h4>
          </div>
          <div class="card-header table-responsive" style="margin: auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15931.26415623898!2d120.3639911!3d-3.395036!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4330ea22bb55308a!2sDinas%20Kependudukan%20dan%20Capil%20Kab.%20Luwu!5e0!3m2!1sen!2sid!4v1657375583613!5m2!1sen!2sid" width="850" height="450" frameborder="0" style="border:0; margin:auto"></iframe>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Visi Misi</h4>
            <div class="card-header-action">
              <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
            </div>
          </div>
          <div class="collapse hide" id="mycard-collapse">
            <div class="card-body">
              <b>VISI</b> : Terciptanya Tertib Administrasi Kependudukan Berbasis Sistem Informasi Administrasi Kependudukan (SIAK) Melalui Pelayanan Prima<br><br>
              <p><b>MISI</b> : Mewujudkan Pelayanan Prima kepada masyarakat dalam bidang Administrasi Kepedudukan serta Catatan Sipil.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php

include "layout/footer.php";

?>