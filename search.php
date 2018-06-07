<?php
require_once('functions.php');
$search = $_POST['search_content'];
$test = search_function($search);
$testing = json_decode($test);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ekutur Task</title>
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
   	<div class="row" style="padding: 3%">	
   	<?php
   		for($i = 0; $i < sizeof($testing->Search); $i++){
   			$img_src = "img/no-image.jpeg";
                if($testing->Search[$i]->Poster != "N/A") {
                    $img_src = $testing->Search[$i]->Poster;
                }

   	?>
   	<div class="col-12 col-lg-3 mb-4">
        <div class="card">
            <img class="img-fluid" src="<?= $img_src ?>" style="height: 350px">
            <div class="card-body">
            	<h4 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $testing->Search[$i]->Title; ?></h4>  
            	<h5 class="title"><em>Type: <?= $testing->Search[$i]->Type ?></em></h5>
                <a href="#" class="btn btn-primary" onclick='single_search_id("<?= $testing->Search[$i]->imdbID ?>", "<?= $testing->Search[$i]->Type ?>")'>View More</a>
            </div>
        </div>
    </div> 
    <?php } ?>
</div>
    <div class="container-fluid mt-3">
        <div class="row" id="search_results">
            <div class="col-12">
            </div>
        </div>
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
    	function single_search_id(imdbid, type){

    		if(type == "series"){
				window.location.href = "details.php?id="+imdbid;
    		}else if(type == "movie"){
    			window.location.href = "details.php?id="+imdbid;
    		}
    	}
    </script>
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
