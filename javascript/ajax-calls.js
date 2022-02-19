jQuery(document).ready(function ($) {

    $('.update_data_button').on('click', function () {
        event.preventDefault();
        var post_id = $(this).attr('id');
        var postTitle = $('#title').val();
        console.log(postTitle);

        $.ajax({
            url: "https://www.omdbapi.com/?t=" + postTitle + "&apikey=2c89c315",
            context: document.body
        }).done(function (data) {

            if (data.Error == 'Movie not found!') {
                alert('movie not found');
            }
            else {


                $('#movie_title').val(data.Title);
                $('#release_date').val(data.Released);
                $('#poster').val(data.Poster);
                $('#director').val(data.Director);
                $('#runtime').val(data.Runtime);
                $('#actors').val(data.Actors);

                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajaxurl,
                    data: {
                        action: 'custom_update_post',
                        post_id: post_id,
                        movie_title: data.Title,
                        release_date: data.Released,
                        poster: data.Poster,
                        director: data.Director,
                        runtime: data.Runtime,
                        actors: data.Actors
                    },
                });


            }
        });
    });


});