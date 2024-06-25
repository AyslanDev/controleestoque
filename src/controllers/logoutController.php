<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();


echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: 'Até mais!',
                icon: 'success'
            }).then(function() {
                window.location = '/';
            });
        </script>
    </body>
    </html>";

    exit;