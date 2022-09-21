<link rel="stylesheet" type="text/css" href="admin_sidebar.css">     
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>

<div class="sidebar">
    
      <p><strong>WEB PROJECT</strong></p>
      <header>

      <?php echo 'logged in as :<br>'. '<i class="fas fa-user-alt"></i>'.$_SESSION["username"]?>
            
      </header>
      
      <br>
       
      <a href="admin_login.php" class="initial">
       <span>App Info</span>
      </a>
          
      
      

      <a href="admin_upload.php">  
        <span>Upload</span>
      </a>

      <a href="admin_delete.php">
        <span>Delete</span>
      </a>
      <br>
      <br>
      <br>
      <br>
     
      <a href="../index.php">
        <span>Logout</span>
      </a>
    </div>