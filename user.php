<?php
include("connection.php");


$client_id = uniqid(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Case_title = $_POST['Case_title'];
    $Case_description = $_POST['Case_description'];
    $Case_status = $_POST['Case_status'];
    $Case_type = $_POST['Case_type'];
    $Time = $_POST['Time'];
    $Date = $_POST['Date'];

    
    $sql = "INSERT INTO `table` (Case_title, Case_description, Case_type, Time, Date) 
            VALUES ('$Case_title', '$Case_description', '$Case_type', '$Time', '$Date')";

    if ($connection->query($sql) === TRUE) {
    
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add complain</title>
    <link rel="stylesheet" href="system.css">
    <link rel="stylesheet" href="ralph.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>

    <footer class="footer1">
        <div class="footer-section">
            <br>
            <a href="#" style="margin-left: 10px"><b>● Legal management</b></a>
        </div>
    </footer>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Legal management</span> </a>
                <div class="nav_list"> 
                    <a href="admin.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="user.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Add complain</span> </a> 
        
                </div>
            </div> 
            <a href="login.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">log out</span> </a>
        </nav>
    </div>
    
    
    <!--Container Main start-->


    <div class="container form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
   

            <div class="form-group">
                <label for="Case_title">Case Title</label>
                <input type="text" id="Case_title" name="Case_title" required>
            </div>
            
            <div class="form-group">
                <label for="Case_type">Case type</label>
                <input type="text" id="Case_type" name="Case_type" required>
            </div>

            <div class="form-group">
                <label for="Case_description">Case Description</label>
                <input type="text" id="Case_description" name="Case_description" required>
            </div>

            <!-- Hidden input field for Time -->
            <input type="hidden" id="Time" name="Time">

            <!-- New form groups for Date -->
            <div class="form-group">
                <label for="Date">Date</label>
                <input type="date" id="Date" name="Date" required>
            </div>
            <br>
            <center>
            <input type="submit" class="allroundbutton" value="Submit">
            </center>
        </form>
    </div>
    </div>
    </div>

    <!-- JavaScript to add current time and status -->
    <script>
function addCurrentTimeToForm() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12;
    const time = formattedHours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + ampm;

    // Add hidden input field for Time
    const timeInput = document.createElement('input');
    timeInput.type = 'hidden';
    timeInput.name = 'Time';
    timeInput.value = time;

    // Append hidden input to the form
    const form = document.querySelector('form');
    form.appendChild(timeInput);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[type="submit"]').addEventListener('click', addCurrentTimeToForm);
});
</script>


  
        <script>
        document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-x')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });
   </script>
   
</body>
</html>
