
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
<body>
    <?php require_once('_nav.php'); ?>
    <header>
        <h2 class="logo"> TerraQuest</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>



<button class="btnLogin-popup">Login</button>
</nav>
</header>