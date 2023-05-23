
<!-- <ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="register.php">Créer un compte</a></li>
        <li><a href="login.php">Connexion</a></li>
    <?php } else { ?>
        <li><a href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a href="logout.php">Logout</a></li>
    <?php } ?>
</ul> -->
 


</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Orbitron&family=Oswald:wght@200&display=swap');
</style>
<body>
    

    <header>
      <img src="img/logo_blanc.png" class="logo">
        <nav class="navigation">
            <a href="login.php">Accueil</a>
            <a href="rules.php">Règles</a>
            <a href="selection.php">Index</a>
</nav>
</header>