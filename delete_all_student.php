<style>
  
  <?php include'C:\xampp\htdocs\Library\backendfile.css'; ?> 
  .hom_button{
    width: 8%;
    padding: 0.4%;
    margin-left: 46%;
    margin-right: 50%;
    margin-top: 0.3%;
    border-radius: 5px;
    border: 2px solid #058454;
    background-color: white;
    transition-duration: 0.4s;
    font-size: smaller;
  }
  .hom_button:hover{
      background-color: #058454;
      border: 2px solid #058454;
      color: white;
  }

</style>

<?php
    echo'<head><link rel="icon" href="C:\xampp\htdocs\Library\favicon.ico" type="image/x-icon"></head>';
    echo'<h1>Computer Department Library</h1>';
    echo'<body>';
    echo'<div>
            <form action="http://localhost/Library/home.html" method="POST"> 
                <input type="submit" value="Go to Home" class="hom_button"/>
            </form>
        </div>';
    $user="root";
    $password="kitu@99";
    $conn=  new mysqli("localhost",$user,$password,"library") ;
    if($conn->connect_errno){
        echo'<p class="message">Server is not connected.</p>';
        exit();
    }

    $query="DELETE FROM student";
    $res= $conn->query($query);

    $show_query="SELECT* FROM student";
    $result=$conn->query($show_query);
    if(!($result->num_rows>0)){
        
        echo'<p class="message" >All records are deleted Successfully.</p>';
    }
    
    else{
        
        echo'<p class="message">All records can not be deleted.</p>';
        echo'Click below to try again filling the data.'.'<br></p>';
        echo'<form action="http://localhost/Library/return_book.html" method="POST"> 
            <input type="submit" value="Try again" class="button_again"/>
            </form>
            ';
    }


    echo'</body>';

    $conn->close();

?>