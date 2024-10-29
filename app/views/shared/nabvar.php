<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">

        <a href="<?php echo URLROOT; ?>" class="navbar-brand"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <?php if(isset($_SESSION['user_id'])): ?>
                
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>" class="nav-link">Home <span class="sr-only">(Current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/paginas/about" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/posts" class="nav-link">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">Salir</a>
                </li>

                <?php else: ?>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>" class="nav-link">Home <span class="sr-only">(Current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/paginas/about" class="nav-link">About</a>
                </li>    
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/users/register" class="nav-link">Registrar <span class="sr-only">(Current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URLROOT; ?>/users/login" class="nav-link">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>