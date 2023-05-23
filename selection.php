<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/selection.css">
    <title>Select Game Character</title>
</head>
<?php require_once('_nav.php'); ?>

<div class="video">
    <video autoplay loop muted plays-inline>
    <source src ="img/backvideo2.mp4" type="video/mp4"> 
    </video>    
</div>
<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (isset($_POST["send"])) {
        if ($_POST['name'] != "") {
            $bdd = connect();

            $sql = "INSERT INTO persos (`name`, `class_icon`, `for`, `dex`, `int`, `char`, `vit`, `pdv`, `user_id`)  
            VALUES (:name, :class_icon, :for, :dex, :int, :char, :vit, :pdv, :user_id);";
            
            $sth = $bdd->prepare($sql);
        
            $sth->execute([
                'name'      => $_POST['name'],
                // 'class_icon'=> $,
                'for'       => 10,
                'dex'       => 10,
                'int'       => 10,
                'char'      => 10,
                'vit'       => 10,
                'pdv'       => 20,
                'user_id'   => $_SESSION['user']['id']
            ]);

            header('Location: persos.php');
        }
    }
?>

<?php require_once('_header.php'); ?>
    <div class="container">
        <h1>Créer un personnage</h1>
        <form action="" method="post">
            <div>
                <label for="name">Nom</label>
                <input 
                    type="text"
                    id="name"
                    name="name"
                    placeholer="Entrez un nom"
                    required
                />
            </div>
            <div class="mt-4">
                <input type="submit" class="btn btn-green" name="send" value="Créer" />
                <a class="btn btn-grey" href="persos.php">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>

<body>
    <div class="container">
        <div class="card">
            <div class="card-image">
                <img src="img/character4.jpg" alt="Character">
            </div>

            <div class="card-body">
                <span class="power">Spécialiste : Tank </span>
                <h2>Le Samouraï</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error laudantium sequi facere mollitia saepe.</p>
            </div>

            <div class="card-footer">
                <div class="info">
                    <div class="value">Vitesse</div>
                    <div class="type">-30%</div>
                </div>
                <div class="info">
                    <div class="value">Points de vie</div>
                    <div class="type">40 pts</div>
                </div>
                <div class="info">
                    <div class="value">Dégats</div>
                    <div class="type">-10%</div>
                </div>
            </div>

            <div class="selector">
            <button type="submit" class="selector button" name="send">Sélectionner</button>
            </div>

        </div>

        <div class="card">
            <div class="card-image">
                <img src="img/character3.jpg" alt="Character">
            </div>

            <div class="card-body">
                <span class="power">Spécialiste : Vitesse</span>
                <h2>L'Assassin</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error laudantium sequi facere mollitia saepe.</p>
            </div>

            <div class="card-footer">
                <div class="info">
                    <div class="value">Vitesse</div>
                    <div class="type">+ 20 %</div>
                </div>
                <div class="info">
                    <div class="value">Points de vie</div>
                    <div class="type">15 pts </div>
                </div>
                <div class="info">
                    <div class="value">Dégats</div>
                    <div class="type">+ 5%</div>
                </div>
            </div>
            <div class="selector">
                <button type="submit" class="selector button" name="send" >Sélectionner</button>
            </div>

        </div>

        <div class="card">
            <div class="card-image">
                <img src="img/character2.jpg" alt="Character">
            </div>

            <div class="card-body">
                <span class="power">Spécialiste : Dégat</span>
                <h2>Le Guerrier</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error laudantium sequi facere mollitia saepe.</p>
            </div>

            <div class="card-footer">
                <div class="info">
                    <div class="value">Vitesse</div>
                    <div class="type">+5%</div>
                </div>
                <div class="info">
                    <div class="value">Points de vie</div>
                    <div class="type">20pts</div>
                </div>
                <div class="info">
                    <div class="value">Dégats</div>
                    <div class="type">+ 25%</div>
                </div>
            </div>
            <div class="selector">
            <button type="submit" class="selector button" name="send">Sélectionner</button>
            </div>

        </div>

</body>
</html>