<?php

    require_once('./classes/tiger.php');
    require_once('./classes/VerSable.php');

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    // On créé un combat s'il n'y en a pas encore
    if (!isset($_SESSION['fight']))
    {
        $nb = random_int(0,10);

        if ($nb <= 8) {
            $ennemi = new Tiger();
        } else {
            $ennemi = new VerSable();
        }

        $_SESSION['fight']['ennemi'] = $ennemi;
        $_SESSION['fight']['html'][] = "Vous tomber sur un " . $ennemi->name . '.';
        
    }

    // dd($_SESSION['fight']);
    // On gere le tour de combat.
    // L'ennemi tape en premier
    if ($_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']) {
        $_SESSION['fight']['html'][] = $ennemi->name . ' tape en premier';
        
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Il vous touche.";
            $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['perso']['for']/3) . " dégats";
            $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
        } else {
            $_SESSION['fight']['html'][] = "Il vous rate.";
        }

        if ($_SESSION['perso']['pdv'] <= 0) {
            $_SESSION['fight']['html'][] = "Vous etes mort.";
        } else {
            $_SESSION['fight']['html'][] = "Vous attaquez";

            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
                $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
                
                $_SESSION['fight']['html'][] = "Vous lui infligez " . $degat - floor($_SESSION['fight']['ennemi']->constitution/3) . " dégats";
                $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

                if ($_SESSION['fight']['ennemi']->pol <= 0) {
                    $_SESSION['perso']['cristal'] += $_SESSION['fight']['ennemi']->cristal;
                    $_SESSION['perso']['xp'] += $_SESSION['fight']['ennemi']->xp;
                    $_SESSION['fight']['html'][] = "<div class='alert'>Vous gagnez " . $_SESSION['fight']['ennemi']->cristal . " Or.<br />Vous avez tuez votre ennemi.</div>";
                }
            } else {
                $_SESSION['fight']['html'][] = "Vous ratez votre ennmi.";
            }
        }

    } else {
        $_SESSION['fight']['html'][] = $_SESSION['perso']['name'] . ' tape en premier';
    
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
            $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['fight']['ennemi']->constitution/3) . " dégats";
            $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

            if ($_SESSION['fight']['ennemi']->pol <= 0) {
                $_SESSION['perso']['cristal'] += $_SESSION['fight']['ennemi']->cristal;
                $_SESSION['perso']['xp'] += $_SESSION['fight']['ennemi']->xp;
                $_SESSION['fight']['html'][] = "<div class='alert'>Vous gagnez " . $_SESSION['fight']['ennemi']->cristal . " Or.<br />Vous avez tuez votre ennemi.</div>";
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi attaque";
                $touche = random_int(0, 20);
                $_SESSION['fight']['html'][] = $touche;

                if ($touche >= 10) {
                    $_SESSION['fight']['html'][] = "Il vous touche.";
                    $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                    $_SESSION['fight']['html'][] = "Il vous inflige " . $degat - floor($_SESSION['perso']['for']/3) . " dégats";
                    $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
                } else {
                    $_SESSION['fight']['html'][] = "Il vous rate votre ennmi.";
                }
            }
        } else {
            $_SESSION['fight']['html'][] = "Vous ratez votre ennmi.";

            // Attaque de l'ennemi
            $_SESSION['fight']['html'][] = "Votre ennemi attaque";
            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Il vous touche.";
                $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for']/3)) . " dégats";
                $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
            
                if ($_SESSION['perso']['pdv'] <= 0) {
                    $_SESSION['fight']['html'][] = "Vous etes mort.";
                }
            } else {
                $_SESSION['fight']['html'][] = "Il vous rate votre ennmi.";
            }
        }
    }

    // Sauvegarde de l'état de votre personnage
    $bdd = connect();
    $sql = "UPDATE persos SET `cristal` = :cristal, `pdv` = :pdv, `xp` = :xp WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'cristal'      => $_SESSION['perso']['cristal'],
        'pdv'       => $_SESSION['perso']['pdv'],
        'xp'        => $_SESSION['perso']['xp'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);

    // dd($_SESSION);

    require_once('_header.php');
    
?>

       <link rel="stylesheet" href="styles/footer.css" />

    <div class="container">
        <div class="row mt-4">
            
                <div class="px-4">
                    <?php require_once('_perso.php'); ?>
</div>
                <div class="footer">
                    <h1>Combat</h1>
                    <?php

                        foreach($_SESSION['fight']['html'] as $html) {
                            echo '<div>'.$html.'</div>';
                        }

                    ?>
                    <?php if ($_SESSION['perso']['pdv'] > 0) { ?>
                        <?php if ($_SESSION['fight']['ennemi']->pol > 0) { ?>
                            <a class="btn btn-green" href="donjon_fight.php?id=<?php echo $_GET['id']; ?>">
                                Attaquer
                            </a>
                            <a class="btn btn-blue" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                                Fuir
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-green" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                                Continuer l'exploration
                            </a>
                        <?php } ?>
                    <?php } else { ?>

                        <div class="alert">Vous êtes mort au combat</div>
                        <a class="btn btn-green" href="persos.php?msg=Votre personnage est mort">Choisir un nouveau personnage</a>
                    <?php } ?>
                </div>
            <div class="px-4">
                <?php require_once('_ennemi.php'); ?>
            </div>
        </div>
    </div>
        <?php
        if ($_SESSION['perso']['pdv'] <= 0) {
            unset($_SESSION['perso']);
            unset($_SESSION['fight']);
        }
    ?>
    </body>
</html>