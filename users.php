<?php
include 'db.php';
session_start();

if (!($_SESSION['role'] == 'admin')) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["ban_btn"])) {
    
    banUser($_POST['user_id']);
}

if (isset($_POST["unban_btn"])) {
        
        unbanUser($_POST['user_id']);
}

if(isset($_POST['role'])){

    $peremennoe = updateRole($_POST['user_id'], $_POST['role']);


   
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>


    <div class="sidebar container">
        <div class="mt-2">
        <a class="active" href="admin.php">Главная</a>
        </div>
        <div class="mt-2">
        <a href="users.php">Пользователи</a>
        </div>
        <div class="mt-2">
        <a href="categories.php">Категории</a>
        </div>
    </div>
    

    <div class="main">
        <div class="container mt-4">
            <h2>Пользователи</h2>

            <table class="table mt-2 roles_table">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Логин</th>
                        <th>Роль</th>
                        <th>Действия</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sqlUsers = "SELECT * FROM users";

                    $resultUsers = $conn->query($sqlUsers);

                    foreach($resultUsers as $user):
                    ?>
                    <tr>
                        <td><?php echo $user['first_name'] ?></td>
                        <td><?php echo $user['last_name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['role'] ?></td>
                        <td>
                            <form id="role_form" action="" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                            <select class="roles" name="role" id="role_select_<?php echo $user['id'] ?>">
                                <option <?php if($user['role'] == 'admin'): ?> selected <?php endif; ?> value="admin">admin</option>
                                <option <?php if($user['role'] == 'moderator'): ?> selected <?php endif; ?> value="moderator">moderator</option>
                                <option <?php if($user['role'] == 'user'): ?> selected <?php endif; ?> value="user">user</option>
                            </select>
                            </form>
                        </td>
                        <td>
                            <?php if (!$user['banned']): ?>
                                <form action="" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                                <button name="ban_btn">Заблокировать</a>
                                </form>
                            <?php else: ?>
                                <form action="" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                                <button name="unban_btn" style="background-color: red">Разблокировать</a>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php include 'footer.php' ?>


    <script>
        $(document).ready(function() {
            $('.roles').change(function() {
                var role = $(this).val();
                var user_id = $(this).parent().find('input[name="user_id"]').val();
                var form = $(this).parent();
                $.ajax({
                    url: 'users.php',
                    type: 'post',
                    data: {
                        'role': role,
                        'user_id': user_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 'success') {
                            form.append('<div class="alert alert-success">Роль успешно обновлена</div>');
                            setTimeout(function() {
                                $('.alert-success').remove();
                            }, 2000);
                        } else {
                            form.append('<div class="alert alert-success">Роль успешно обновлена</div>');
                            setTimeout(function() {
                                $('.alert-success').remove();
                            }, 2000);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
