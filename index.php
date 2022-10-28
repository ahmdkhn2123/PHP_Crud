<html>
    <head>
        <title>PHP CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">

        <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']); 
        ?>

        </div>

    <?php endif; ?>

    <?php
    $mysqli= new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result=$mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>

     <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
     <?php while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>

            </td>
        </tr>   
    <?php endwhile; ?>
        </table>
     </div>
  
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <div class="col-md-5" style="margin:auto;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Your name" class="form-control" value="<?php echo $name; ?>">
                <label>Location</label>
                <input type="text" name="location" placeholder="Enter Your location" class="form-control" value="<?php echo $location; ?>">

                <?php if($update==true): ?>
                    <button type="submit" name="update" class="btn btn-info form-control">update</button>
                <?php else: ?>
                    <button type="submit" name="save" class="btn btn-success form-control">save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
    </body>
</html>