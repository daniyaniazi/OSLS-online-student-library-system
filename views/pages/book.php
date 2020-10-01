<main>
    <div class="container-fluid text-light">
        <div class="container my-5">
            <div class="row justify-content-center">

                    <form enctype="multipart/form-data" method="post" action="<?= base_url('book/save'); ?>" id="bookForm">
                    <?php Messages::display(); ?>
                    <h1>Publish Your Book </h1>
                    <div class="form-group">
                        <label for="BookTitle">Book Title</label>
                        <input value="<?= oldInput('title') ?>" name="title" type="text" class="form-control" id="booktitle" aria-describedby="booktitlename" placeholder="Enter Book Title">

                    </div>
                    <div class="form-group">
                        <label for="booktags">Author(s)</label>
                        <input value="<?= oldInput('author') ?>" name="author" type="text" class="form-control" id="authorName" placeholder="Enter Author(s) Name">
                    </div>
                    Visibiity
                    <div class="form-check">
                        <input <?= oldInput('visibility') =='0'?'checked':'' ?> name="visibility" class="form-check-input" type="radio" name="exampleRadios" id="privateBook" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                            Private
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input <?= oldInput('visibility') =='1'?'checked':'' ?> name="visibility" class="form-check-input" type="radio" name="exampleRadios" id="publiceBook" value="1">
                        <label class="form-check-label" for="exampleRadios3">
                            Public
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="uploadbook">Upload your book</label>
                        <input name="book_doc" type="file" class="form-control-file" id="uploadBookFile">
                    </div>
                    <div class="form-group">
                        <label for="uploadbookImg">Upload your book's image</label>
                        <input name="book_image" type="file" class="form-control-file" id="uploadBookImage">
                    </div>
                    <button name="submit" type="submit "  value="Submit" class="btn btn-primary ">Submit</button>
                </form>

            </div>
        </div>
    </div>
</main>
