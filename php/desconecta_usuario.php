<?php 

session_start();


if (!isset($_SESSION)){ 
    echo '<script language = javascript>
    alert("No ha iniciado ninguna sesi\u00F3n, por favor reg\u00EDstrese");
    window.location = "/institutoInguz";
    </script>';
    die;
} else {
    session_unset();
    session_destroy();
    echo '<script language = javascript>
    alert("Su sesi\u00F3n ha terminado correctamente.\r Vuelva pronto!")
    window.location = "/institutoInguz"
    </script>'; 
}