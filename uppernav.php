<?php
include("connect.php");

?>


<div id="uppernav">
        <div class="upnav">
        <button class="openbtn" onclick="toggleNav()">☰</button>
    </div>
    <style>
   /* Base styles */
   body {
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
    overflow-x: hidden; /* Prevent horizontal scroll */
}

/* Styles for the upper navigation */
#uppernav {
    background-color: #333;
    max-width: 120%; /* Ensure it doesn't exceed screen width */
    height: 60px; /* Default height for the nav */
}

/* Flexbox layout for upnav */
.upnav {
    display: flex; /* Use flexbox for layout */
    align-items: center; /* Center items vertically */
    height: 100%; /* Make sure the flex container takes the full height */
}

/* Button styles */
.openbtn {
    background-color: #555;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

/* Media Queries */

/* Extra Small Devices (less than 321px) */
@media (max-width: 320px) {
    #uppernav {
        height: 50px; /* Adjust height for small screens */
    }

    .openbtn {
        width: 100%;
        padding: 8px;
        font-size: 14px;
    }
}

/* Small Devices (321px to 750px) */
@media (min-width: 321px) and (max-width: 750px) {
    #uppernav {
        height: 60px; /* Standard height for small devices */
    }

    .openbtn {
        padding: 8px 12px;
        font-size: 14px;
    }

    /* Ensure no unwanted flex behavior */
    body {
        display: block; /* Reset to block layout */
    }
}

/* Medium Devices (751px to 1024px) */
@media (min-width: 751px) and (max-width: 1024px) {
    #uppernav {
        height: 70px; /* Increased height for medium devices */
        padding: 10px;
    }

    .openbtn {
        padding: 10px 15px;
        font-size: 16px;
    }
}

/* Large Devices (1025px and above) */
@media (min-width: 1025px) {
    #uppernav {
        height: 80px; /* Larger height for desktops */
        padding: 10px;
    }

    .openbtn {
        padding: 10px 20px;
        font-size: 18px;
    }
}
</style>