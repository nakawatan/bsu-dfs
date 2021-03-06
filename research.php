<!DOCTYPE html>
<?php
    include 'classes/research.php';
    include 'classes/course.php';
    $obj = new Research();
    if (isset($_REQUEST['filter-major-input'])){
        $obj->course_id = $_REQUEST['filter-major-input'];
    }
    if (isset($_REQUEST['filter-text-input'])){
        if ($_REQUEST['filter-field-input'] == "title") {
            $obj->title = "%".$_REQUEST['filter-text-input']."%";
        }else if ($_REQUEST['filter-field-input'] == "abstract") {
            $obj->abstract = "%".$_REQUEST['filter-text-input']."%";
        }else if ($_REQUEST['filter-field-input'] == "method") {
            $obj->method = "%".$_REQUEST['filter-text-input']."%";
        }else if ($_REQUEST['filter-field-input'] == "author") {
            $obj->authors = "%".$_REQUEST['filter-text-input']."%";
        }else if ($_REQUEST['filter-field-input'] == "major") {
            $obj->course_id = $_REQUEST['filter-text-input'];
        }else if ($_REQUEST['filter-field-input'] == "published_date") {
            $obj->publish_date = "%".$_REQUEST['filter-text-input']."%";
        }
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
                <main>
                    <div class="main_container container-fluid px-4">
                        <h1 class="mt-4">Research</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Research</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Research Maintenance
                                <button class="btn btn-primary" onclick="openAddModal();" style="float:right"><i class='fas fa-edit'></i></button>
                            </div>
                            <div class="card-body">
                            <form method="get">
                            <table border="0" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                    <div class="mb-3">
                                        <label for="user-level-input" class="form-label">Major:</label>
                                        <select name="filter-major-input" class="form-select" id="filter-major-input">
                                            <option value='0'>--Select Major--</option>
                                            <?php 
                                            foreach($courses as $row) {
                                                $selected = "";
                                                if ($obj->course_id == $row['id']) {
                                                    $selected = "selected";
                                                }
                                                echo "<option ${selected} value='${row['id']}'>${row['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    </tr>
                                    <tr>
                                    <div class="mb-3">
                                        <label for="user-level-input" class="form-label">Search:</label>
                                        <input type="text" name="filter-text-input" class="form-control"/>
                                        <label for="user-level-input" class="form-label">Field:</label>
                                        <select name="filter-field-input" class="form-control">
                                            <option value="title">Title</option>
                                            <!-- <option value="major">Major</option> -->
                                            <option value="author">Author</option>
                                            <option value="abstract">Abstract</option>
                                            <option value="method">Method</option>
                                            <option value="published_date">Published Date</option>
                                        </select>
                                    </div>
                                    </tr>
                                    <tr>
                                    <div class="mb-3">
                                        <button class="btn btn-warning">Filter</button>
                                    </div>
                                    </tr>
                             </tbody>
                            </table>
                            </form>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Abstract</th>
                                            <th>Title</th>
                                            <th>Authors</th>
                                            <th>Major</th>
                                            <th>Method</th>
                                            <th>Published Date</th>
                                            <th>File</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Abstract</th>
                                            <th>Title</th>
                                            <th>Authors</th>
                                            <th>Major</th>
                                            <th>Method</th>
                                            <th>Published Date</th>
                                            <th>File</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        foreach($data as $row) {
                                            $objData = json_encode($row);
                                            echo "
                                            <tr data-attr-details='${objData}'>
                                                <td style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:250px;line-height: 24px; '>${row['abstract']}</td>
                                                <td>${row['title']}</td>
                                                <td>${row['authors']}</td>
                                                <td>${row['course']}</td>
                                                <td>${row['method']}</td>
                                                <td>${row['publish_date']}</td>
                                                <td>${row['file']}</td>
                                                <td><img src='${row['qr_code_link']}'></img></td>
                                                <td>
                                                    <button class='btn btn-primary' onclick='OpenEditModal(this);'><i class='fas fa-edit'></i></button>
                                                    <button class='btn btn-danger' onclick='openDeleteModal(${row['id']})'><i class='fas fa-trash'></i></button>
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
        <!-- Delete Research modal -->
        <div class="modal" id="delete-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Research</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete Research?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button type="button" id="confirm-delete-btn" class="btn btn-success">Yes</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Edit Research modal -->
        <div class="modal" id="edit-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Research</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abstract-input" class="form-label">Abstract:</label>
                        <!-- <input type="text" class="form-control" id="abstract-input"> -->
                        <textarea class="form-control" id="abstract-input">

                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="title-input" class="form-label">Title:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="title-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="authors-input" class="form-label">Author:</label>
                        <input type="text" class="form-control" id="authors-input">
                    </div>
                    <div class="mb-3">
                        <label for="method-input" class="form-label">Method:</label>
                        <input type="text" class="form-control" id="method-input">
                    </div>
                    <div class="mb-3">
                        <label for="major-input" class="form-label">Major:</label>
                        <select name="major-input" class="form-select" id="major-input">
                        <?php 
                        foreach($courses as $row) {
                            echo "<option ${selected} value='${row['id']}'>${row['name']}</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="col-sm-1 col-form-label">Date</label>
                        <div class="input-group date" id="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" id="publish-date-input" class="form-control">
                            <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i>
                            </span>
                            </span>
                        </div>
                    </div> 
                    <div class="mb-3">
                        <label for="file-input" class="form-label">File:</label>
                        <input class="form-control" type="file" id="file-input">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-update-btn" class="btn btn-success">Save</button>
                </div>
                </div>
            </div>
        </div>

        <!-- success Delete modal -->
        <div id="success-delete-modal" class="modal fade" data-bs-backdrop="static">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button> -->
                    </div>
                    <div class="modal-body text-center">
                        <h4>Success!</h4>	
                        <p>Research has been deleted successfully.</p>
                        <button id="btn-success-delete" class="btn btn-success" data-bs-dismiss="modal"><span>OK</span> <i class="material-icons">&#xE5C8;</i></button>
                    </div>
                </div>
            </div>
        </div> 

        <!-- success Delete user modal -->
        <div id="success-update-modal" class="modal fade" data-bs-backdrop="static">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button> -->
                    </div>
                    <div class="modal-body text-center">
                        <h4>Success!</h4>	
                        <p>Research has been updated successfully.</p>
                        <button id="btn-success-update" class="btn btn-success" data-bs-dismiss="modal"><span>OK</span> <i class="material-icons">&#xE5C8;</i></button>
                    </div>
                </div>
            </div>
        </div> 

        <!-- error alert -->
        <div id="error-alert-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header-error justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button> -->
                    </div>
                    <div class="modal-body text-center">
                        <h4>ERROR!</h4>	
                        <p class="error-alert-text"></p>
                        <button class="btn btn-success" data-bs-dismiss="modal"><span>OK</span> <i class="material-icons">&#xE5C8;</i></button>
                    </div>
                </div>
            </div>
        </div> 
        <?php include'scripts.php'; ?>
        <script>
            $(function() {
                $('#datepicker').datepicker();
            });
            function openDeleteModal(id){
                $("#delete-modal").modal("show");
                $('#confirm-delete-btn').attr('data-attr-id',id);

                $('#confirm-delete-btn').unbind('click').on('click',function(){
                    
                    $.ajax({
                        url: '/api/',
                        data: {
                            method:"delete_research",
                            id : $(this).attr("data-attr-id")
                        },
                        method: 'POST',
                        success: function(response) {
                            $('#btn-success-delete').unbind('click').on('click',function(){
                                window.location.reload();
                            });
                            $("#delete-modal").modal("hide");
                            $("#success-delete-modal").modal("show");
                        }
                    });
                });
            }

            function OpenEditModal(elem){
                Resetform();
                data = JSON.parse($(elem).parent().parent("tr").attr("data-attr-details"));
                
                $('#abstract-input').val(data.abstract);
                $('#title-input').val(data.title);
                $('#method-input').val(data.method);
                $('#authors-input').val(data.authors);
                $('#major-input').val(data.course_id);
                $('#publish-date-input').val(data.publish_date);

                //intiate click events
                $('#confirm-update-btn').unbind('click').on('click',function(){
                    if(validateform()){
                        var formData = new FormData();

                        if ($('#file-input')[0].files.length > 0) {
                            myFile = $('#file-input')[0].files[0];
                            formData.append("file",myFile);
                        }
                        formData.append("method","update_research");
                        formData.append("id",data.id);
                        formData.append("abstract",$('#abstract-input').val());
                        formData.append("title",$('#title-input').val());
                        formData.append("authors",$('#authors-input').val());
                        formData.append("r_method",$('#method-input').val());
                        formData.append("major_id",$('#major-input').val());
                        formData.append("publish_date",$('#publish-date-input').val());
                        $.ajax({
                            url: '/api/',
                            // data: {
                            //     method:"update_research",
                            //     id : data.id,
                            //     abstract:$('#abstract-input').val(),
                            //     title:$('#title-input').val(),
                            //     authors:$('#authors-input').val(),
                            //     r_method:$('#method-input').val(),
                            //     file:myFile
                            // },
                            data : formData,
                            method: 'POST',
                            contentType: false,
				            processData: false,
                            success: function(response) {
                                $('#btn-success-update').unbind('click').on('click',function(){
                                    window.location.reload();
                                });
                                $("#edit-modal").modal("hide");
                                $("#success-update-modal").modal("show");
                            }
                        });
                    }
                });

                $('#edit-modal').find('.modal-title').text('Edit Research');
                $("#edit-modal").modal("show");
            }

            function openAddModal(){
                Resetform();
                $('#edit-modal').find('.modal-title').text('Add New Research');
                var myFile;
                if ($('#file-input')[0].files > 0) {
                    myFile = $('#file-input')[0].files[0];
                }

                //intiate click events
                $('#confirm-update-btn').unbind('click').on('click',function(){
                    if (validateform()){
                        var formData = new FormData();

                        if ($('#file-input')[0].files.length > 0) {
                            myFile = $('#file-input')[0].files[0];
                            formData.append("file",myFile);
                        }
                        formData.append("method","new_research");
                        formData.append("abstract",$('#abstract-input').val());
                        formData.append("title",$('#title-input').val());
                        formData.append("authors",$('#authors-input').val());
                        formData.append("r_method",$('#method-input').val());
                        formData.append("major_id",$('#major-input').val());
                        formData.append("publish_date",$('#publish-date-input').val());
                        $.ajax({
                            url: '/api/',
                            // data: {
                            //     method:"new_research",
                            //     abstract:$('#abstract-input').val(),
                            //     title:$('#title-input').val(),
                            //     authors:$('#authors-input').val(),
                            //     r_method:$('#method-input').val(),
                            //     file: myFile
                            // },
                            data:formData,
                            method: 'POST',
                            contentType: false,
				            processData: false,
                            success: function(response) {
                                $('#btn-success-update').unbind('click').on('click',function(){
                                    window.location.reload();
                                });
                                $("#edit-modal").modal("hide");
                                $("#success-update-modal").modal("show");
                            }
                        });
                    }
                    
                });

                $("#edit-modal").modal("show");
            }

            function Resetform(){
                $('#abstract-input').val('');
                $('#title-input').val('');
                $('#authors-input').val('');
                $('#method-input').val('');
                $('#major-input').val('');
                $('#publish-date-input').val('');
            }

            function validateform(){
                if($('#abstract-input').val() == ""){
                    $('.error-alert-text').text("Abstract is required.");
                    $('#error-alert-modal').modal('show');
                    return false;
                }
                if(!$('#title-input').val()){
                    $('.error-alert-text').text("Title is required.");
                    $('#error-alert-modal').modal('show');
                    return false;
                }
                if(!$('#authors-input').val()){
                    $('.error-alert-text').text("Author(s) is required.");
                    $('#error-alert-modal').modal('show');
                    return false;
                }
                if(!$('#method-input').val()){
                    $('.error-alert-text').text("Method is required.");
                    $('#error-alert-modal').modal('show');
                    return false;
                }

                if(!$('#publish-date-input').val()){
                    $('.error-alert-text').text("Publish Date is required.");
                    $('#error-alert-modal').modal('show');
                    return false;
                }
                return true;
            }

            // table filtering
        </script>
    </body>
</html>
