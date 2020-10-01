<section class="container-fluid main text-light p-0">
    <div class=" container-fluid p-0">
        <div class="row d-flex justify-content-center p-0 w-100 m-0">
            <div class="login-img col-md-6 p-0">
                <!-- <img src="images/LOGIN-SIDE-IMG.jpg" alt="" class="img-fluid"> -->
            </div>
            <!-- //////////////////////////// -->
            <div class="login-form col-md-6 p-0  ">
                <div class="form p-4 w-75 mx-auto">
                    <h1 class="text-center mb-5">LOGIN</h1>
                    <form method="post" action="<?= base_url('user/postLogin'); ?>" id="loginForm">
                        <?php Messages::display(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="Enter email" value="<?= oldInput('email') ?>">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="Password" value="">
                        </div>
<!--                        <div class="form-check">-->
<!--                            <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--                            <label class="form-check-label" for="exampleCheck1">Remember me</label>-->
<!--                        </div>-->
                        <div class="Login-btns w-100  my-4 ">

                            <div class="d-block  mx-auto  ">
                                <button name="submit" type="submit" class="login-btn btn btn-block" value="Login">
                                    Login
                                </button>
                            </div>

                            <div class="my-2 text-center"></div>
                            <div class="register">
                                <p class="text-center">Not yet a Member ? <span><a href="<?= base_url('user/signup')?>"
                                                                                   class="link-color">Register here</a></span>
                                </p>
                            </div>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</section>