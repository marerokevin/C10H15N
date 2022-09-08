<nav class="navigationWrapper">
    <div class="logoWrapper">
        <li class="home">
            <a class="menu" onclick="Burjer()" id="openburger">
                <i class="fa fa-bars fa-2x" ></i>
            </a>
        </li>
        <a href="../K/index.php" class="logolink"><img class="logo" src="/RNA/resources/images/glorylogo.svg"></a>
        <li class="home">
            <a class="link" href="/RNA/K/index.php">GPI MIS-HelpDesk</a>
        </li>
    </div>
        <ul class="navigation">
            <li class="parent" id="button">
                <button class='trigger' onclick="usermodal()">
                    <img src='/RNA/resources/images/glorylogo.svg'>
                </button>
            </li>
        </ul>
</nav>
<div class="modal-wrapper" id="modal-wrapper">
    <div class="modal-content" id="modal-content">
        <li class="parent" id="button">
            <button class='trigger2'>
                <img src='/RNA/resources/images/glorylogo.svg'>
            </button>
            <div class="usercontainer">
                <div class="user"><?php echo $_SESSION["last_name"]?> <?php echo $_SESSION["first_name"]?></div>
                <div class="mail"><?php echo $_SESSION["email_address"]?></div>
                <div class="mail"><a class="view" href="/RNA/profile.php">View Account</a></div>
            </div>
        </li>
        <li class="userout">
            <a class="signout" href="/RNA/authentication/logout.php">Sign Out</a>
        </li>
    </div>
</div>
<script src="/RNA/resources/scripts/sidebar.js"></script>
<script src="/RNA/resources/scripts/navbar-modal.js"></script>