<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
th, td {
    border: 1px solid black;
    padding: 7px 20px;
}
.select_query img {
    max-width: 50px;
}
       </style> 
</head>
<body>
<?php require_once('db.php'); 

if(isset($_GET['did'])){
        $deleteid = $_GET['did'];
       $query3 = "DELETE FROM posts WHERE pid = $deleteid" ;
      mysqli_query($conn, $query3);
     
      header("Location: http://localhost/php/");
 }
   

?>

    <div class="select_query">
        <h2>Select Query</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Content</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $query = 'select * from posts';
            $row = mysqli_query($conn, $query);
            
            while($result = mysqli_fetch_assoc($row)){ ?>
                <tr>
                    <td><?php echo $result['pid'] ?></td>
                    <td><?php echo $result['pname'] ?></td>
                    <td><?php echo $result['pcontent'] ?></td>
                    <td><img src="upload/<?php echo $result['pimg'] ?>"></td>
                    <td><a href="?uid=<?php echo $result['pid'] ?>">Edit</a></td>
                    <td><a href="?did=<?php echo $result['pid'] ?>">Delete</a></td>
                </tr>
            <?php 
            }
            ?>          
    </table>
    </div>
    <div class="insert_query">
        <h2>Insert Query</h2>    
        <?php 
 
        if(isset($_POST['insert_data'])){
            $filename = $_FILES["uploadfile"]["name"];
            $filetmp = $_FILES["uploadfile"]["tmp_name"];
             move_uploaded_file($filetmp, 'upload/'.$filename);
             
         $p_name =  $_POST['name'];
         $p_content =  $_POST['content'];
             
               $query2 = "INSERT INTO posts (pname, pcontent, pimg ) values ('".$p_name."', '".$p_content."', '".$filename."')" ;
              mysqli_query($conn, $query2);
            
              header("Location: http://localhost/php/");
        }
        ?>    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name"><br>
            <textarea placeholder="Type Something" name="content"></textarea><br>
            <input type="file" name="uploadfile"><br>
            <input type="submit" name="insert_data" value="Submit">
    </form>
    <?php 
 

    if(isset($_GET['uid'])){ 
        $updateid = $_GET['uid'];
        $query4 = "select * from posts WHERE pid = $updateid";
        $result = mysqli_query($conn, $query4);
        $row4 = mysqli_fetch_assoc($result);
 
        ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input value="<?php echo $row4['pname'] ?>" type="text" name="uname" placeholder="Name"><br>
            <textarea placeholder="Type Something" name="ucontent"><?php echo $row4['pcontent'] ?></textarea><br>
            <input type="file" name="updateuploadfile"><br>
            <input type="submit" name="update_data" value="Submit">
    </form>
    <?php 
    
}

if(isset($_POST['update_data'])){
    $ufilename = $_FILES["updateuploadfile"]["name"];
    $ufiletmp = $_FILES["updateuploadfile"]["tmp_name"];
        move_uploaded_file($ufiletmp, 'upload/'.$ufilename);
    $p_name =  $_POST['uname'];
        $p_content =  $_POST['ucontent'];
    $query3 = "UPDATE posts pname SET pname='".$p_name."' , pcontent='".$p_content."', pimg='".$ufilename."' WHERE pid = $updateid";
    $row = mysqli_query($conn, $query3);
    header("Location: http://localhost/php/");
}

    ?>
    
    </div>
</body>
</html>