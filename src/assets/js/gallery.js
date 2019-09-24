import $ from 'jquery';

$(function () {

    let $galleries = $('.gallery');

    if ( !$galleries.length ) {

        return;
    }

    $galleries.each(galleryInit);
});

/**
 * Initializes galleries.
 *
 * @since 1.0.0
 */
function galleryInit() {

    let matches  = $(this).attr('id').match(/gallery-(\d+)/i);
    let instance = matches[1];
    let $modal   = $(`#kwaske-gallery-modal-${instance}`);
    let images   = JSON.parse($modal.attr('data-images'));

    $(this).find('.gallery-item a').click(function (e) {

        e.preventDefault();

        let $item           = $(this).closest('.gallery-item');
        let index           = $item.index();
        let $loading        = $modal.find('.kwaske-gallery-modal-loading');
        let $imageContainer = $modal.find('.kwaske-gallery-modal-image-container');
        let imageID         = images[index];

        $modal.foundation('open');

        $imageContainer.hide();
        $loading.show();

        $.ajax({
            url: `/wp-json/wp/v2/media?include=${imageID}`,
            complete: function (response) {

                $loading.hide();
            },
            success: function (response) {

                $imageContainer.html('');
                $imageContainer.append(`<img src="${response[0].source_url}" />`);
                $imageContainer.show();
            },
            error: function (response) {

                if ( !response[0] || !response[0].source_url ) {

                    $imageContainer.html('Error in getting image. Please try again later.');
                }
            }
        });
    });
}