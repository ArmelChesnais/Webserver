    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FireryRage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo HOSTURL; ?>">Home</a></li>
            <li><a href="<?php echo HOSTURL; ?>Warframe">Warframe</a></li>
            <?php
                if (getUserAuthority($loggedUser) >= 3) {
            ?>
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">M:tG<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo HOSTURL; ?>MagicCards/">Card Index</a></li>
                <li><a href="<?php echo HOSTURL; ?>MagicCards/newcard.php">New Card</a></li>
                <li><a href="<?php echo HOSTURL; ?>MagicCards/downloadcards.php">Download Card File</a></li>
                <li><a href="<?php echo HOSTURL; ?>MagicCards/options.php">Option Settings</a></li>
                </ul>
            </li>
            <?php
            }
                if (getUserAuthority($loggedUser) >= 5) {
            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tools<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo HOSTURL; ?>tests/">Tests</a></li>
                <li><a href="#">Unused</a></li>
              </ul>
            </li>
            <?php
                }
            ?>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <?php
                if ( $loggedUser == NULL) {
                    echo "Log In";
                } else {
                    echo htmlspecialchars( $loggedUser );
                }
            ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <li>

<form method="POST" id="login_account" action="index.php" style="padding: 0px 5px">
            Username: <input type="text" name="username" value="" ><br>
            Password: <input type="password" name="password"><br>
            <input id="login_account" name="login_account" type="submit" value="login"></form>
            </li>
            <li><a href="<?php echo HOSTURL; ?>register">Register</a></li>
            </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
