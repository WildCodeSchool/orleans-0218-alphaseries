$("#seasonSelect").change(function () {
    let idSeason = $(this).val();
    let idSerie = $(this).attr("data-idSerie");
    $.post("/seasonId", {idSeason: idSeason, idSerie: idSerie}).done(function (data) {
        $('#listEpisode').html(data);
    });
});

function toggle(source)
{
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) {
            checkboxes[i].checked = source.checked;
            processForm(checkboxes[i]);
        }
    }
}

function processForm(source)
{
    let idEpisode = source.id;
    if ($(source).is(':checked')) {
        source.setAttribute("checked", "checked");
        $.ajax({
            type: 'POST',
            url: '/submit/episode/',
            data: {hasSeen: 1, id: idEpisode},

        });
    } else {
        source.removeAttribute("checked");
        $.ajax({
            type: 'POST',
            url: '/submit/episode/',
            data: {hasSeen: 0, id: idEpisode},

        });
    }
}
