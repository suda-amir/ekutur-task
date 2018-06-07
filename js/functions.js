$("#home").bind("click", function() {
    $("#search_results").html('');
    $("#home_div").css('display', '');

});
$("#search_btn").bind("click", function() {
    change_loading_state(true);
    $.ajax({
        type: "GET",
        url: "http://www.omdbapi.com",
        data: {
            s: $("#search_content").val(),
            apikey: "584ac277",
        },
        success:function(result) {
            $("#search_results").html("");
            for (var i = 0, len = result.Search.length; i < len; ++i) {
                var customer = result.Search[i];
           
                var img_src = "img/no-image.jpeg";
                if(customer.Poster != "N/A") {
                    img_src = customer.Poster;
                }

                if(customer.Plot== "" || customer.Plot == null) {
                    customer.Plot = "<p></p>";
                }

                var new_card = "<div class=\"col-12 col-lg-3 mb-4\">\n" +
                    "        <div class=\"card\">\n" +
                    "            <img class=\"img-fluid\" src=\""+ img_src +"\" style=\"height: 350px\">\n" +
                    "            <div class=\"card-body\">\n" +
                    "                <!--Title-->\n" +
                    "                <h4 class=\"card-title\" style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis;' data-toggle=\"tooltip\" data-placement=\"bottom\" title=\""+ customer.Title +"\">"+ customer.Title +"</h4>\n" +
                    "                <!--Text-->\n" +
                    "                            <h5 class=\"title\"><em>Type: "+ customer.Type +"</em></h5>\n" +
                    "                <a href=\"#\" class=\"btn btn-primary\" onclick='single_search_id(\""+customer.imdbID+"\")'>View More</a>\n" +
                    "            </div>\n" +
                    "        </div>\n" +
                    "    </div>"; 


                $('#search_results').append(new_card);
                change_loading_state(false);
             }
        }
    });
});
$("#search_btn_single").bind("click", function() {
    show_single_record();
});
function single_search_id(test) {
    change_loading_state(true);
    $.ajax({
        type: "GET",
        url: "http://www.omdbapi.com",
        data: {
            i: test,
            plot: "full",
            apikey: "584ac277",
        },
        success:function(single_data) {
            if(single_data.Type == "series")
                update_single_show_data(single_data);
            else
                update_movie(single_data);
            change_loading_state(false);
        }
    });
}
function show_single_record() {
    change_loading_state(true);
    $.ajax({
        type: "GET",
        url: "http://www.omdbapi.com",
        data: {
            t: $("#search_content").val(),
            plot: "full",
            apikey: "584ac277",  
        },
        success:function(single_data) {
            update_single_show_data(single_data);
            change_loading_state(false);
        }
    });
}
function update_movie(single_data) {
    $("#search_results").html("");

    var img_src = "img/no-image.jpeg";
    if(single_data.Poster != "N/A") {
        img_src = single_data.Poster;
    }

    $("#search_results").html("");
    var new_card = "<div class=\"card m-4 p-0\">\n" +
        "                    <div class=\"card-body row p-0\">\n" +
        "                        <div class=\"col-12 col-lg-2\">\n" +
        "                            <img class=\"img-fluid\" src=\""+ img_src +"\" style=\"height: 250px\">\n" +
        "                        </div>\n" +
        "                        <div class=\"col-12 col-lg-10 p-3\">\n" +
        "                            <h4 class=\"card-title\">"+ single_data.Title +"</h4>\n" +
        "                            <div class='text-justify'>"+ single_data.Plot +"</div>\n" +
        "                        </div>\n" +
        "                        <div class=\"col-12 m-3 \">\n" +
        "                            <h4>Rating: "+ single_data.imdbRating +" out of 10</h4>\n" +
        "                            <h4 class=\"title\">Cast: "+ single_data.Actors +"</h4>\n" +
        "                            <h4 class=\"title\">Directors: "+ single_data.Director +"</h4>\n" +
        "                            <h5 class=\"title\"><em>Release Date: "+ single_data.Released +"</em></h5>\n" +
        "                            <h5 class=\"title\"><em>Genre: "+ single_data.Genre +"</em></h5>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>";
    $('#search_results').append(new_card);
}
function update_single_show_data(single_data) {
    $("#search_results").html("");
    var img_src = "img/no-image.jpeg";
    if(single_data.Poster != "N/A") {
        img_src = single_data.Poster;
    }

    $("#search_results").html("");
    var new_card = "<div class=\"card m-4 p-0\">\n" +
        "                    <div class=\"card-body row p-0\">\n" +
        "                        <div class=\"col-12 col-lg-2\">\n" +
        "                            <img class=\"img-fluid\" src=\""+ img_src +"\" style=\"height: 250px\">\n" +
        "                        </div>\n" +
        "                        <div class=\"col-12 col-lg-10 p-3\">\n" +
        "                            <h4 class=\"card-title\" style=\"white-space: nowrap; overflow: hidden; text-overflow: ellipsis;\">"+ single_data.Title +"</h4>\n" +
        "                            <div class='text-justify'>"+ single_data.Plot +"</div>\n" +
        "                        </div>\n" +
        "                        <div class=\"col-12 m-3\">\n" +
        "                            <h4>Rating: "+ single_data.imdbRating +" out of 10</h4>\n" +
        "                            <h5 class=\"title\">Cast:"+ single_data.Actors +"</h5>\n" +
        "                            <div class='m-4'>" +
        "                                <div class='row' id='single_show_cast'></div>" +
        "                            </div>" +
        "                            <h2 class=\"title\">Episodes:</h2>" +
        "                            <div class='m-4'>" +
        "                                <div class='row' id='single_show_episodes'></div>" +
        "                            </div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>";
    $('#search_results').append(new_card);
    update_show_episodes(single_data.imdbID);
}

function update_show_episodes(tvid) {
    change_loading_state(true);
    $.ajax({
        type: "GET",
        url: "http://www.omdbapi.com",
        data: {
            i: tvid,
            Season: "1",
            apikey: "584ac277",
        },
        success:function(result) {
            $("#single_show_episodes").html("");
            var total_season = result.totalSeasons;
            var Episodes = result.Episodes.length;
            var j = 1;
            for(i =1; i <= total_season; i++ ){
                for(j=1; j<= Episodes;j++){
                $.ajax({
                type: "GET",
                url: "http://www.omdbapi.com",
                data: {
                    i: tvid,
                    Season: i,
                    Episode: j,
                    apikey: "584ac277",
                },
                success:function(result_epi) {                  
                    var img_src = "img/no-image.jpeg";
                    if(result_epi.Poster != "N/A") {
                        img_src = result_epi.Poster;
                    }
                    if(result_epi.Plot == "" || result_epi.Plot == null) {
                        result_epi.Plot = "<p></p>";
                    }

                     var new_card = "<div class=\"col-12 col-lg-3 mb-lg-4\">\n" +
                    "        <div class=\"card\">\n" +
                    "            <img class=\"img-fluid\" src=\""+ img_src +"\" style=\"height: 250px\">\n" +
                    "            <div class=\"card-body\">\n" +
                    "                <h4 class=\"card-title\" style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis;' data-toggle=\"tooltip\" data-placement=\"bottom\" title=\""+ result_epi.Title +"\">"+ result_epi.Title +"</h4>\n" +
                    "                <p><em>Season: "+ result_epi.Season +" &emsp; Episode: "+ result_epi.Episode +" </em></p>" +
                    "                <div class='card-content text-justify' style=\"height: 250px\" data-ep_id='"+ result_epi.imdbID +"' data-full_summary=\""+ $('<div/>').text(result_epi.Plot).html() +"\" >"+ result_epi.Plot +"</div>\n" +
                    "                <p><em>(Air Date: "+ result_epi.Released +")</em></p>" +
                    "            </div>\n" +
                    "        </div>\n" +
                    "    </div>";
                $('#single_show_episodes').append(new_card);
                }
                });
            }
            }
            change_loading_state(false);
        }
    });
}

function change_loading_state(loading_visibility_status) {
    if(loading_visibility_status) {
        $("#loading_state").css('visibility', 'visible');
        $("#home_div").css('display', 'none');
    } else {
        $("#loading_state").css('visibility', 'hidden');
    }
}