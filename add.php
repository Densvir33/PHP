<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_POST["name"];
    $image=$_POST["image"];

    //echo"<h2>{$_POST["name"]}</h2>>";
    //echo"<h2>{$_POST["image"]}</h2>>";
include "connection_database.php";
    $sql = "INSERT INTO animals (name, image) VALUES (?,?)";
    $dbh->prepare($sql)->execute([$name, $image]);
    header("Location:/");
exit;
}
?>

<?php include "_head.php"?>
<h1>Додати нову тварину </h1>

<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">NAME</label>
        <input type="text" class="form-control" id="name" name="name" required >
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">FOTO</label>
        <input type="text" class="form-control" id="image" name="image" required>
    </div>

    <button type="submit" class="btn btn-primary">ADD</button>
</form>

<?php include "_footer.php"?>

