<?php
// Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud2022";

// Buat koneksi 
$koneksi = mysqli_connect($server, $user, $password, $database);

// Periksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses Input Form
if (isset($_POST['bsimpan'])) {
    $kode = mysqli_real_escape_string($koneksi, $_POST['tkode']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['tnama']);
    $vendor = mysqli_real_escape_string($koneksi, $_POST['tvendor']);
    $asal = mysqli_real_escape_string($koneksi, $_POST['tasal']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['tjumlah']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['tsatuan']);
    $tanggal_diterima = mysqli_real_escape_string($koneksi, $_POST['ttanggal_diterima']);

    $query = "INSERT INTO tbarang (kode, nama, vendor, asal, jumlah, satuan, tanggal_diterima) VALUES ('$kode', '$nama', '$vendor', '$asal', '$jumlah', '$satuan', '$tanggal_diterima')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data gagal disimpan: " . mysqli_error($koneksi) . "');</script>";
    }
}

// Proses Pencarian Data
$cari = '';
if (isset($_POST['bcari'])) {
    $cari = mysqli_real_escape_string($koneksi, $_POST['tcari']);
}

// Proses Reset Pencarian Data
if (isset($_POST['breset'])) {
    $cari = '';
}

// Query untuk menampilkan data
$query = "SELECT * FROM tbarang WHERE kode LIKE '%$cari%' OR nama LIKE '%$cari%' OR vendor LIKE '%$cari%' ORDER BY id_barang DESC";
$tampil = mysqli_query($koneksi, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Awal container -->
    <div class="container">
        <h3 class="text-center">Data Inventaris</h3>
        <h3 class="text-center">Kantor Ngodingpintar</h3>

        <!-- Awal row -->
        <div class="row">
            <!-- Awal col -->
            <div class="col-md-8 mx-auto">
                <!-- Awal card -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Form Input Data Barang
                    </div>
                    <div class="card-body">
                        <!-- Awal form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" class="form-control" placeholder="Masukkan Kode Barang">
                            </div> 

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" class="form-control" placeholder="Masukkan Nama Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Vendor</label>
                                <input type="text" name="tvendor" class="form-control" placeholder="Masukkan Vendor">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Barang</label>
                                <select class="form-select" name="tasal">
                                    <option>-Pilih-</option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Bantuan">Bantuan</option>
                                    <option value="Sumbangan">Sumbangan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" class="form-control" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan">
                                            <option>-Pilih-</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Pcs">Pcs</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Diterima</label>
                                        <input type="date" name="ttanggal_diterima" class="form-control">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                    <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                                </div>
                            </div>
                        </form>
                        <!-- Akhir form -->
                    </div>
                    <div class="card-footer bg-info text-white">
                    </div>
                </div>
                <!-- Akhir card -->
            </div>
            <!-- Akhir col -->
        </div>
        <!-- Akhir row -->

        <!-- Awal card -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                Data Barang
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukkan kata kunci!" value="<?php echo htmlspecialchars($cari); ?>">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Vendor</th>
                        <th>Asal Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Diterima</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    // Menampilkan data
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($tampil)):
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['kode']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['vendor']); ?></td>
                            <td><?php echo htmlspecialchars($data['asal']); ?></td>
                            <td><?php echo htmlspecialchars($data['jumlah']); ?> <?php echo htmlspecialchars($data['satuan']); ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal_diterima']); ?></td>
                            <td>
                                <a href="#" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="card-footer bg-info text-white">
            </div>
        </div>
        <!-- Akhir card -->
    </div>
    <!-- Akhir container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcId" crossorigin="anonymous"></script>
</body>
</html>
