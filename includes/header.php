

<div id="header">
    <a href="/index.php"><div id="logo_background"></div></a>
    <div id="logo_text"><a href="/index.php">Parks of Brisbane</a></div>
    <div id='navbar'>
        <ul>
            <li><a href='/index.php'><span>Home</span></a></li>

            <li>
                <a id="search-trigger" href='#'>
                    <span>Search</span>
                </a>
                <div id="search-content">
                    <form action="search-result.php" method="post">
                        <fieldset class="inputs">
                            <input id="search" type="text" name="parkname" placeholder="Name of park">
                            <label>
                                <a href="search.php">Advanced search</a>
                            </label>
                        </fieldset>
                        <fieldset id="search-button">
                            <input type="submit" class="submit" name="search" value="Search">
                        </fieldset>
                    </form>
                </div>

            </li>

            <li>
                <?php

                //
                if (isset($_SESSION['signedin'])) {
                    echo "<a href='logout.php'><span>Log out</span></a>";
                } else {
                    echo "<a id='login-trigger' href='#'><span>Register/Log in</span></a>";
                    include 'login.php';
                } ?>
            </li>

            <li><a href='#'><span>About</span></a></li>
        </ul>
    </div>
</div>