<?php
function get_CURL($url)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

return json_decode($result, true);


}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCaAWRu53UW815hGTmxvHFbA&key=AIzaSyBD7s3DngbGko3x7MfqQh3Z38jC1XD2MNM');


$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

// latest video 
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBD7s3DngbGko3x7MfqQh3Z38jC1XD2MNM&channelId=UCaAWRu53UW815hGTmxvHFbA&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];

//Instagram API
$clientId = '17841446704969195';
$accessToken = 'IGAAJxmvZCZBh31BZAE0ydElEalFTTE9RLUFPT3lWRU1QSFR2QmdQZAnNZAbHZAnSFNQVkpPNGZA4ME5EcHVlZAm94YzRjNl9NZA0RaYldpTGRDRHpVYkpVR3VpZAFgyTURFUmFuRHphc0x4UU41MTZAJS2NJRjFTbWoyazBVZAUVWZAjQtREkwcwZDZD';

$result = get_CURL("https://graph.instagram.com/v22.0/me?fields=username,profile_picture_url,followers_count&access_token=$accessToken");
$usernameIG = $result['username'];
$profilePictureIG = $result['profile_picture_url'];
$followersIG = $result['followers_count'];

//media IG
$media = get_CURL("https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type,timestamp&access_token=$accessToken");
$gambar = "";
if (isset($media['data']) && count($media['data']) >= 1) {
    $gambar = $media['data'][0]['media_url'];
}



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Karina Rachmadini Purba</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="img/profile3.png" class="rounded-circle img-thumbnail">
          <h1 class="display-4">Karina Rachmadini Purba</h1>
          <h3 class="lead">Student | Programmer | Youtuber</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Saya Karina Rachmadini Purba, seorang mahasiswa Sistem Informasi di UINIB Padang. Saya memiliki ketertarikan besar untuk mencoba berbagai hal baru, selalu berusaha menantang diri sendiri dan belajar melalui pengalaman. Perjalanan saya di dunia teknologi dimulai dengan rasa penasaran terhadap pemrograman, yang kini menjadi salah satu minat utama saya. Meskipun masih terus belajar dan mengasah keterampilan, saya sangat antusias dengan berbagai peluang yang ditawarkan oleh dunia ini.</p>
          </div>
          <div class="col-md-5">
            <p>Di luar pemrograman, saya juga tertarik pada pembuatan konten digital. Saya menikmati merekam aktivitas sehari-hari, berbagi proses belajar, dan membagikannya di YouTube. Menjadi kreator memberi saya ruang berekspresi dan berinteraksi dengan lebih banyak orang. Saya terus bersemangat menjelajahi peluang baru di dunia coding maupun konten kreatif.</p>
          </div>
        </div>
      </div>
    </section>


    <!-- Youtube & IG -->
     <section class="social  bg-light" id="social">
     <div class="container">
      <div class="row pt-4 mb-4">
      <div class="col text-center">
        <h2>Social Media</h2>

      </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
             <img src="<?= $youtubeProfilePic; ?>" width="200" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?= $channelName; ?></h5>
              <p><?= $subscriber; ?>Subscribers.</p>
              <div class="g-ytsubscribe" data-channelid="UCaAWRu53UW815hGTmxvHFbA" data-layout="default" data-count="default"></div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="row">
              <div class="col">
                <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/<?= $latestVideoId;?>?rel=0" title="YouTube video" 
          allowfullscreen></iframe>
          </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $profilePictureIG; ?>" width="200" class="rounded-circle img-thumbnail">
            </div>
             <div class="col-md-8">
              <h5><?= $usernameIG; ?></h5>
              <p><?= $followersIG; ?>Followers</p>
            </div>
          </div>

          <div class="row mt-3 pb-3">
            <div class="col-md-6">
          <img src="<?= $gambar; ?>" class="img-fluid rounded img-thumbnail">
      </div>
      </div>
      </div>
      </div>
    </div>
    </section>





    <!-- Portfolio -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-6 mt-5">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/8.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Mengikuti organisasi PMI.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/2.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Membuat web menggunakan rest-api</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/9.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Memasak.</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Programming.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">JSON.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Office</li>
              <li class="list-group-item">Jl. Sungai Bangek, Padang</li>
              <li class="list-group-item">West Sumatra, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2025.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  </body>
</html>