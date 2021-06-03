<?php require_once "connection_database.php"; ?>
<?php
$name = "";
$image_url = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $image_url = $_POST['image'];
    $errors = [];
    if (empty($name)) {
        $errors["name"] = "Name is required";
    } else if (empty($image_url)) {
        $errors["image"] = "Image url is required";
    }else{
        $stmt = $dbh->prepare("INSERT INTO animals (id, name, image) VALUES (NULL, :name, :image);");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image_url);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>


<?php include "_head.php"; ?>

    <div class="container">
        <div class="p-3">
            <h2>Add new animal</h2>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Animal: </label>
                    <?php
                        echo "<input type='text' name='name' class='form-control' id='exampleInputEmail1'
                           placeholder='Enter animal' value={$name}>"
                    ?>

                    <?php
                        if(isset($errors['name']))
                            echo "<small class='text-danger'>{$errors['name']}</small>"
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price: </label>
                    <?php
                    echo "<input type='text' name='image' class='form-control' id='exampleInputEmail1'
                           placeholder='Enter price' value={$image_url}>"
                    ?>
                    <?php
                        if(isset($errors['image']))
                            echo "<small class='text-danger'>{$errors['image']}</small>"
                    ?>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>

<?php include "_footer.php"; ?>