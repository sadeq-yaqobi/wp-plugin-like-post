jQuery(document).ready(function ($) {
    const $likeButton = $("a#lbs_like_button");
    const $likeIcon = $("span.like-icon")
    const $likeCounter = $("span.like-counter")
    if ($likeButton.hasClass('lbs-liked')) {
        $likeButton.addClass('lbs-red-color');
    }

    if ($likeButton.hasClass('lbs-not-liked')) {
        $likeIcon.addClass('heartbeat');
        $likeButton.removeClass('lbs-red-color');
    }

    $likeButton.on('click', function (e) {
        e.preventDefault();
        if ($likeButton.hasClass('lbs-not-liked')) {
            $likeButton.addClass('liked');
        }

        if ($likeButton.hasClass('lbs-liked')) {
            $likeButton.removeClass('liked');
            $likeIcon.addClass('heartbeat');
            $likeButton.removeClass('lbs-red-color');
        }

    });
});