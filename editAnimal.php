<?php require_once "connection_database.php"; ?>
<?php
$id = null;
$name = "";
$image = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET["id"];
    $command = $dbh->prepare("SELECT id, name, image FROM animals WHERE id = :id");
    $command->bindParam(':id', $id);
    $command->execute();
    $row = $command->fetch(PDO::FETCH_ASSOC);
    $name = $row['name'];
    $image = $row['image'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $id = $_POST['id'];
    $errors = [];
    if (empty($name)) {
        $errors["name"] = "Name is required";
    } else if (empty($image)) {
        $errors["image"] = "Image url is required";
    } else {
        $stmt = $dbh->prepare("UPDATE animals SET name = :name, image = :image WHERE animals.id = :id;");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>


<?php include "_head.php"; ?>

<script>
    function updateAnimal() {
        $(`#name_error`).attr("hidden",true);
        $(`#name_error`).attr("hidden",true);
        var name = document.forms[`editAnimal`][`name`];
        var image = document.forms[`editAnimal`][`image`];
        if (name.value=='') {
            $(`#name_error`).attr("hidden",false);
            event.preventDefault()
        } else if(image.value==''){
            $(`#image_error`).attr("hidden",false);
            event.preventDefault();
        }
    }
</script>

<div class="container">
    <div class="p-3">
        <h2>Edit animal</h2>
        <form name="editAnimal" onsubmit="return updateAnimal();" method="post">
            <?php
            if ($id != null)
                echo "<input name='id' value='$id' hidden>"
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Animal: </label>
                <?php
                echo "<input type='text' name='name' class='form-control' id='exampleInputEmail1'
                           placeholder='Enter new animal' value={$name}>"
                ?>

                <?php
                if (isset($errors['name']))
                    echo "<small class='text-danger'>{$errors['name']}</small>"
                ?>
                <small class='text-danger' id="name_error" hidden>Animal is required!</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price: </label>
                <?php
                echo "<input type='text' name='image' class='form-control' id='exampleInputEmail1'
                           placeholder='Enter animal name' value={$image}>"
                ?>

                <?php
                if (isset($errors['image']))
                    echo "<small class='text-danger'>{$errors['image']}</small>"
                ?>

                <small class='text-danger' id="image_error" hidden>Price is required!</small>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Save changes</button>
        </form>
    </div>
</div>


<?php include "_footer.php"; ?>
