<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css" />
</head>

<body>

    

<?php
    require_once('_header.php');
    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();
        $sql = "SELECT * FROM users WHERE `email` = :email;";
        
        $sth = $bdd->prepare($sql);
        
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password']) ) {
            // dd($user);
            $_SESSION['user'] = $user;
            header('Location: persos.php');
        } else {
            $msg = "Email ou mot de passe incorrect !";
        }
    }
    
?>


<div class="wrapper">
    <span class="icon-close"><ion-icon name="close"></ion-icon></span>
    <div class="form-box login">   
        <h2>Connexion</h2>
            <form action="" method="post">

                    <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></ion-icon></span>
                    <input type="text" placeholder="Entrez votre pseudo" name="username" id="username">
                    <label for="username">Pseudo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" placeholder="Entrez votre email" name="email" id="email">
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" placeholder="Entrez votre mot de passe" name="password" id="password">
                        <label for="password">Mot de passe</label>
                </div>

                <div class="login-register">
                    <p>Vous n'avez pas de compte ? <a class="register-link"> Creer un compte</a></p>
                </div>
                <button type="submit" class="btn" name="send" value="Connexion">Connexion</button>
            </form>
    </div>
    
    
    
    
    
    <div class="form-box register">  
    
        <h2>S'inscrire</h2>
            <form action="" method="post">                
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" placeholder="Entrez votre email" name="email" id="email">
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" placeholder="Entrez votre mot de passe" name="password" id="password">
                        <label for="password">Mot de passe</label>
                </div>

                <div class="login-register">
                    <p>Vous avez déjà un compte ? <a href="login.php" class="login-link"> Se connecter</a></p>
                </div>
                <button type="submit" class="btn" name="send" value="Connexion">S'incrire</button>
            </form>
    </div>



   

</div>

<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
