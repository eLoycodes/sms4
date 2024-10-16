<?php
include("connect.php");

?>


<div id="uppernav">
        <div class="upnav">
        <button class="openbtn" onclick="toggleNav()">☰</button>
    </div>
    <style>
   /* Base styles */
/* Base styles */
body {
    margin: 0; /* Remove default body margin */
    padding: 0; /* Remove default body padding */
    overflow-x: hidden; /* Prevent horizontal scroll */
}

/* Styles for the upper navigation */
#uppernav {
    background-color: #333; /* Background color */
    padding: 10px; /* Padding around the nav */
    display: flex; /* Use flex for alignment */
    justify-content: center; /* Center content horizontally */
    max-width: 100%; /* Maximum width for the nav */
    max-height: 60px; /* Maximum height for the nav */
    overflow: hidden; /* Hide overflow */
}

/* Flexbox layout for upnav */
.upnav {
    display: flex; /* Maintain flex for inner elements */
    align-items: center; /* Center vertically */
}

/* Button styles */
.openbtn {
    background-color: #555; /* Button background */
    color: white; /* Button text color */
    border: none; /* No border */
    padding: 10px 15px; /* Padding inside the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 4px; /* Rounded corners */
}

/* Media Queries */

/* Extra Small Devices (less than 321px) */
@media (max-width: 320px) {
    #uppernav {
        padding: 5px; /* Adjust padding */
    }

    .openbtn {
        width: 100%; /* Full width button */
        padding: 8px; /* Adjust padding */
        font-size: 14px; /* Smaller font size */
    }
}

/* Small Devices (321px to 750px) */
@media (min-width: 321px) and (max-width: 750px) {
    #uppernav {
        padding: 5px; /* Adjust padding */
    }

    .openbtn {
        padding: 8px 12px; /* Adjust button padding */
        font-size: 14px; /* Smaller font size */
    }
}

/* Medium Devices (751px to 1024px) */
@media (min-width: 751px) and (max-width: 1024px) {
    #uppernav {
        padding: 10px; /* Standard padding */
    }

    .openbtn {
        padding: 10px 15px; /* Standard button padding */
        font-size: 16px; /* Standard font size */
    }
}

/* Large Devices (1025px and above) */
@media (min-width: 1025px) {
    #uppernav {
        padding: 10px; /* Standard padding */
    }

    .openbtn {
        padding: 10px 20px; /* Larger button padding */
        font-size: 18px; /* Larger font size */
    }
}


      </style>