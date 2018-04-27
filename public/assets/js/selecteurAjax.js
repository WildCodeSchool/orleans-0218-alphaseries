$("#seasonSelect").change(function () {
    let idSeason = $(this).val();
    let idSerie = $(this).attr("data-idSerie");
    $.post("/seasonId", {idSeason: idSeason, idSerie: idSerie}).done(function (data) {
        $('#listEpisode').html(data);
    });
});

function toggle(source) {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
