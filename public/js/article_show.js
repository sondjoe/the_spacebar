$(document).ready(function() {
    $('.js-like-article').on('click', function(aEvent) {
        aEvent.preventDefault();

        var $link = $(aEvent.currentTarget);

        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method : 'POST',
            url : $link.attr('href')
        }).done(function(data) {
            $('.js-like-article-count').html(data.hearts);
        });
    });
});