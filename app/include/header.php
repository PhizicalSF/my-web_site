<header class="container-fluid">
    <div class="container">
        <div class="row">

            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL ?>">Поэтика</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>

                    <li><a href="group.php"><i class="fa-solid fa-people-group"></i>Чат</a></li>

                    <li><a href="info.php"><i class="fa-solid fa-people-group"></i>О нас</a></li>
                   

                    <li>
                        <?php if (isset($_SESSION['login'])) : ?>
                            <a href="#">
                                <i class="fa-solid fa-user-large"></i>
                                <?php
                                echo $_SESSION['login'];
                                ?></a>
                            <ul>
                                <?php if ($_SESSION['admin_status']) : ?>
                                    <li><a href="<?php echo BASE_URL . 'admin/posts/index.php'; ?>">Админ панель</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . 'user/me/profile.php' ?>">Профиль</a></li>
                                <li><a href="<?php echo BASE_URL . 'logout.php' ?>">Выход</a></li>
                            </ul>
                        <?php else : ?>
                            <a href="<?php echo BASE_URL . 'login.php' ?>">
                                <i class="fa-solid fa-user-large"></i> Вход</a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'registration.php' ?>">Регистрация</a></li>
                            </ul>

                            <ul>
                            <?php endif; ?>

                    </li>

                </ul>
            </nav>
        </div>
    </div>
</header>