<?php
require_once('config/config.php');

$user_id = "root" ?? null;
$user_email = "root" ?? null;

$buttons = [
    'Login',
    'Logout',
    'Create Record',
    'Update Record',
    'Delete Record',
    'View Record',
    'Upload File',
    'Download',
    'Generate Report'
];
?>

<table border="1" cellpadding="10">
    <tr>
        <th>Action</th>
        <th>Test</th>
    </tr>

    <?php foreach ($buttons as $button): ?>
        <tr>
            <td><?= htmlspecialchars($button) ?></td>

            <td>
                <form method="POST">
                    <input 
                        type="hidden"  name="action"
                         value="<?= htmlspecialchars($button) ?>"
                    >

                    <button type="submit">Test</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
If($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = $_POST ['action'] ?? "test_activity";

       $status = 'success';

        $success =  LogActivity(
            $pdo,
            $user_id,
            $user_email,
            $action,
            $status,



        );

        if ($success){

        echo "<p>Activity: " . htmlspecialchars($action) .
                " Status: " . htmlspecialchars($status) .
                "Log inserted sucessfully </p>";

        }else{
            echo "<p>failed to insert activity log</p>";

        }

}


?>

 logActivity($pdo,$_SESSION['user_id'],$_SESSION['user_email'],'login','success');

 if(loginUser($pdo,$login,$password)){
        echo 'Location: ' . BASE_URL . '/app/' .$_SESSION['user_role'] . '/index.php';
        header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;

    }



    <?php
require_once 'config/config.php';


if(isset($_SESSION['user_id'])){
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error='';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

       $error = 'Invalid login credentials';


        if($login===''|| $password ===''){
        
        // log incomplte login attempt
        logActivity($pdo,
        null,$login,
        'login',
        'failed'
        );
    
    }else {

    $result = loginUser($pdo,$login,$password);

        if($result===true){

            //login complete attempt 
            logActivity(
                $pdo,$_SESSION['user_id'],
                $_SESSION['user_email'],
                'login',
                'success'
            );
        
       
                echo 'Location: ' . BASE_URL . '/app/' .$_SESSION['user_role'] . '/index.php';
                header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
                exit;
             

         }elseif($result === 'active_session'){
        
            $error = 'This account is already logged in on another device';

        } else{

            $error = 'Invalid login credentials';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label>Username or Email</label>
        <input type="text"
               name="login"
               required>
        <br>
        <br>
        <label>Password</label>
        <input type="password"
               name="password"
               required>
        <br>
        <button type="submit">Sign In</button>
    </form>
</body>
</html>


