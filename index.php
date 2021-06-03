<?php require_once "connection_database.php"; ?>
<?php include "_head.php"; ?>
<?php include "modal.php"; ?>
<div class="container" style="color: white">
    <h1>All existing animals</h1>
    <a class="btn btn-success" href="addAnimal.php">Add new animals to shop</a>
    <table class="table table-success" style="color: white; margin-top: 20px; font-size: 16px; font-family: 'Cambria Math'">
        <thead>
        <tr>
            <th>#</th>
            <th>Animals</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <?php
        $command = $dbh->prepare("SELECT id, name, image FROM animals");
        $command->execute();
        while ($row = $command->fetch(PDO::FETCH_ASSOC))
        {
            echo"
            <tr>
            <td><b>{$row["id"]}</b></td>
            <td><b>{$row["name"]}</b></td>
            <td><b>{$row["image"]}</b></td>
            <td></td>
            <td>
            <a class='btn btn-light' href='editAnimal.php?id=${row["id"]}'>Edit  <i class='far fa-edit'></i></a>
                <button  onclick='loadDeleteModal(${row["id"]})' data-toggle='modal' data-target='#modalDelete' class='btn btn-danger'>Delete<i class='fas fa-trash-alt'></i></button>
            </td>
            </tr>";
        }
        ?>
    </table>
    </div>
<script>
    function loadDeleteModal(id)
    {
        $(`#modalDeleteContent`).empty();
        $(`#modalDeleteContent`).append(`<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete animal ${id}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form action="deleteAnimal.php" method="post">
                <input type='hidden' name='id' value='${id}'>
                <button type="submit" name="delete_submit" class="btn btn-danger">Delete</button>
            </form>
        </div>`);
    }
</script>




<?php include "_footer.php"; ?>