<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light  ">
        <a class="navbar-brand" href="<?= base_url() ?>"> <img src="<?= base_url('public/assets/images/logo-white.png') ?>"
                                                        alt="Logo-Image" width="180px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">

                <li class="nav-item <?= activeLink() ?>">
                    <a class="nav-link" href="<?= base_url() ?>">Home</a>
                </li>
                <?php if($isLoggedIn): ?>
                    <li class="nav-item <?= activeLink('book/add') ?>">
                        <a class="nav-link" href="<?= base_url('book/add') ?>">New Book</a>
                    </li>
                <?php endif;  ?>
                <?php if(!$isLoggedIn): ?>
                    <li class="nav-item <?= activeLink('user/signup') ?>">
                        <a class="nav-link" href="<?= base_url('user/signup') ?>">Signup</a>
                    </li>
                <?php endif;  ?>
                <?php if(!$isLoggedIn): ?>
                    <li class="nav-item <?= activeLink('user/login') ?>">
                        <a class="nav-link" href="<?= base_url('user/login') ?>">Login</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item <?= activeLink('contact') ?>">
                    <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                </li>
                <?php if($isLoggedIn): ?>
                     <li class="nav-item profile-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= base_url('public/assets/images/avatar.png') ?>" width="40" height="40" class="rounded-circle profile-avatar">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item username-item" href="javascript:void(0)">Hi, <?= ucwords($userDetails['name']) ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout-btn" href="<?= base_url('user/logout') ?>">Log Out</a>
                            </div>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </nav>
</header>
