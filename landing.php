<!DOCTYPE html>
<?php
    include 'classes/research.php';
    include 'classes/course.php';
    $obj = new Research();
    if (isset($_REQUEST['filter-major-input'])){
        $obj->course_id = $_REQUEST['filter-major-input'];
    }

    $data = $obj->get_researches();

    $course = new Course();
    $courses = $course->get_courses();
    

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
        <?php include'links.php'; ?>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'headers.php'; ?>
        <div id="layoutSidenav">
            <?php include'sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <div id = "">
                    <div class="main_container container-fluid px-4">
                        <h1 class="mt-4">Homepage</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Homepage</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Vision And Mission
                            </div>
                            <div class="card-body">
                            <img
                                class="demo-bg"
                                src="/images/building.png"
                                alt=""
                            >
                                <h3>University Vision</h3>
                                <p>A premier national university that develops leaders in global knowledge economy.</p>

                                <h3>University Mission</h3>
                                <p>A university commited to producing leaders by providing a 21st century learning environment through innovations in educations, multidisciplinary research, and community and industry partnerships in order to nurture the spirit of nationhood, propel the national economy, and engage the world for sustainable development.</p>
                                
                                <h3>Introduction</h3>
                                <p>
                                    The College of Industrial Technology is the first college established in the university, and has since proven to be a premier producer of well-rounded and globally competitive professionals who meet local, national, and international demands for skilled workers who significantly contribute to the manpower resources in response to rapid industrialization of the modern world.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
        
        <?php include'scripts.php'; ?>
        <script>
        </script>
    </body>
</html>
