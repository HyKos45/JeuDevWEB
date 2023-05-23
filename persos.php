<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM persos WHERE user_id = :user_id";

    $sth = $bdd->prepare($sql);
        
    $sth->execute([
        'user_id'     => $_SESSION['user']['id']
    ]);

    $persos = $sth->fetchAll();

    // dd($persos);

?>
<?php require_once('_header.php'); ?>


<div class="container" style="margin-top:100px">
    <?php if (isset($_GET['msg'])) {
        echo "<div class='alert'>" . $_GET['msg'] . "</div>";
    } ?>
    <h1>Vos combattants : </h1>
    <a class="btn btn-green" href="persos_add.php">Créer un combattant</a>
    <?php foreach ($persos as $perso) { ?>
    <table class="table" >
        <thead>
        <tr>
                <th>Classe</th>
                <th>Nom</th>
                <th>XP</th>
                <th>Pdv</th>
                <th>Force</th>
                <th>Dextérité</th>
                <th>Charisme</th>
                <th>Intelligence</th>
                <th>Vitesse</th>
                <th>Cristaux</th>
                <th width="22%">Action</th>
            </tr>
        </thead>
        <tbody>
        
                <tr>
                    <td><img class=icon src="img/<?php echo $perso['class_icon'] ? $perso['class_icon'] : "" ?>"></td>
                    <td><?php echo $perso['name']; ?></td>
                    <td><?php echo $perso['xp']; ?></td>
                    <td><?php echo $perso['pdv']; ?></td>
                    <td><?php echo $perso['for']; ?></td>
                    <td><?php echo $perso['dex']; ?></td>
                    <td><?php echo $perso['char']; ?></td>
                    <td><?php echo $perso['int']; ?></td>
                    <td><?php echo $perso['vit']; ?></td>
                    <td><?php echo $perso['cristal']; ?></td>
                    <td align="right">
                        <?php if ($perso['pdv'] > 0) { ?>
                            <a 
                                class="btn btn-grey"
                                href="persos_choice.php?id=<?php echo $perso['id']; ?>" 
                            >Choisir</a>
                        <?php } else { ?>
                            <a 
                                class="btn btn-green"
                                href="persos_respawn.php?id=<?php echo $perso['id']; ?>" 
                            >Résussité</a>
                        <?php } ?>

                        <a 
                            class="btn btn-grey"
                            href="persos_show.php?id=<?php echo $perso['id']; ?>" 
                        >Détails</a>

                        <a 
                            class="btn btn-blue"
                            href="persos_edit.php?id=<?php echo $perso['id']; ?>" 
                        >Modifier</a>

                        <a 
                            class="btn btn-red"
                            href="persos_del.php?id=<?php echo $perso['id']; ?>" 
                            onClick="return confirm('Etes-vous sûr ?');"
                        >Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>