<div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li id="databangunan">
                                <a href="<?php echo $loc; ?>index.php" aria-expanded="true"><i class="fas fa-city"></i></i><span>Manage Building Data</span></a>
                            </li>
                            <li id="keluarga">
                                <a href="<?php echo $loc; ?>keluarga" aria-expanded="true"><i class="fas fa-user-friends"></i><span>Manage House Owner & House Holder Data</span></a>
                            </li>
                            <li id="datuk">
                                <a href="<?php echo $loc; ?>datuk" aria-expanded="true"><i class="ti-pie-chart"></i><span>Manage Datuk & Tribe Data</span></a>
                            </li>
                            <li id="aksessuper">
                                <a href="<?php echo $loc; ?>user" aria-expanded="true"><i class="fas fa-users-cog"></i><span>Manage Admin Nagari</span></a>
                            </li>        
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

<?php
    if ($_SESSION['role']==1) {
        echo '
            <script>
                $("#aksessuper").show()
            </script>
        ';
    }
    else {
        echo '
            <script>
                $("#aksessuper").hide()
            </script>
        ';  
    }
?>