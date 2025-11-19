<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Homepage</title>
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	
    <style>
        
		body {
            font-family: Arial, sans-serif;
            margin: 1;
            padding: 10;
            background-color: #f4f4f9;
        }

/* Make the header full-width and fixed */
@keyframes moveText {
    0% { left: 0; } /* Start from left */
    50% { left: 50%; transform: translateX(-50%); } /* Move to center */
    100% { left: 100%; transform: translateX(-100%); } /* Move to right */
}

/* Header Styling */
header {
    background-color: #6a11cb;
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    height: 90px;
    width: 100vw;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    overflow: hidden;
}

/* Menu Icon (Stay Fixed on Left) */
.menu-toggle {
    font-size: 24px;
    cursor: pointer;
    color: white;
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1101;
}

/* Logo/Text Animation */
.logo {
    font-size: 24px;
    font-weight: bold;
	  font-family: 'Cookie', cursive;
    white-space: nowrap;
    position: absolute; /* Absolute so it moves freely */
    animation: moveText 10s infinite alternate ease-in-out;
}

		
		
		
		
		
		/* Reset default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        /* Sidebar styling */
        .sidebar {
    position: fixed;
    top: 0;
    left: -250px; /* Initially hidden */
    width: 250px;
    height: 100vh;
    background-color: #f0f0f0;
    padding: 25px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    transition: left 0.3s ease;
    z-index: 1200; /* Make sure it's above the header */
}

/* Sidebar visible */
.sidebar.active {
    left: 0;
}

		 .sidebar a:hover {
            background-color: #007BFF;
            color: white;
        }
		
		
		

        .sidebar a {
            text-decoration: none;
            color: black;
            font-size: 22px;
            font-weight: bold;
            padding: 15px 20px;
            border-radius: 10px;
            transition: background-color 0.2s ease;
        }

       

        
			
			/* Ensure the menu icon is above the header */
.menu-toggle {
    font-size: 24px;
    cursor: pointer;
    color: white;
    z-index: 1101; /* Ensure it's above the header */
}

			
			
	







.close-btn {
            font-size: 24px;
            color: black;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 15px;
        }











	
			
	

        body {
    font-family: Arial, sans-serif;
    height: 100vh;
    overflow: hidden;
    display: flex;
}

.main-container {
    flex-grow: 1;
   
    margin-left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Align items at the top */
    flex-direction: column; /* Stack content vertically */
    transition: margin-left 0.3s ease;
    padding-top: 80px; /* Space for the video at the top */
	
	
	
}

.main-container.shifted {
    margin-left: 250px; /* Adjust when sidebar is visible */
}





body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-right: 20px;
}

.left-button {
    padding: 15px 35px;
    margin-bottom: 50px;  /* Fixed typo: 'margin-buttom' to 'margin-bottom' */
    font-size: 16px;
    background: linear-gradient(#e0c3fc, #8ec5fc);
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    position: relative;
    left: 1315px;
    top: -150px;
    display: inline-flex;  /* Use inline-flex to avoid wrapping text */
    align-items: center;  /* Center align the text and arrow */
    white-space: nowrap;  /* Prevent text from wrapping into a new line */
}


.left-button::after {
    content: ' →';  /* Right arrow symbol */
    font-size: 20px; /* Adjust the size of the arrow */
    margin-left: 10px; /* Space between the text and arrow */
}




body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-right: 20px;
}

.login-button {
    padding: 15px 35px;
    margin-bottom: 50px;  /* Fixed typo: 'margin-buttom' to 'margin-bottom' */
    font-size: 16px;
    background: linear-gradient(#e0c3fc, #8ec5fc);
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    position: relative;
    left: 1120px;
    top: -60px;
    display: inline-flex;  /* Use inline-flex to avoid wrapping text */
    align-items: center;  /* Center align the text and arrow */
    white-space: nowrap;  /* Prevent text from wrapping into a new line */
}


.login-button::after {
    content: ' →';  /* Right arrow symbol */
    font-size: 20px; /* Adjust the size of the arrow */
    margin-left: 10px; /* Space between the text and arrow */
}









/* Video styling */
.video-container {
    width: 900px;
    margin: 0 auto;
    flex-grow: 0;
	position: relative;
	left: -150px;
}

.video-container video {
    width: 100%;
    border-radius: 10px;
}

/* Text styling */
.slogan {
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-top: 20px;
	margin-left: 600px;
    margin-bottom: 10px;
    flex-grow: 0; /* Ensure it doesn't stretch */
	
}

.get-started-btn {
    padding: 15px 25px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    display: block;
    margin: 0 auto;
}

.get-started-btn:hover {
    background-color: #0056b3;
}

    </style>
</head>

<body>

<header>


    <!-- Hamburger Icon -->
    <div class="menu-toggle">
        <i class="fa fa-bars"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
	<span class="close-btn" onclick="toggleSidebar()">&times;</span>
        <a href="homepage.php">HOME</a>
        <a href="coursetable.html">COURSES</a>
        <a href="paymentdirect.html">PAYMENT</a>
        
		<a href="greatprofile.php">PROFILE</a>
        <a href="aboutus.html">ABOUT US</a>
    </div>




        <div class="logo"><h1>Learnify</h1></div>
        
    </header>

<button class="left-button" id="navigateBtn">Register Now</button><br> 
<button class="login-button" id="navigateB">Login </button>
    <!-- Main Content -->
    <div class="main-container">
        <!-- Video Section -->
        <div class="video-container">
            <video autoplay muted loop>
<source src="  http://localhost/elearning/E-Learning_infographic_video_with_Adobe_After_effects(720p).mp4" 
type="video/mp4" height="900px" width="900px" >
            Your browser does not support the video tag.
        </video>
</div>
        
        
        <div class="slogan">Learn Anytime, Anywhere!</div>
        
        <!-- Button Section -->
        <button onclick="window.location.href='http://localhost/elearning/enrollment.html'" class="get-started-btn">Get Started</button>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.querySelector(".menu-toggle");
        const closeButton = document.querySelector(".close-btn");
        const sidebar = document.querySelector(".sidebar");

        // Function to toggle sidebar visibility
        function toggleSidebar() {
            sidebar.classList.toggle("active");
        }

        // Open sidebar when clicking menu icon
        menuToggle.addEventListener("click", toggleSidebar);

        // Close sidebar when clicking the close button (×)
        closeButton.addEventListener("click", toggleSidebar);
    });
</script>


    </script>
	<script>
    document.getElementById("navigateBtn").addEventListener("click", function() {
        window.location.href = "registration.php";
    });
</script>
	
	<script>
    document.getElementById("navigateB").addEventListener("click", function() {
        window.location.href = "login.html";
    });
</script>
	
	
</body>
</html>

























