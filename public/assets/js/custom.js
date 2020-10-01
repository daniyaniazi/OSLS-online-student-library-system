$(document).ready(function () {
    bookOffset = 1;
    searchBookOffset = 0;
    searchText = "";
    loadMore = true;
    searchData = [];
    searchLoadMore = false;

    $('.seemore-btn').click(function (e) {
        //console.log($booksCounter);
        if(searchText){
            searchLoadMore = true;
            $('.search-btn').click();
            return;
        }
        $.ajax(BASE_URL+'book/loadMore?offset='+bookOffset, {
            type: "GET",
            dataType: "json",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            beforeSend:() => {
                $(".seemore-btn").addClass("d-none");
                $(".spinner-wrap").removeClass("d-none");
                $(".error-group").html("");
            },
            success:(res) => {
                const getTemplate = (data)=>`
                        <div class=" col-sm-6 col-md-4 col-lg-3 text-center ">
                            <div class="book-content new-content" style="display: none">
                                <div class="img-div mx-auto ">
                                <img src="${data.image_path}" alt="bookTitle " class="img-fluid m-2 "></div>
                                <button class="btn-block btn book-btn " href="${data.book_path}">${data.title}</button>
                                <p class="p-1 ">${data.author}</p>
                            </div> 
                        </div>
                    `;
                if (res && res.status) {
                    res.data.forEach((item)=>{
                        const template = getTemplate(item);
                        $('.book-list-container').append(template);
                        $('.book-list-container .book-content.new-content').fadeIn(1000);
                    });
                    $('.book-list-container .book-content').removeClass('new-content');
                    setTimeout(()=>{
                        if(!res.load_more){
                            $('.seemore-btn').addClass('d-none');
                            loadMore = false;
                        }
                    },100);
                }
                bookOffset++;
            },
            complete:() => {
                $(".spinner-wrap").addClass("d-none");
                $(".seemore-btn").removeClass("d-none");

                //AppSetting.stopBlockUI($("#cropping-img-wrapper"));
            },
            error: function (err) {
                const res = err.responseJSON;
                $(".error-group").html(`<div class="error_msg_fiels">${res.message}</div>`);
                //AppSetting.growler('error', res.message, 'Error!!');
            }
        });
    });

    $('body').on('click','.book-btn',function (e) {
        //$('.book-download-btn').remove();
        const downloadUrl  = $(this).attr('href');
        //$('header').append(`<a class="book-download-btn" href="${downloadUrl}" download>asddsasda</a>`);
        //$('.book-download-btn').trigger('click');

        var link = document.createElement("a");
        link.setAttribute('download', '');
        link.href = downloadUrl;
        document.body.appendChild(link);
        link.click();
        link.remove();

    });

    $('.search-btn').click(function (e) {
        //console.log($booksCounter);
        const inputVal = $('#search-input').val().trim();
        let foundNewText = true;

        if(!inputVal){
            return false;
        }

        if(searchText == inputVal){
            // !!
            foundNewText = false;
        }else{
            searchText = inputVal;
            searchData = [];
            searchBookOffset = 0;
            loadMore = true;
        }

        $.ajax(BASE_URL+'book/search?offset='+searchBookOffset+'&search='+inputVal, {
            type: "GET",
            dataType: "json",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            beforeSend:() => {
                $('.search-btn').attr("disabled",'disabled');
                $(".spinner-search-wrap").removeClass("d-none");

                if(searchLoadMore){
                    $(".seemore-btn").addClass("d-none");
                    $(".spinner-wrap").removeClass("d-none");
                    $(".spinner-search-wrap").addClass("d-none");
                }

            },
            success:(res) => {
                const getTemplate = (data)=>`
                        <div class=" col-sm-6 col-md-4 col-lg-3 text-center ">
                            <div class="book-content new-content" style="display: none">
                                <div class="img-div mx-auto ">
                                <img src="${data.image_path}" alt="bookTitle " class="img-fluid m-2 "></div>
                                <button class="btn-block btn book-btn " href="${data.book_path}">${data.title}</button>
                                <p class="p-1 ">${data.author}</p>
                            </div> 
                        </div>
                    `;
                if (res && res.status) {
                    if(foundNewText){
                        $('.book-list-container').empty();
                    }
                    res.data.forEach((item)=>{
                        const template = getTemplate(item);
                        $('.book-list-container').append(template);
                        $('.book-list-container .book-content.new-content').fadeIn(1000);
                    });
                    $('.book-list-container .book-content').removeClass('new-content');
                    setTimeout(()=>{
                        if(!res.load_more){
                            $('.seemore-btn').addClass('d-none');
                            loadMore = false;
                        }
                    },100);


                    if(foundNewText && res.data.length<=0){
                        $('.heading-seprator').html("<span>Sorry, No Books Found</span>");
                        $('.book-list-container').empty();
                        searchBookOffset =0;
                        searchData = [];
                        return;
                    }

                }
                searchBookOffset++;
            },
            complete:() => {
                $(".spinner-search-wrap").addClass("d-none");
                $('.search-btn').removeAttr("disabled");

                $(".spinner-wrap").addClass("d-none");
                $(".seemore-btn").removeClass("d-none");

                searchLoadMore = false;

                //AppSetting.stopBlockUI($("#cropping-img-wrapper"));
            },
            error: function (err) {
                const res = err.responseJSON;
                $(".error-group").html(`<div class="error_msg_fiels">${res.message}</div>`);
                //AppSetting.growler('error', res.message, 'Error!!');
            }
        });
    });

    function attachValidator(){
        const loginForm = {
            selector : $("#loginForm"),
            rules : {
                email:{email:true,required:true},
                password:{required:true},
            },
            messages: {
                email: 'Please enter a valid email address',
                password: 'Password is required field'
            }
        };
        const signupForm = {
            selector : $("#signupForm"),
            rules : {
                email:{email:true,required:true},
                password:{required:true,minlength: 6},
                name:{required:true},
                contact_no:{required:true},
            },
            messages: {
                email: 'Please enter a valid email address',
                password: 'Password is required & atleast should have 6 characters',
                name: 'Name field is required',
                contact_no: 'Contact# field is required',
            }
        };
        const bookForm = {
            selector : $("#bookForm"),
            rules : {
                title:{required:true, minlength: 3},
                author:{required:true},
                visibility:{required:true},
                book_doc:{required:true},
                book_image:{required:true},
            },
            messages: {
                title: 'Book title atleast have 3 or more characters',
                author: 'Author name is required',
                visibility: 'Book visibility field required',
                book_doc: 'Book Doc field required',
                book_image: 'Book image field required',
            }
        };
        const contactForm = {
            selector : $("#contactForm"),
            rules : {
                email:{required:true, email: true},
                message:{required:true},
            },
            messages: {
                email: 'Please enter a valid email address',
                message: 'Message is required',
            }
        };
        [loginForm,signupForm,bookForm,contactForm].forEach((validatorInstance)=>{
            validatorInstance.selector.validate({
                rules: validatorInstance.rules,
                errorElement: 'div',
                errorClass: 'invalid-feedback d-block',
                messages: validatorInstance.messages,
                ignore: 'input[type=hidden],:not(select):hidden',
                highlight: function(element) {
                    $(element).addClass("border-red-input");
                },
                success: function (element) {
                    $(element).prev("input").removeClass("border-red-input");
                },
                submitHandler: function(form) {
                    form.submit();
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        console.log("placement",element)
                        if(element.hasClass('form-check-input')){
                            $(element).closest('.form-check').before(error);
                        }else{
                            error.insertAfter(element);
                        }
                    }

                },
            });
        });
    }


    attachValidator();

});