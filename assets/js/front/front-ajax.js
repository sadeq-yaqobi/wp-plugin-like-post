jQuery(document).ready(function ($) {
    const $likeButton = $("#lbs_like_button");
    const $likeIcon = $("span.like-icon");
    const $likeCounter = $("span.like-counter");
    $($likeButton).on('click', function (e) {
        e.preventDefault();
        if ($likeButton.hasClass('lbs-not-liked')) {
            likePost();
        }
        if ($likeButton.hasClass('lbs-liked')) {
            unlikePost();
        }
    });


    function likePost(){
            let postID = $likeButton.data('post-id');
            let userID = $likeButton.data('user-id');

            // AJAX request to filter posts
            jQuery.ajax({
                url: lbs_ajax.lbs_ajaxurl, //ajax url
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'lbs_like_post',
                    postID: postID,
                    userID: userID,
                    _nonce: lbs_ajax._lbs_nonce
                },
                success: function (response) {
                    if (response.success) {
                        // Actions to handle successful response --- to get success message use this template: response.message
                        $.toast({
                            text: response.message, // Text that is to be shown in the toast
                            heading: ' ', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: false, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values


                            textAlign: 'right',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                            beforeShow: function () {
                            }, // will be triggered before the toast is shown
                            afterShown: function () {
                            }, // will be triggered after the toat has been shown
                            beforeHide: function () {
                            }, // will be triggered before the toast gets hidden
                            afterHidden: function () {
                            }  // will be triggered after the toast has been hidden
                        });
                        $likeCounter.text(response.like_number);
                        $likeButton.removeClass('lbs-not-liked').addClass('liked').addClass('lbs-liked');
                        $likeIcon.removeClass('heartbeat');

                    }
                },
                error: function (error) {
                    if (error.error) {
                        // Error handling based on specific error conditions--- to get error message use this template: error.responseJSON.message
                        $.toast({
                            text: error.responseJSON.message, // Text that is to be shown in the toast
                            heading: error.responseJSON.title, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: false, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values


                            textAlign: 'right',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                            beforeShow: function () {
                            }, // will be triggered before the toast is shown
                            afterShown: function () {
                            }, // will be triggered after the toat has been shown
                            beforeHide: function () {
                            }, // will be triggered before the toast gets hidden
                            afterHidden: function () {
                            }  // will be triggered after the toast has been hidden
                        });
                        $likeButton.addClass('lbs-not-liked').removeClass('liked').removeClass('lbs-liked');
                        $likeIcon.addClass('heartbeat');
                    }
                },

            });
    }

    function  unlikePost() {
            let postID = $likeButton.data('post-id');
            let userID = $likeButton.data('user-id');

            // AJAX request to filter posts
            jQuery.ajax({
                url: lbs_ajax.lbs_ajaxurl, //ajax url
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'lbs_unlike_post',
                    postID: postID,
                    userID: userID,
                    _nonce: lbs_ajax._lbs_nonce
                },
                success: function (response) {
                    if (response.success) {
                        // Actions to handle successful response --- to get success message use this template: response.message
                        $.toast({
                            text: response.message, // Text that is to be shown in the toast
                            heading: ' ', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: false, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values


                            textAlign: 'right',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                            beforeShow: function () {
                            }, // will be triggered before the toast is shown
                            afterShown: function () {
                            }, // will be triggered after the toat has been shown
                            beforeHide: function () {
                            }, // will be triggered before the toast gets hidden
                            afterHidden: function () {
                            }  // will be triggered after the toast has been hidden
                        });
                        $likeCounter.text(response.like_number);
                        $likeButton.removeClass('lbs-liked').removeClass('lbs-red-color').removeClass('liked').addClass('lbs-not-liked');
                        $likeIcon.addClass('heartbeat');
                    }
                },
                error: function (error) {
                    if (error.error) {
                        // Error handling based on specific error conditions--- to get error message use this template: error.responseJSON.message
                        $.toast({
                            text: error.responseJSON.message, // Text that is to be shown in the toast
                            heading: error.responseJSON.title, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: false, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values


                            textAlign: 'right',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                            beforeShow: function () {
                            }, // will be triggered before the toast is shown
                            afterShown: function () {
                            }, // will be triggered after the toat has been shown
                            beforeHide: function () {
                            }, // will be triggered before the toast gets hidden
                            afterHidden: function () {
                            }  // will be triggered after the toast has been hidden
                        });
                        $likeButton.addClass('lbs-liked').addClass('lbs-red-color').addClass('liked').removeClass('lbs-not-liked');
                        $likeIcon.removeClass('heartbeat');
                    }
                },
            });
    }
});

