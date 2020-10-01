<section class="container-fluid main text-light p-0">
    <div class=" container-fluid p-0">
        <div class="row d-flex justify-content-center p-0 w-100 m-0">
            <div class="login-img col-md-6 p-0">
                <!-- <img src="images/LOGIN-SIDE-IMG.jpg" alt="" class="img-fluid"> -->
            </div>
            <!-- //////////////////////////// -->
            <div class="login-form col-md-6 p-0  ">
                <div class="form p-4 w-75 mx-auto">
                    <h1 class="text-center mb-5">SIGN UP</h1>
                    <form method="post" action="<?= base_url('user/postSignUp'); ?>" id="signupForm">
                        <?php Messages::display(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input value="<?= oldInput('name') ?>" type="text" name="name" class="form-control" id="exampleInputusername" aria-describedby="username" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input value="<?= oldInput('email') ?>" name="email"  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input value="" type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contact No</label>
                            <input value="<?= oldInput('contact_no') ?>" type="number" name="contact_no" class="form-control" id="exampleInputcontactno1" placeholder="Enter Contact no.">
                        </div>

                        <div class="Login-btns w-100  my-3 ">

                            <div class="d-block  mx-auto  ">
                                <button name="submit" type="submit" class="signup-btn btn btn-block" value="Sign Up" >Sign Up</button>
                            </div>
                            <div class="d-block  mx-auto  my-2"><a href="<?= base_url('user/login')?>" class="cancel-btn btn-danger btn btn-block">Already have an account? </a>
                            </div>
                            <div class="my-2 text-center"></div>

                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</section>
