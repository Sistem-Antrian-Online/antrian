<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php">
                <img src="../../assets/img/logo/logo-header.png" alt="logo" width="190px" height="40px">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php">RJ</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="../"><i class="fas fa-fire"></i> <span>Home</span></a></li>
            <li class="menu-header">Main Feature</li>
            <?php if ($_SESSION['level'] == 1) {
            ?>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-md"></i>
                        <span>Dokter</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="../dokter/index.php">List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-table"></i>
                        <span>Poli</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="../poli/index.php">List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i>
                        <span>Antrian</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="../antrian/index.php">List</a></li>
                    </ul>
                </li>
            <?php } else if ($_SESSION['level'] == 2) {
            }
            ?>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bell"></i>
                    <span>Panggilan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="../panggilan/index.php">List</a></li>
                </ul>
            </li>
            <?php if ($_SESSION['level'] == 1) {
            ?>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Login
                            Admin</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="../users/index.php">List</a></li>
                    </ul>
                </li>
            <?php } else if ($_SESSION['level'] == 2) {
            }
            ?>
        </ul>
    </aside>
</div>