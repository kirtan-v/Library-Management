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


    $eno= $_POST['eno'];
    $sname= $_POST['sname'];
    $contact= $_POST['contact'];
    $isbn= $_POST['isbn'];
    $cur_date= date("Y-m-d");

    $temp_date= date_create($cur_date);
    date_add($temp_date,date_interval_create_from_date_string("15 days"));
    $due_date= date_format($temp_date,"Y-m-d");


    $conn=  new mysqli("localhost",$user,$password,"library") ;
    if($conn->connect_errno){
        echo'<p class="message">Server is not connected.</p>';
        exit();
    }

    $query="SELECT* FROM books WHERE isbn='$isbn'";
    $result=$conn->query($query);
    if($result->num_rows>0){
        
        while ($row=$result->fetch_assoc()) {
            $bname= $row['name'];
            $num= $row['quantity'];

            if ($num>0) {   
                $stud_stmt= $conn->prepare("INSERT INTO student(eno,sname,contact,bname,isbn,issue_date,due_date) VALUES(?,?,?,?,?,?,?)");
                $stud_stmt->bind_param("sssssss",$eno,$sname,$contact,$bname,$isbn,$cur_date,$due_date);
                $flag= $stud_stmt->execute();
                        
                if($flag==true){
                    $num--;
                    $stmt=$conn->prepare("UPDATE books SET quantity = ? WHERE isbn = ?");
                    $stmt->bind_param("ss",$num,$isbn);
                    $stmt->execute();

                    echo'<p class="message">';
                    printf("[%s] book is issued.",$bname);
                    echo'<br>';
                    echo'Student details are added successfully.'.'<br>';
                }
                else{
                    echo'<p class="message">';
                    echo'Student can not issue a same book more than once at a time.'.'<br>';
                    echo'Student can issue the same after returning it!';
                    echo'<br>';
                }
                
            } 

            elseif($num==0) {
                echo'<p class="message" >This book is not available'.'<br>';
                echo'Go to home page.'.'<br>';           
            }

            echo'Want to issue another book?'.'<br>';
            echo'Click "Issue" then!'.'<br></p>';
            echo'<form action="http://localhost/Library/issue_book.html" method="POST"> 
                <input type="submit" value="Issue" class="button_again"/>
                </form>
                ';
        }
        

    }
    else{
        echo'<p class="message" >This book does not exist in database.'.'<br>';
        echo'Click "Try again" to fill the correct data for issuing a book.'.'<br></p>';
        echo'<form action="http://localhost/Library/issue_book.html" method="POST"> 
            <input type="submit" value="Try again" class="button_again"/>
            </form>
            ';
        }



    $conn->close();

?>