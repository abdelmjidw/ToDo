<?php
$conn = new PDO("mysql:host=localhost;dbname=todo", "root", "");

$query = $conn->prepare("SELECT * from list");
$query->execute();
$list = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="contr">
        <form method="post" action="coni.php">
            <input class="in" type="text" name="do" placeholder="ADD">
            <button class="add btn btn-success">ADD</button>
        </form>
        <?php foreach ($list as $do) : ?>
            <div class="todo">
                <div class="list" style="color: white; text-align: center;"><?= $do->do ?></div>

                <form method="post" action="delete.php" class="ms-2">
                    <input type="hidden" name="id" value="<?= $do->id ?>">
                    <button class="delBtn btn btn-outline-danger">DEL</button>
                </form>

                <form method="post" action="update.php" class="ms-1 d-flex updateForm">
                    <input type="hidden" name="id" value="<?= $do->id ?>">
                    <input class="form-control me-2 updateInput" type="hidden" name="new_do" placeholder="Update" value="<?= $do->do ?>" required>
                    <button type="button" class="updateBtn btn btn-outline-primary">UPD</button>
                </form>


                <input class="chek todoCheck" id="check" type="checkbox">
            </div>
        <?php endforeach; ?>
    </div>
    <script>
$(document).ready(function() {
    // تأكيد الحذف
    $('.delBtn').click(function(event) {
        if (!confirm("Are you sure you want to delete this item?")) {
            event.preventDefault();
        }
    });

    // التأكد من صحة الإدخال في نموذج الإضافة
    $('#addForm').submit(function() {
        let inputVal = $(this).find('input[name="do"]').val().trim();
        if (inputVal === "") {
            alert("Please enter a valid to-do item.");
            return false;
        }
        return true;
    });

    // التأكد من صحة الإدخال في نماذج التحديث
    $('form[action="update.php"]').submit(function() {
        let inputVal = $(this).find('input[name="new_do"]').val().trim();
        if (inputVal === "") {
            alert("Please enter a valid update item.");
            return false;
        }
        return true;
    });

    // حدث عند النقر على زر التحديث
    $('.updateBtn').click(function() {
        var form = $(this).closest('form');
        var listItem = form.find('.updateInput');
        var newText = prompt("Update your item:", listItem.val());

        if (newText !== null && newText.trim() !== "") {
            listItem.val(newText);
            form.submit();
        } else {
            alert("Please enter a valid update item.");
        }
    });

    // تغيير الشفافية عند تحديد خانة الاختيار
    $('.todoCheck').change(function() {
        if ($(this).is(':checked')) {
            $(this).closest('.todo').css('opacity', 0.5);
        } else {
            $(this).closest('.todo').css('opacity', 1);
        }
    });
});

    </script>
</body>


</html>