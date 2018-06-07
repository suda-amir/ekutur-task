<!DOCTYPE html>
<html lang="en">
<?php
    require_once('functions.php');
    $imdbid = $_GET['id'];
    $test = details($imdbid);
    $testing = json_decode($test);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ekutur Task | Sudarshan</title>
    <!-- Font Awesome -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark indigo">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.html" id="home">Entertainment Guide</a>
        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active text-light" id="loading_state" style="visibility: hidden;">
                    Loading...
                </li>
            </ul>
            <!-- Links -->
            <!-- Search form -->
            <form class="form-inline" method="POST" action="search.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" id="search" name="search_content" aria-label="Search">
                <button class="btn btn-outline-success btn-sm my-0" id="search_btn" type="submit">Search</button>
            </form>
            <button class="btn btn-outline-success btn-sm my-0" id="direct-search">I'M FEELING LUCKY</button>
        </div>
        <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->
    <div class="container-fluid mt-3">
        <?php 
            if($testing->Type == "movie"){
        ?>
        <div class="row">
            <div class="card m-4 p-0">
                <div class="card-body row p-0">
                    <div class="col-12 col-lg-2">
                        <?php 
                            $img_src = "img/no-image.jpeg";
                            if($testing->Poster != "N/A") {
                                $img_src = $testing->Poster;
                            }
                        ?>
                        <img class="img-fluid" src="<?= $img_src; ?>" style="height: 250px">
                    </div>
                    <div class="col-12 col-lg-10 p-3">
                        <h4 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $testing->Title; ?></h4>
                        <div class='text-justify'><?= $testing->Plot; ?></div>
                    </div>
                    <div class="col-12 m-3">
                        <h4><b>Rating:</b> <?= $testing->imdbRating; ?> out of 10</h4>
                        <h5 class="title"><b>Cast:</b> <?= $testing->Actors; ?></h5>
                        <h5 class="title"><b>Directors:</b> <?= $testing->Director; ?></h5>
                        <h5 class="title"><b>Writers:</b> <?= $testing->Writer; ?></h5>
                        <h5 class="title"><b>Genre:</b> <?= $testing->Genre; ?></h5>
                        <h5 class="title"><b>Runtime:</b> <?= $testing->Runtime; ?></h5>
                        <p><em>(Released Date: <?= $testing->Released; ?>)</em></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }else if($testing->Type == "series"){
                $single_season = series_single_season_details($imdbid);
                $single_seasons = json_decode($single_season);
                $totalseasons = $single_seasons->totalSeasons;
                $episodes = sizeof($single_seasons->Episodes);
            ?>
            <div class="row">
            <div class="card m-4 p-0">
                <div class="card-body row p-0">
                    <div class="col-12 col-lg-2">
                        <?php 
                            $img_src = "img/no-image.jpeg";
                            if($testing->Poster != "N/A") {
                                $img_src = $testing->Poster;
                            }
                        ?>
                        <img class="img-fluid" src="<?= $img_src; ?>" style="height: 250px">
                    </div>
                    <div class="col-12 col-lg-10 p-3">
                        <h4 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $testing->Title; ?></h4>
                        <div class='text-justify'><?= $testing->Plot; ?></div>
                    </div>
                    <div class="col-12 m-3">
                        <h4>Rating: <?= $testing->imdbRating; ?> out of 10</h4>
                        <h5 class="title">Cast: <?= $testing->Actors; ?></h5>
                        <h2 class="title">Episodes:</h2>
                        <div class='m-4'>
                            <div class='row'>
                                <?php 
                                    for($i = 1; $i < $totalseasons; $i++){
                                        for($j = 1; $j < $episodes; $j++){
                                            $data = series_season_details($imdbid, $i, $j);
                                            $data_test = json_decode($data);
                                            $img_src1 = "img/no-image.jpeg";
                                            if($data_test->Poster != "N/A") {
                                                $img_src1 = $data_test->Poster;
                                            }
                                ?>
                                <div class="col-12 col-lg-3 mb-lg-4">
                                    <div class="card">
                                        <img class="img-fluid" src="<?= $img_src1; ?>" style="height: 250px">
                                        <div class="card-body">
                                            <h4 class="card-title" style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'><?= $data_test->Title; ?></h4>
                                            <p><em>Season: <?= $data_test->Season; ?>&emsp; Episode: <?= $data_test->Episode; ?></em></p>
                                            <div class='card-content text-justify' style="height: 250px"><?= $data_test->Plot; ?></div>
                                            <p><em>(Air Date: <?= $data_test->Released; ?>)</em></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        
    </div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!--<script type="text/javascript" src="js/functions.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#direct-search").click(function(){
                var search =     $("#search").val();
                window.location.href = "direct-search.php?id="+search;
            });
        });
    </script>
</body>
</html>
