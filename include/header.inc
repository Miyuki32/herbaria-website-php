<?php 
    echo"<div id='top'></div>
        <header>
            <div class='logo'>
                <a href='index.php'><img src='./images/logo.png' alt='Logo'></a>
            </div>
            <input type='checkbox' id='menu-toggle'>
            <label class='menu-icon' for='menu-toggle'>&#9776;</label>
            <nav class='navbar'>
                <ul>
                    <li><a href='classify.php'>Classification</a></li>
                    <li class='dropdown'>
                        <a href='#'>Resources</a>
                        <div class='dropdown-nav'>
                            <a href='tutorial.php'>Tutorial</a>
                            <a href='tools.php'>Tools</a>
                            <a href='care.php'>Care</a>
                            <a href='identify.php'>Identify</a>
                        </div>
                    </li>
                    <li><a href='contribute.php'>Contribute</a></li>
                    <li><a href='enquiry.php'>Enquiry</a></li>
                </ul>
            </nav>
        </header>"
?>