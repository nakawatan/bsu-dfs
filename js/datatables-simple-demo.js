window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        // new simpleDatatables.DataTable(datatablesSimple);
        if (window.location.pathname == "/research.php") {
            let datatable = new simpleDatatables.DataTable(datatablesSimple, {searchable:false});
        }else {
            let datatable = new simpleDatatables.DataTable(datatablesSimple, {});
        }
    }
});
