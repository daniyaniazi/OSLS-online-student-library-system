<main class="container-fluid main text-light">
    <section class="container  my-4  w-100 search-section text-center">
        <label for="search"><h3>Search Your Favourite Item</h3></label>
        <div class="row align-items-center w-100 mx-auto">
            <form class="form-inline my-2 col-md-9  d-flex align-items-center justify-content-center w-100 ">
                <input class="form-control mr-sm-2 w-75 " type=" search " placeholder="Search " aria-label="Search " id="search-input">
                <button class="btn  btn-search my-2 my-sm-0 search-btn" type="button ">Search</button>
                <span class="spinner-search-wrap px-2 d-none">
                    <img src="<?= base_url('public/assets/images/throbber_12.gif') ?>" alt="" width="24">
                </span>
            </form>
            <?php if($isLoggedIn): ?>
                <a href="<?= base_url('book/add') ?>" class="col-md-3  mx-auto btn btn-block upload-btn my-2 w-100">
                    Upload Book<i class="fa fa-upload"></i>
                </a>
            <?php endif;  ?>
        </div>
    </section>
    <section class="container my-5 text-center pop-item-section ">
        <h1 class="text-center "> POPULAR ITEMS </h1>
        <div class="alert-wrapper">
            <?php Messages::display(); ?>
        </div>

         <h3 class="pt-4 heading-seprator">
             <?php if (count($viewmodel)<1): ?>
                 <span>Sorry, No Books Found</span>
             <?php endif ?>
         </h3>

        <div class="row justify-content-center align-items-center book-list-container">

            <?php foreach($viewmodel as $item) : ?>
                <div class=" col-sm-6 col-md-4 col-lg-3 text-center ">
                    <div class="img-div mx-auto ">
                    <img src="<?= base_url('storage/').$item['image_path'] ?>" alt="bookTitle " class="img-fluid m-2 "></div>
                    <button class="btn-block btn book-btn " href="<?= base_url('storage/').$item['book_path'] ?>"><?= ucwords($item['title']) ?></button>
                    <p class="p-1 "><?= ucwords($item['author']) ?></p>
                </div>
            <?php endforeach; ?>

        </div>
        <button class="btn text-center my-4 seemore-btn ">See More</button>
        <span class="spinner-wrap d-none">
            <img src="<?= base_url('public/assets/images/throbber_12.gif') ?>" alt="" width="56">
        </span>
    </section>

</main>

<script>
    var $booksCounter = "<?= count($viewmodel); ?>";
</script>
