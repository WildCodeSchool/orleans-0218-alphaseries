$("#seasonSelect").change(function () {
    let idSeason = $(this).val();
    let idSerie = $(this).attr("data-idSerie");
    $.post("/seasonId", {idSeason: idSeason, idSerie: idSerie}).done(function (data) {
        $('#listEpisode').html(data);
    });
});
