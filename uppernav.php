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
    height: auto; /* Allow height to adjust with content */
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

/* Mobile Phones (max-width: 600px) */
@media (max-width: 600px) {
    #uppernav {
        padding: 5px; /* Adjust padding for small screens */
        max-height: 60px; /* Ensure the height remains manageable */
    }

    .openbtn {
        width: 100%; /* Full width button */
        padding: 8px; /* Adjust padding */
        font-size: 14px; /* Smaller font size */
    }
}

/* Tablets (600px to 1200px) */
@media (min-width: 601px) and (max-width: 1200px) {
    #uppernav {
        padding: 10px; /* Standard padding */
        max-height: 70px; /* Slightly taller for tablets */
    }

    .openbtn {
        padding: 10px 15px; /* Standard button padding */
        font-size: 16px; /* Standard font size */
    }
}

/* Laptops (1200px to 3840px) */
@media (min-width: 1201px) and (max-width: 3840px) {
    #uppernav {
        padding: 10px; /* Standard padding */
        max-height: 80px; /* Taller for laptops */
    }

    .openbtn {
        padding: 10px 20px; /* Larger button padding */
        font-size: 18px; /* Larger font size */
    }
}

/* Desktops (3840px and above) */
@media (min-width: 3841px) {
    #uppernav {
        padding: 10px; /* Standard padding */
        max-height: 90px; /* Maximum height for large screens */
    }

    .openbtn {
        padding: 10px 25px; /* More padding for larger screens */
        font-size: 20px; /* Larger font size */
    }
}


      </style>