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

    $isbn= $_POST['isbn'];
    $name= $_POST['bname'];
    $publisher= $_POST['pub'];
    $quantity= $_POST['quantity'];

    $query="SELECT* FROM books WHERE isbn='$isbn'";
    $result= $conn->query($query);

    if ($result->num_rows>0) {

        while($row= $result->fetch_assoc()){
            $num= intval($row['quantity'])-intval($quantity);
            $num= strval($num);
        }
        $stmt=$conn->prepare("UPDATE books SET quantity = ? WHERE isbn = ?");
        $stmt->bind_param("ss",$num,$isbn);
        $stmt->execute();

        echo'<p class="message">Quantity of book is reduced Successfully.</p>';
        $stmt->close();

    } 

    else {
        echo'<p class="message">Entered data does not exist.'.'<br>';
        echo'Click below to try again filling the data.'.'<br></p>';
        echo'<form action="http://localhost/Library/delete.html" method="POST"> 
            <input type="submit" value="Try again" class="button_again"/>
            </form>
            ';
    }

    
    echo'</body>';

    $conn->close();
?>