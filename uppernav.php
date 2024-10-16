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
    padding: 10px;
}

/* Flexbox layout for upnav */


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
   

    .openbtn {
        width: 100%;
        padding: 8px;
        font-size: 14px;
    }
}

/* Small Devices (321px to 750px) */
@media (min-width: 321px) and (max-width: 750px) {
   

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
        padding: 10px;
    }

    .openbtn {
        padding: 10px 20px;
        font-size: 18px;
    }
}

      </style>