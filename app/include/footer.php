<!--Блок footer-->

<?php $errMsg=[];?>

<div class="footer container-fluid">
    <div class="footer-content container">
        <div class="row">
            <div class="footer-section about col-md-4 col-12">
                <h3 class="logo-text">Поэтика</h3>
                <p>
                    Поэтика - это сайт сделанный с целью пропоганды творчества в обществе.
                </p>
                <div class="contact">
                    <span><i class="fas fa-phone"></i>&nbsp;8-937-674-21-01</span>
                    <span><i class="fas fa-envelope"></i>&nbsp;sportatip@mail.ru</span>
                </div>
                <div class="socials">
                    <a href="https://vk.com/miracleinsaid"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a href="https://t.me/Nutprimus"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer-section links col-md-4 col-12">
                <h3>Quick Links</h3>

                <ul>
                    <a href="#">
                        <li>Писатели и поэты</li>
                    </a>
                    <a href="<?php echo BASE_URL . 'info.php'; ?>">
                        <li>О нас</li>
                    </a>
                    <a href="<?php echo BASE_URL . 'app/include/dialog.php'; ?>">
                        <li>Помощь</li>
                    </a>
                    <a href="<?php echo BASE_URL . 'registration.php'; ?>">
                        <li>Зарегистрироваться</li>
                    </a>
                </ul>
            </div>
            <div class="footer-section contact-form col-md-4 col-12">


                <h3>Форма обратной связи</h3>
               
                <form action="C:/Ampps/www/my-web_site/app/include/mail.php" method="post">
                 
                    <input type="email" name="email" class="text-input contact-input" placeholder="Ваша почта...">
                    <textarea rows="4" name="message" class="text-input contact-input" placeholder="Ваше сообщение..."></textarea>
              
                    <button type="submit" name="mess" class="btn-big contact-btn">
                        <i class="fas fa-envelope"></i>
                        Отправить
                    </button>
                </form>
            </div>
        </div>
        <br>
        <div class="footer-bottom">
            &copy; poetica.ru | Designed by Volan
        </div>
    </div>
</div>

<!--Блок footer-->