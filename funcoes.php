<?php

function limpaRota($rota) {
    return substr($rota["path"], 1) . '.php';
}

function checaRota($rota, $rotasPermitidas){
    if (file_exists(limpaRota($rota))) {
        array_walk($rotasPermitidas, function ($e) use($rota) {
            if ($e === limpaRota($rota)) {
                require_once($e);
            }
        });
    }else{
        header('HTTP/1.1 404 Not Found');
        require_once("/error/404.php");
    }
}
