<?php
?>

<script src="assets/jquery-3.2.1.js"></script>
<script src="js/AJAX.js"></script>
<script src="js/second.js"></script>
<link rel="stylesheet" href="css/common.css">


<div class="container">
    <div class="row justify-content-center"><h1>Users</h1></div>
</div>
<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr class="">
            <th class="th">Пользователь</th>
            <th class="th">Пароль</th>
            <th class="th">Удалить</th>
            <th class="th">Изменить пароль</th>
        </tr>
        </thead>

        <?php
        $n=0;
        foreach ($users as $user) {
            $n=$n+1;
            ?>
            <tr>
                <th><?php  echo $user['login']; ?></th>
                <th><input type='password' value=""
                           id="idInput<?php  echo $n ?>"
                           idItem="<?php  echo $user['id']; ?>"
                           onkeydown="PasswordChange(<?php  echo $n; ?>, event.keyCode)">
                </th>
                <th><div class="button button-color-3"
                         id="idButtonDelete<?php  echo $n ?>"
                         onclick="UserDelete(<?php  echo $n; ?>)">
                        Удалить
                    </div>
                </th>
                <th><div class="button button-color-2"
                         style="display: none"
                         id="idButton<?php  echo $n ?>"
                         onclick="PasswordWrite(<?php  echo $n; ?>)">
                        Изменить
                    </div>
                </th>
            </tr>
        <?php }; ?>
        <tr>
            <th><input type='text' value="" id="idInputAddLogin"></th>
            <th><input type='password' value="" id="idInputAddPassword"></th>
            <th><div class="button button-color-1"
                     id="idButtonAdd"
                     onclick="UserAdd()">
                    Добавить
                </div>
            </th>
        </tr>
    </table>




</div>

