<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre Final Test 2</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <h4>ระบุคำค้นหา</h4>
            </div> 
            <form action="index.php" method="POST" style="width:100%"> 
                <div class="col-12" style="display: flex;">
                    <input class="form-control" type="text" id="search" name="search">
                    <button type="submit" class="btn btn-primary my-1" name="submit">ค้นหา</button>
                </div>
            </form>
                <?php
                    $found = false;
                    $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";    
                    $response = file_get_contents($url);
                    $result = json_decode($response);
                    ob_start();
                    for($i=0; $i < sizeof($result->tracks->items);$i++){
                        echo '  <div class="col-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="'.$result->tracks->items[$i]->album->images[0]->url.'" alt="">
                                        <div class="card-body">
                                            <h4>'.$result->tracks->items[$i]->album->name.'</h4>
                                            <p>Artist: '.$result->tracks->items[$i]->album->artists[0]->name.'</p>
                                            <p>Release date: '.$result->tracks->items[$i]->album->release_date.'</p>
                                            <p>Availiable: '.sizeof($result->tracks->items[$i]->album->available_markets).' countries</p>
                                        </div>
                                    </div>
                                </div>';
                    }
                    if(isset($_POST['submit'])){
                        ob_end_clean();
                        $find = $_POST['search'];
                        for($i=0; $i < sizeof($result->tracks->items);$i++){
                            $name = $result->tracks->items[$i]->album->artists[0]->name;
                            $check = explode(" ", $name);
                            if(sizeof($check) == 1){
                                if(($result->tracks->items[$i]->album->name == $find) or ($check[0]==$find)){
                                    echo '  <div class="col-4 mt-4">
                                        <div class="card">
                                            <img class="card-img-top" src="'.$result->tracks->items[$i]->album->images[0]->url.'" alt="">
                                            <div class="card-body">
                                                <h4>'.$result->tracks->items[$i]->album->name.'</h4>
                                                <p>Artist: '.$result->tracks->items[$i]->album->artists[0]->name.'</p>
                                                <p>Release date: '.$result->tracks->items[$i]->album->release_date.'</p>
                                                <p>Availiable: '.sizeof($result->tracks->items[$i]->album->available_markets).' countries</p>
                                            </div>
                                        </div>
                                    </div>';
                                    $found = true;
                                }
                            } elseif(sizeof($check) == 2) {
                                if(($result->tracks->items[$i]->album->name == $name) or ($check[0]==$find) or ($check[1]==$find)){
                                    echo '  <div class="col-4 mt-4">
                                        <div class="card">
                                            <img class="card-img-top" src="'.$result->tracks->items[$i]->album->images[0]->url.'" alt="">
                                            <div class="card-body">
                                                <h4>'.$result->tracks->items[$i]->album->name.'</h4>
                                                <p>Artist: '.$result->tracks->items[$i]->album->artists[0]->name.'</p>
                                                <p>Release date: '.$result->tracks->items[$i]->album->release_date.'</p>
                                                <p>Availiable: '.sizeof($result->tracks->items[$i]->album->available_markets).' countries</p>
                                            </div>
                                        </div>
                                    </div>';
                                    $found = true;
                                }
                            }
                            
                        }
                        if(!$found){
                            echo '<h1 class="mt-5 ml-3">Not Found</h1>';
                        }
                    }
                ?>
            
        </div>
    </div>
</body>
</html>