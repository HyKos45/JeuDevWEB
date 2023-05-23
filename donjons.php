<?php

    require_once('functions.php');
    

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM donjons";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $donjons = $sth->fetchAll();
    // dd($donjons);
    
?>
 
   
  
    <link rel="stylesheet" href="styles/donjonstyle.css" />


    <div class="container">
        <?php echo $_SESSION['perso']['name']; ?> (<a href="persos.php">Changer</a>)
                   
    </div>
    <div class="xop-banner"> </div>
    <div class="site-container">
        
        <div class="article-container">
        <?php foreach($donjons as $donjon) { ?>
            <a href="donjon_play.php?id=<?php echo $donjon['id']; ?>">
            <article class="article-card">
                    <figure class="article-image">
                        <img src="img/<?php echo $donjon['picture'] ? $donjon['picture'] : "" ?>" alt="Entree du donjon">  
                    </figure> 
                    
                    <div class="article-content">
                    <div class="card-category">Planète de niveau <?php echo $donjon['difficulty']; ?></div>
                    <h3 class="card-title"><?php echo $donjon['name']; ?></h3>
                    <p class="card-description"><?php echo $donjon['description']? $donjon['description'] : "" ?></p></div>
            </article></a>
        <?php } ?>
</div>
</div>  
</body>
</html>