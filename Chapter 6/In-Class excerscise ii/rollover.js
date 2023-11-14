$(document).ready(() => {
    $('#image_rollovers img').each((index, img) => {
        
        $(img).mouseover( function() {
            const src = $(this).attr('src');
            const newSrc = src.replace('-bw', '');
            $(this).attr('src', newSrc);
        })
        $(img).mouseout( function() {
            const src = $(this).attr('src');
            const newSrc = src.replace('.jpg', '-bw.jpg');
            $(this).attr('src', newSrc);
        })
    });
});