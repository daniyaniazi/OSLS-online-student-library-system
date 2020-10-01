<main class="container-fluid main text-light ">
    <div class=" mx-5 my-5">
        <div class="row justify-content-center -0">
            <!-- align-items-center -->
            <div class="aboutus col-md-6 ">
                <h1 class="my-4">OSLS MISSION </h1>
                <P class="">
                    Online Student Library System aims to provide valuable and helpful content to students all around the world so that they can have good academics grades as well as have a good understanding of the topic. The content available here is beneficial for students
                    of any level (i.e. from school level to researcher). Not only that we provide books written by famous authors, but we also provide self-notes written by students so they may be helpful for other students to get instant knowledge
                    about various topics. We have a diverse range of subjects and topics, that’ll help the reader to understand the topic from beginning to the current researches with the depth of coverage.
                </P>
                <P>
                    Our mission is to support the academic and scholarly endeavors of our users, in their core academics and research requirements through utilizing the best possible resources, systems, and services.</P>
                <div class=" text-center mr-5">
                    <img src="<?= base_url('public/assets/images/transparent/full-logo-black.png') ?>" alt="" width="400PX" class="img-fluid my-2">
                </div>
            </div>
            <!-- ////////////////////////////////// -->
            <div class="contactus col-md-6 px-2 ">
                <h1 class="my-4 mx-auto">CONTACT US </h1>
                <form class="w-75 mx-auto" method="post" action="<?= base_url('contact/send'); ?>" id="contactForm">
                    <?php Messages::display(); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <textarea name="message" id="" rows="5" class="d-block" placeholder="Type your message here :)"></textarea>

                    <button class="btn  btn-submit my-5 " name="submit" type="submit" value="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</main>
<section class="team-meet container-fluid main text-light p-5 ">
    <h1>MEET OUR TEAM</h1>
    <div class="row  d-flex justify-content-center  align-items-between text-center team-row ">
        <div class="staff-mem col-sm-3 col-md-4 ">
            <div class="staff-img">
                <img src="<?= base_url('public/assets/images/b3img2.png') ?>" alt="" width="200px" class="rounded-circle img-fluid">
            </div>
            <h6 class=" mt-2 font-weight-bold">DANIYA</h6>
            <p class="">Owner OSLS</p>
            <p> Bachelors of Computer Science and Information Technology (in progress) </p>
        </div>
        <!--  -->
        <div class="staff-mem col-sm-3 col-md-4 ">
            <div class="staff-img">
                <img src="<?= base_url('public/assets/images/b3img2.png') ?>" alt="" width="200px" class="rounded-circle img-fluid">
            </div>
            <h6 class=" mt-2 font-weight-bold">SYEDA TOOBA ALI</h6>
            <p class="">CEO OSLS</p>
            <p> Bachelors of Computer Science and Information Technology (in progress) </p>
        </div>
        <!--  -->
        <div class="staff-mem col-sm-3 col-md-4 ">
            <div class="staff-img">
                <img src="<?= base_url('public/assets/images/b3img2.png') ?>" alt="" width="200px" class="rounded-circle  img-fluid">
            </div>
            <h6 class=" mt-2 font-weight-bold">NEHA AHMED</h6>
            <p class="">COO OSLS</p>
            <p> Bachelors of Computer Science and Information Technology (in progress) </p>
        </div>


    </div>
</section>
<section class="social text-light text-center  p-5">
    <div class="ref">
        <h2>Connect With Us ;) </h2>
        <div class=" d-flex justify-content-center  align-items-center ">
            <img src="<?= base_url('public/assets/images/transparent/logo.png') ?>" alt="" width="100px">
            <a href="#"><i class="fa fa-facebook-official fa-2x " aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
        </div>
    </div>
</section>