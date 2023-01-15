<?php
include 'backend/database.php';

//uri untuk mengakses webhservice
$opt = [
    "location" => "http://www.server1.com/soapServer.php",
    "uri" => "http://www.server1.com/", "trace" => 1
];
//membaca API
$api = new SoapClient(NULL, $opt);
$data = json_decode($api->ambilData());
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Buku</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="ajax/ajax.js"></script>
    <style>
        .bg {
            background-image: url(img/perpus.jpg);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            text-shadow: 2px 2px 2px black;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Annisa Kinanti</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="profil.php">Profil</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- Akhir Navbar -->
        <div class="jumbotron bg">
            <h1>Manajemen Buku Perpustakaan</h2>
                <p>Create, Read, Update, Delete</p>
                <p>
                    <!-- tombol untuk menambahkan data -->
                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Tambah</span></a>
                    <!-- tombol untuk menghapus data -->
                    <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><span>Hapus</span></a>
                </p>
        </div>

        <!-- tabel untuk membaca data -->
        <table class="table danger table-hover ">
            <thead>
                <tr class="danger">
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll"></label>
                        </span>
                    </th>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <!-- query untuk mengambil data dari database -->
                <?php
                $i = 1;

                foreach ($data as $d) {
                ?>
                    <tr id="<?php echo $d->id; ?>" class="info">
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox" data-user-id="<?php echo $d->id; ?>">
                                <label for="checkbox2"></label>
                            </span>
                        </td>
                        <td><?php echo $d->id; ?></td>
                        <td><?php echo $d->judul; ?></td>
                        <td><?php echo $d->pengarang ?></td>
                        <td><?php echo $d->penerbit ?></td>
                        <td><?php echo $d->tahun_terbit ?></td>
                        <td><?php echo $d->deskripsi ?></td>
                        <td>

                            <!-- mengirimkan data ID ke kelas edit -->
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                                <i class="material-icons update" data-toggle="tooltip" data-id="<?php echo $d->id; ?>" data-judul="<?php echo $d->judul; ?>" data-pengarang="<?php echo $d->pengarang; ?>" data-penerbit="<?php echo $d->penerbit ?>" data-tahun_terbit="<?php echo $d->tahun_terbit; ?>" data-deskripsi="<?php echo $d->deskripsi ?>" title="Edit"></i>
                            </a>

                            <!-- mengirimkan data ID ke kelas delete -->
                            <a href="#deleteEmployeeModal" class="delete text-danger" data-id="<?php echo $d->id; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>


    </div>
    <!-- Modal untuk menambhakan data baru -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="user_form">
                    <div class="modal-header">

                        <!-- animasi jquery -->
                        <div id="animasi"></div>

                        <h4 class="modal-title">Tambah Buku</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="judul" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" id="pengarang" name="pengarang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" id="penerbit" name="penerbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" id="tahun_terbit" name="tahun_terbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class=" form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="1" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-success" id="btn-add">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk edit data -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="update_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Buku</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_u" name="id" class="form-control" required>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="judul_u" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" id="pengarang_u" name="pengarang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" id="penerbit_u" name="penerbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" id="tahun_terbit_u" name="tahun_terbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi_u" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="2" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-primary" id="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk delete data -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_d" name="id" class="form-control">
                        <p>Apakah Anda yakin akan menghapus data ini?</p>
                        <p class="text-warning"><small>Aksi ini tidak bisa dikembalikan</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-danger" id="delete">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        // jquery untuk menampilkan animasi
        $('a').click(function() {
            $('#animasi').load('animated.php').fadeIn(1500);
            setTimeout(function() {
                $('#animasi').hide('slow').slideUp(1000);
            }, 2500);

        });
    </script>
</body>

</html>