<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>DFS</title>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<style>
    .modal-confirm {		
        color: #434e65;
        width: 525px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        background: #47c9a2;
        border-bottom: none;   
        position: relative;
        text-align: center;
        margin: -20px -20px 0;
        border-radius: 5px 5px 0 0;
        padding: 35px;
    }

    .modal-confirm .modal-header-error {
        background: #bd2222;
        border-bottom: none;   
        position: relative;
        text-align: center;
        margin: -20px -20px 0;
        border-radius: 5px 5px 0 0;
        padding: 35px;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 36px;
        margin: 10px 0;
    }
    .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modal-confirm .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #fff;
        text-shadow: none;
        opacity: 0.5;
        padding: 0;
        background-color: transparent;
        border: 0;
        float: right;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
    }
    .modal-confirm .close:hover {
        opacity: 0.8;
    }
    .modal-confirm .icon-box {
        color: #fff;		
        width: 95px;
        height: 95px;
        display: inline-block;
        border-radius: 50%;
        z-index: 9;
        border: 5px solid #fff;
        padding: 15px;
        text-align: center;
    }
    .modal-confirm .icon-box i {
        font-size: 64px;
        margin: -4px 0 0 -4px;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn, .modal-confirm .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #eeb711 !important;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border-radius: 30px;
        margin-top: 10px;
        padding: 6px 20px;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #eda645 !important;
        outline: none;
    }
    .modal-confirm .btn span {
        margin: 1px 3px 0;
        float: left;
    }
    .modal-confirm .btn i {
        margin-left: 1px;
        font-size: 20px;
        float: right;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }

    main:before{
        content: '';
        display:block;
        background: url('/images/logo_borderless.png') center center / 100% auto no-repeat;
        width:45%;
        height: 100%;
        top:25px;
        position: fixed;
        left: 0;
        right: 0;
        margin: auto;
        opacity: 0.1;
        z-index: 7;
    }
    .demo-bg {
        opacity: 0.2;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        height: auto;
    }
</style>


<link href="css/styles.css" rel="stylesheet" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<script src="assets/js/jquery.js" crossorigin="anonymous"></script>