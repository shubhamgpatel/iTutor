<?php require_once "../includes/adminHeader.php" ?>
<?php
require_once "../vendor/autoload.php";


$db = Database::getDb();
$u = new UserAdminContext();
$userdetails = $u->ListAll();


if (isset($_POST["delete"])) {
    $userId = $_POST["userId"];

    $db = Database::getDb();
    $u = new UserAdminContext();
    $numRowsAffected = $u->Delete($userId);
    if ($numRowsAffected) {
        $u = new UserAdminContext();
        $userdetails = $u->ListAll();
    } else {
        echo "problem deleting data";
    }
}

if (isset($_POST["searchuser"])) {
    $usersearchkey = $_POST["usersearchkey"];
    $u = new UserAdminContext();
    $userdetails = $u->Search($usersearchkey, isset($_POST['userRole']) ? $_POST['userRole'] : "");
}
?>
<?php require_once "../includes/adminHeader.php" ?>
<main class="adminmain admin-mock-tests">
    <div class="section no-pad-bot" id="index-banner">
        <div class="row">
            <div class="col s10 m6 l12">
                <h5 class="breadcrumbs-title">Users</h5>
            </div>
            <div class="row">
                <form method="POST">
                    <div class="input-field col s12 m12 l4">
                        <input id="first_name" type="text" class="validate search-box" name="usersearchkey" value="<?= (isset($_POST['usersearchkey'])) ? $_POST['usersearchkey'] : "" ?>">
                        <label for="usersearchkey" class="serach-label">Search users...</label>
                    </div>

                    <div class="input-field col s12 m12 l4">
                        <select class="browser-default" name="userRole">
                            <option value="" disabled selected>Select role</option>
                            <option value="">All Users</option>
                            <option value="1" <?= (isset($_POST['userRole']) && $_POST['userRole'] == "1") ? "selected" : "" ?>>Admin</option>
                            <option value="2" <?= (isset($_POST['userRole']) && $_POST['userRole'] == "2") ? "selected" : "" ?>>Tutor</option>
                            <option value="3" <?= (isset($_POST['userRole']) && $_POST['userRole'] == "3") ? "selected" : "" ?>>Student</option>
                        </select>
                    </div>

                    <div class="input-field col s12 m12 l2">
                        <button class="btn waves-effect waves-light" type="submit" name="searchuser">Search
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <div class="direction-top">
                                <a title="Add Leaning Material" href="addUser.php" class="btn-floating btn-large green floatright">
                                    <i class="large material-icons">add</i>
                                </a>
                            </div>

                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($userdetails as $userdetail) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><a href="showUser.php?id=<?= $userdetail->id ?>"><?= $userdetail->first_name; ?></a></td>
                                            <td><?= $userdetail->email; ?></td>
                                            <td><?= $userdetail->phone_number; ?></td>
                                            <td><?= $userdetail->user_role; ?></td>

                                            <td>
                                                <a href="updateUser.php?id=<?= $userdetail->id; ?>"><i class="material-icons blue-text">create</i></a>
                                                <?PHP
                                                $modalId = "modal" . $userdetail->id;
                                                ?>
                                                <a class="modal-trigger" href="#<?= $modalId ?>" name="delete"><i class="material-icons red-text">delete</i></a>
                                                <div id="<?= $modalId ?>" class="modal">
                                                    <div class="modal-content">
                                                        <h4><?= $userdetail->first_name; ?></h4>
                                                        <p>Are you sure you want to delete this user?</p>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="userId" value="<?= $userdetail->id ?>">
                                                            <a class="modal-close waves-effect waves-red btn-flat">No</a>
                                                            <button class="btn waves-effect waves-light" type="submit" name="delete">Yes</button>
                                                        </div>
                                                    </form>

                                            </td>
                                        </tr>


                                    </tbody>
                                <?php } ?>
                            </table>

                            <ul class="pagination">
                                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a>
                                </li>
                                <li class="red"><a href="#!">1</a></li>
                                <li class="waves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!">3</a></li>
                                <li class="waves-effect"><a href="#!">4</a></li>
                                <li class="waves-effect"><a href="#!">5</a></li>
                                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<?php require_once "../includes/adminFooter.php" ?>