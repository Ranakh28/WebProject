<header>
    <div class="logo"><a href="../html/homePage.php">Glowberry</a></div>

    <div class="header-tools">
        <form action="../php/search.php" method="GET" class="search-box">
            <button type="button" style="background: none; border: none; cursor: pointer;">
                <i class="fa-solid fa-magnifying-glass" style=" color: white;"></i>
            </button>
            <input type="text" name="query" id="search" placeholder="Search..." autocomplete="off">
        </form>
        
        <div class="icons">
            <i class="fa-solid fa-cart-shopping"></i>
            <i class="fa-regular fa-user"></i>
        </div>
    </div>
</header>

<div id="results"></div>