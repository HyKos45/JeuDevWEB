<h2><?php echo $_SESSION['perso']['name']; ?></h2>
    <b>Point de vie:</b>
    <div class="health-bar"> <?php 
   
// $sql = "SELECT pdv, max_vie FROM health_bar WHERE id = 1";
$percentage = ($_SESSION['perso']["pdv"] / $_SESSION['perso']["max_vie"]) * 100;
echo '<div class="health-bar">';
echo '<div class="health-bar-progress" style="width: ' . $percentage . '%;"></div>';
echo '</div>';

    ?></h2>
</div>
<div>
    <b>Cristaux :</b> <?php echo $_SESSION['perso']['cristal']; ?></h2>
</div>
<div>
    <b>Xp:</b> <?php echo $_SESSION['perso']['xp']; ?></h2>
</div>
<div class="mt-4">
    <b>Force:</b> <?php echo $_SESSION['perso']['for']; ?></h2>
</div>
<div>
    <b>Dextérité:</b> <?php echo $_SESSION['perso']['dex']; ?></h2>
</div>
<div>
    <b>Intélligence:</b> <?php echo $_SESSION['perso']['int']; ?></h2>
</div>
<div>
    <b>Charisme:</b> <?php echo $_SESSION['perso']['char']; ?></h2>
</div>
<div>
    <b>Vitesse:</b> <?php echo $_SESSION['perso']['vit']; ?></h2>
</div>


    





