<header>
    <div class="logo"><a href="../html/homePage.php">Glowberry</a></div>

    <div class="header-tools">
        <form action="../php/search.php" method="GET" class="search-box">
            <button type="button" style="background: none; border: none; cursor: pointer;">
                <i class="fa-solid fa-magnifying-glass" style="color: white;"></i>
            </button>
            <input type="text" name="query" id="search" placeholder="Search..." autocomplete="off">
        </form>
        
        <div class="icons">
            <a href="../html/Cart.php" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            
            <a href="../html/login.php" style="color: inherit; text-decoration: none;">
                <i class="fa-regular fa-user"></i>
            </a>
        </div>
    </div>
</header>

<div id="results"></div>