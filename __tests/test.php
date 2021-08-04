<?php
    require '../_require/session-manager.php';

    if(tryRemember()){
        echo "É O PAI?";
    }

    unsetLogin();

    if(tryRemember()){
        echo "É O PAI?";
    }
?>