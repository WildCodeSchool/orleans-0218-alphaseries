function rating(element)
{
    let idEpisode = element.id;
    const starRating = $(element).attr('data-rating');
    console.log(starRating);
    const stars = $(element).closest('.stars').find('.fa-star, .fa-star-o');
    let checkedStar = true;
    for (const star of stars) {
        if (checkedStar) {
            $(star).addClass('fa-star').removeClass('fa-star-o');
        } else {
            $(star).addClass('fa-star-o').removeClass('fa-star');
        }
        if (star === element) {
            checkedStar = false;
        }
    }
    $.ajax({
        type: 'POST',
        url: '/submit/episode/',
        data: {note: starRating, id: idEpisode},

    });
    return true;
}
