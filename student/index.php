<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header('Location: '.'/login.php');
    }
    // if ($_SESSION["user"]["user_level_id"] != "2"){
    //     header('Location: '.'/student/');
    // }else {
    //     header('Location: '.'/index.php');
    // }
?>
<html>
<head>
    <title>DFS Student</title>
    <?php include 'links.php'; ?>
    <?php include 'scripts.php'; ?>
    <style>
        #qr-reader button {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #198754;
            border-color: #198754;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #qr-reader {
            border-radius: 12px;
        }
    </style>
<body>
    <div class="container">
    <div class="row justify-content-center landing-container" style="    
    background-image: url(/images/logo_borderless.png),url(/images/building.jpg),url(/images/bsu_logo.png);
    background-size: contain;
    background-position: right bottom, left top,right,left;
    background-repeat: no-repeat, no-repeat,no-repeat;">
            <div class="col-lg-5" style="opacity:0.9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div>
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Mission And Vision</h3></div>
                        <div class="card-body">
                                    <h3 class="text-center">University Vision</h3>
                                    <p>A premier national university that develops leaders in global knowledge economy.</p>

                                    <h3 class="text-center">University Mission</h3>
                                    <p>A university commited to producing leaders by providing a 21st century learning environment through innovations in educations, multidisciplinary research, and community and industry partnerships in order to nurture the spirit of nationhood, propel the national economy, and engage the world for sustainable development.</p>
                                    
                                    <h3 class="text-center">Introduction</h3>
                                    <p>
                                        The College of Industrial Technology is the first college established in the university, and has since proven to be a premier producer of well-rounded and globally competitive professionals who meet local, national, and international demands for skilled workers who significantly contribute to the manpower resources in response to rapid industrialization of the modern world.
                                    </p>
                        </div>
                    </div>
                    <div class="card-footer text-center py-3">
                        <button class="btn btn-success form-control proceed-scan">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center scanner-container" style="display:none">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Scan Qr Code</h3></div>
                    <div class="card-body">
                        <div id="qr-reader"></div>
                        <div id="qr-reader-results"></div>
                    </div>
                    <!-- <div class="card-footer text-center py-3">
                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- research info modal -->
    <div class="modal" id="research-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Research Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="abstract-input" class="form-label">Abstract:</label>
                    <input type="text" class="form-control" id="abstract-input" readonly>
                </div>
                <div class="mb-3">
                    <label for="title-input" class="form-label">Title:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="title-input" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="authors-input" class="form-label">Author:</label>
                    <input type="text" class="form-control" id="authors-input" readonly>
                </div>
                <div class="mb-3">
                    <label for="method-input" class="form-label">Method:</label>
                    <input type="text" class="form-control" id="method-input" readonly>
                </div>
                <div class="mb-3">
                    <label for="major-input" class="form-label">Major:</label>
                    <input type="text" class="form-control" id="major-input" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a type="button" id="download-btn" class="btn btn-success">Download</a>
            </div>
            </div>
        </div>
    </div>
    <iframe id="my_iframe" style="display:none;"></iframe>
</body>
<script src="/assets/js/html5-qrcode.min.js"></script>
<script src="/assets/js/jquery.js" crossorigin="anonymous"></script>
<script>
    $( document ).ready(function() {
        $('.proceed-scan').unbind().click(function(){
            $('.scanner-container').fadeIn();
            $('.landing-container').fadeOut();
        });
    });
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            $('#qr-reader').find('button')
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                
                $.ajax({
                    url: '/api/',
                    data: {
                        method:"get_encoded_research",
                        id:decodedText
                    },
                    method: 'POST',
                    dataType:"json",
                    success: function(response) {
                        if (response.status != "ok") {
                            alert("Invalid QR code");
                            return;
                        }
                        $('#abstract-input').val(response.data.abstract);
                        $('#title-input').val(response.data.title);
                        $('#method-input').val(response.data.method);
                        $('#authors-input').val(response.data.authors);
                        $('#major-input').val(response.data.course);

                        $('#download-btn').attr({target: '_blank', 
                                href  : response.data.file});
                        $('#research-modal').modal('show');
                    }
                });
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
</head>
</html>