<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Requirements needed for the Project">
	<title>Project Requirements</title>
</head>
<body>
	<header>
		<h1>Requirements</h1>
    </header>
    
    <p>The following is the list of requirements stated in the project brief and how each one has been achieved</p>

<<<<<<< HEAD
    <table>
        <tr>
            <td>A clear use of HTML 5</td>
            <td>./index.php, ./components/*.php</td>
            <td>All these files use semantic tags to varying degrees</td>
        </tr>
        <tr>
            <td>Use of Bootstrap framework for a responsive layout</td>
            <td>./index.php, ./components/*.php</td>
            <td>The Bootstrap classes used in all of these files work together to create a responsive layout.</td>
        </tr>
        <tr>
            <td>Use of JavaScript to manipulate the DOM based on an Event</td>
            <td>./content/js/vote.js</td>
            <td>The script tags in this file make a call to the server to retrieve Spotify track IDs to be </td>
        </tr>
        <tr>
            <td>JavaScript loading of dynamically changing information</td>
            <td>./content/js/main.js</td>
            <td>The code between lines XXX and XXX query the DB to show a leaderboard of which song has recieved the most votes.</td>
        </tr>
        <tr>
            <td>Use of jQuery in conjunction with the DOM</td>
            <td>./content/js/main.js</td>
            <td>The JS between lines 8 and 46 will scroll the page to a section when a user clicks on the nav item and change the highlighted nav item based on the page scroll.</td>
        </tr>
        <tr>
            <td>Use of jQuery plugin to enhance your appliction</td>
            <td>./content/js/main.js</td>
            <td>Line 48, Slick carousel has been used to display band imagery</td>
        </tr>
        <tr>
            <td>Use of AJAX</td>
            <td>./components/vote.php</td>
            <td>The script uses plain JS AJAX to retrieve track info from the server.</td>
        </tr>
        <tr>
            <td>Use of the jQuery AJAX function</td>
            <td>./content/js/main.js</td>
            <td>All throught this file are examples of communication between the client and server sides,</td>
        </tr>
        <tr>
            <td>Use of Cookies</td>
            <td>./content/js/main.js and ./lib/userAuth.php</td>
            <td>Cookies are used to pass the user's name between the server and JS</td>
        </tr>
        <tr>
            <td>User Login functionality (PHP/SQL)</td>
            <td>./lib/userAuth.php</td>
            <td>This file controls the registration and autentication of users</td>
        </tr>
        <tr>
            <td>Admin Section of the site (PHP/SQL)</td>
            <td>./admin/index.php</td>
            <td></td>
        </tr>
        <tr>
            <td>Ability to ADD/EDIT/DELETE information from a database</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Appropriate consideration of relevant laws</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Security Measures (Prepared Statements/Passwords salted and hashed/valiation of user input/any other security features)</td>
            <td>./lib/userAuth.php</td>
            <td>Use of salting and hashing is included in the registration process in this page.</td>
        </tr>
    </table>
=======
    <ul>
        <li>A clear use of HTML 5</li>
        <p>index.php or any item in the components folder contains a use of HTML5.</p>

        <li>Use of Bootstrap framework for a responsive layout</li>
        <p>Header is responsive to device size and will change appearance to suit the user. this is using Bootstrap in navbar.php</p>

        <li>Use of JavaScript to manipulate the DOM based on an Event</li>
        <p>---</p>

        <li>JavaScript loading of dynamically changing information</li>
        <p>--- Highest played song on spotify API</p>

        <li>Use of jQuery in conjunction with the DOM</li>
        <p>Page scrolling function located in main.js scrolls smoothly from point to point based on event of navbar click. between SCROLL FUNC START and SCROLL FUNC END comments</p>
        
        <li>Use of jQuery plugin to enhance your appliction</li>
        <p>---</p>
        
        <li>Use of AJAX</li>
        <p> --- Spotify Request (Page Load)</p>
        
        <li>Use of the jQuery AJAX function</li>
        <p>main.js form handling of login and register to return error and validate</p>
        
        <li>Use of Cookies</li>
        <p>---</p>
        
        <li>User Login functionality (PHP/SQL)</li>
        <p>---</p>
        
        <li>Admin Section of the site (PHP/SQL)</li>
        <p>---</p>
        
        <li>Ability to ADD/EDIT/DELETE information from a database</li>
        <p>---</p>
        
        <li>Appropriate consideration of relevant laws</li>
        <p>---</p>
        
        <li>Security Measures (Prepared Statements/Passwords salted and hashed/valiation of user input/any other security features)</li>
        <p>- SQL Prepared statement are included in ____</p>
        <p>- hashing using sha2</p>
        <p>- User input in both registration form and login for are validated in their appropriate lib php files</p>
    </ul>
>>>>>>> 249209a4a2212a5fb3bbd4435b9eade82f658f04
    
    IMAGE SOURCES
    Logo: https://img00.deviantart.net/97e7/i/2010/301/0/0/pendulum_logo_by_ipodzanyman-d30bi0q.png
    Carosel:    1-http://desktop-backgrounds-org.s3.amazonaws.com/pendulum-celebrities.jpg
                2-https://ukf-cdn-2ezlhsfwy1f.stackpathdns.com/wp-content/uploads/2018/04/Pendulum-14th-April-2018-by-Luke-Dyson-IMG_1576-1024x683.jpg
                3-https://i1.wp.com/dancemusicnw.com/wp-content/uploads/2016/12/Pendulum_Philippe_Wuyts_Ultra2016.jpg?fit=1500%2C1000
                4-https://images.wallpaperscraft.com/image/pendulum_band_faces_glasses_cap_14322_1920x1080.jpg

</body>
</html>