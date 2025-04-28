<nav>
    <div>
        <a href="<?php echo URLROOT; ?>"><? echo SITENAME; ?></a>
    </div>
    <div>
        <a href="<?php echo URLROOT; ?>">Home - Current(😊)</a>
        <a href="<?php echo URLROOT; ?>/paginas/about">About</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="<?php echo URLROOT; ?>/users/logout">Salir</a>
        <?php else: ?>    
            <a href="<?php echo URLROOT; ?>/users/register">Registrar</a>
            <a href="<?php echo URLROOT; ?>/users/login">Login</a>
        <?php endif; ?>
    </div>
</nav>