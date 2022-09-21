<link rel="stylesheet" type="text/css" href="user_sidebar.css">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>

<div class="sidebar">
    
      <p><strong>WEB PROJECT</strong></p>
      <header>

      
        <?php echo 'logged in as :<br>'. '<i class="fas fa-user-alt"></i>'.$_SESSION["username"]?>
            
      </header>
      
      <br>
       
      <a href="user_login.php" class="initial">
       <span>Your Location</span>
      </a>
          
      <a href="user_search_pois.php">  
        <span>Search Points Of Interest(POIs)</span>
      </a>

      <a href="user_visit.php"> 
        <span>Apply Visit</span>
      </a>

      <a href="user_covid_infection.php">  
        <span>Covid Infection</span>
      </a>

      <a href="user_possible_contact.php">  
        <span>Possible Contact</span>
      </a>

      <a href="user_data.php">
        <span>User Data</span>
      </a>
      <br>
      <br>
      <br>
      <br>
     
      <a href="../index.php">
        <span>Logout</span>
      </a>
    </div>