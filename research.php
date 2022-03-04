<!DOCTYPE html>
<?php
    include 'classes/research.php';
    $obj = new Research();
    $data = $obj->get_researches();

    // $obj->abstract = "6 abstract";
    // $obj->title = "6 title";
    // $obj->authors = "6 authors";
    // $obj->method = "6 method";
    // $obj->Save();
    // print("111");
    // die();
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'headers.php'; ?>
        <div id="layoutSidenav">
            <?php include'sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Research</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Research</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Research Maintenance
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Abstract</th>
                                            <th>Title</th>
                                            <th>Authors</th>
                                            <th>Method</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Abstract</th>
                                            <th>Title</th>
                                            <th>Authors</th>
                                            <th>Method</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        foreach($data as $row) {
                                            echo "
                                            <tr>
                                                <td>${row['abstract']}</td>
                                                <td>${row['title']}</td>
                                                <td>${row['authors']}</td>
                                                <td>${row['method']}</td>
                                                <td><img src='${row['qr_code_link']}'></img></td>
                                                <td>
                                                    <button class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                                    <button class='btn btn-danger'><i class='fas fa-trash'></i></button>
                                                </td>
                                            </tr>
                                            ";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
