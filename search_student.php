<style>

    <?php include'C:\xampp\htdocs\Library\backendfile.css'; ?>     

</style>

<?php
    echo'<head><link rel="icon" href="C:\xampp\htdocs\Library\favicon.ico" type="image/x-icon"></head>';
    echo'<h1>Computer Department Library</h1>';
    echo'<body>';
    echo'<form name="sorting" action="http://localhost/Library/sort_student.php" method="POST">
        <label>Sort By:
            <select name="sort">
                <option value="Issue date">Issue date</option>
                <option value="Due date">Due date</option>
                <option value="Enrolment No.">Enrolment No.</option>
                <option value="Student name">Student name</option>
                <option value="Book name">Book name</option>
            </select>
        </label>   
        <input type="submit" name="Sort" class="button"/>
    </form>';

    echo'<form name="searching" action="http://localhost/Library/search_student.php" method="POST">
        <label>Search: <input type="text" name="search" maxlength="30" placeholder="Enrolment, name, ISBN"/></label> 
        <input type="submit" value="Search" class="button"/>
    </form>';

        
    echo'<div>
            <form action="http://localhost/Library/home.html" method="POST"> 
                <input type="submit" value="Go to Home" class="home_button"/>
            </form>
        </div>';

    $count=1;
    $search_val=$_POST['search'];

    $conn=  new mysqli("localhost","root","kitu@99","library") ;
    if($conn->connect_errno){
        echo'<p class="message">Server is not connected.</p>';
        exit();
    }

    $query="SELECT* FROM student WHERE eno LIKE '%$search_val%' OR sname LIKE '%$search_val%' OR contact LIKE '%$search_val%' OR bname LIKE '%$search_val%' OR isbn='$search_val' #OR due_date='$search_val' OR issue_date='$search_val'";

    $result= $conn->query($query);

    echo'<p>Showing search result of: <b>"'.$search_val.'"</b></p>';
    echo'<table class="details">';
    echo'<tr style="background-color: #058454; color: white; text-transfrom: uppercase;">';
    echo'<th><b>Sr. No.</b></th><th><b>Enrolment No.</b></th><th><b>Student Name</b></th><th><b>Contact No.</b></th><th><b>Book Name</b></th><th><b>ISBN</b></th><th><b>Issue Date</b></th><th><b>Due Date</b></th>';
    echo'</tr>';

    if($result->num_rows>0){

         while($row= $result->fetch_assoc()){
                
            echo'<tr>';
            
            echo'<td class="a1"><b>'.$count.'<b></td>';
            echo'<td class="a2">'.$row['eno'].'</td><td class="a3">'.$row['sname'].'</td><td class="a4">'.$row['contact'].'</td><td class="a5">'.$row['bname'].'</td><td class="a6">'.$row['isbn'].'</td><td class="a7">'.$row['issue_date'].'</td><td class="a8">'.$row['due_date'].'</td>';
            
            echo"</tr>";
            $count++;
        }
    }
    else{
        echo'<tr>';
        echo'<td colspan="8" style="text-align:center;">No record found.</td>';
        echo'</tr>';
    }
    echo"</table>";
    
    echo'</body>';

    $conn->close();

?>