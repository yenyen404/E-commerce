<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload file</title>
</head>
<body>
    <h2>Upload File</h2>
    
    <form method="POST" enctype="multipart/form-data">
        <label>select file</label><br>
        <input type="file" name="file" required>
        

        <label>File type</label>
        <select name="category" required>
            <option value="PPT">PPT</option>
            <option value="Excel">Excel</option>
            <option value="Word">Word</option>
            <option value="Image">Image</option>
            <option value="Video">Video</option>
        </select><br><br>

        <table border="1">
            <thead>
            <tr>
                <th>id</th>
                <th>filename</th>
                <th>mimetype</th>
                <th>filedata</th>
                <th>category</th>
            </tr>
            </thead>

            <?php
            $sql = "SELECT * FROM files";
            $result = $conn->query($sql);
            ?>
            <tbody>
                <?php
                if($result->num_rows > 0){
                    while($file = $result->fetch_assoc()){

                ?>
            <tr>
                <td><?php echo $file['id'];?> </td>
                <td><?php echo $file['filename']; ?></td>
                <td><?php echo $file['mimetype'];?></td>
                <td><a href="<img src="img.php?id=<?php echo $file['id'];?>" alt="<?php echo $file['filename'];?>">download</a></td>
                <td><?php echo $file['filecategory'];?></td>
            </tr>
            <?php
                    }
                }else{
                    echo"<tr><td colspan='5'>NO FILE FOUND</td></tr>";
                }
               
            

            ?>
        </tbody>
        </table>

        <button type="submit" name="upload">Upload</button>
    </form>
    <?php
    if(isset($_POST["upload"])){

        $filename = $_FILES["file"]["name"];
        $mimetype = $_FILES["file"]["type"];
        $filedata = file_get_contents($_FILES["file"]["tmp_name"]);
        $category = $_POST["category"];

        // priniprepare
        $stnt = $conn->prepare("INSERT INTO files (filename, filecategory, mimetype, filedata) VALUE (?, ?, ?, ?)"
        );

        // pinag sama sama
        $stnt->bind_param("ssss", $filename, 
        $category, $mimetype, $filedata);
        
        // e execute
        if($stnt->execute()){
            echo"<p style='color:green'>File uploaded and saved in database</p>";
        }else{
            echo"<p style='color:red;'>Upload Failed</p>";
        }

    }
 $conn->close();
    ?>
    
</body>
</html>