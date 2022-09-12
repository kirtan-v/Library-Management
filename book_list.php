<style>

    <?php include'C:\xampp\htdocs\Library\backendfile.css'; ?>    

</style>



<?php

    echo'<head><link rel="icon" href="C:\xampp\htdocs\Library\favicon.ico" type="image/x-icon"></head>';    
    echo'<h1>Computer Department Library</h1>';
    echo'<body>';
    echo'<div><form name="sorting" action="http://localhost/Library/sortbooks.php" method="POST">
            <label>Sort By:
                <select name="sort">
                    <option value="Name">Name</option>
                    <option value="Publisher">Publisher</option>
                    <option value="Not available">Not available</option>
                </select>
            </label>   
            <input type="submit" name="Sort" class="button"/>
        </form>';

    echo'<form name="searching" action="http://localhost/Library/searchbook.php" method="POST">
            <label>Search: <input type="text" name="search" maxlength="30" placeholder="book name, publisher, ISBN"/></label> 
            <input type="submit" value="Search" class="button"/>
        </form></div>';

        
        echo'<div>
                <form action="http://localhost/Library/home.html" method="POST"> 
                    <input type="submit" value="Go to Home" class="home_button"/>
                </form>
            </div>';

    $n_a='Not available';
    $count= 1;

    $conn=  new mysqli("localhost","root","kitu@99","library") ;
    if($conn->connect_errno){
        echo'<p class="message">Server is not connected.</p>';
        exit();
    }

    $query= "select* from books";
    $result= $conn->query($query);

    echo'<table class="details">';
    echo'<tr style="background-color: #058454; color: white; text-transfrom: uppercase;">';
    echo'<th><b>Sr. No.</b></th><th><b>Name</b></th><th><b>Publisher</b></th><th><b>ISBN</b></th><th><b>Quantity</b></th>';
    echo'</tr>';

    if($result->num_rows>0){

        while($row= $result->fetch_assoc()){

            $flag=$row['quantity'];
            if ($flag==0) {
                $str=$n_a;
            } else {
                $str=$flag;
            }
                
            echo'<tr>';
            
            echo'<td class="a1"><b>'.$count.'<b></td>';
            echo'<td class="a2">'.$row['name'].'</td><td class="a3">'.$row['publisher'].'</td><td class="a4">'.$row['isbn'].'</td><td class="a5">'.$str."</td>";
            
            echo"</tr>";
            $count++;
        }
    }
    else{
        echo'<tr>';
        echo'<td colspan="5" style="text-align:center;">No record found.</td>';
        echo'</tr>';
    }


    echo"</table>"; 
    echo'</body>';


    $conn->close();

?>