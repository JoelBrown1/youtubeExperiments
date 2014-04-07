<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * 
 *
 * @package WordPress
 * @subpackage HIFI-basic
 * @since April 2014
 */

    get_header();

    // youtube api v3 (current)
    require_once ($_SERVER["DOCUMENT_ROOT"].'/API/youtube/google-api-php-client/src/Google_Client.php');  
    require_once ($_SERVER["DOCUMENT_ROOT"].'/API/youtube/google-api-php-client/src/contrib/Google_YouTubeService.php');  
    $DEVELOPER_KEY = 'AIzaSyBs_O3pjkf1T_ilus69HYnrcu0stEoBQHM'; 

    // presetting the variables so there is no data
    $videos = "";
    $channels = "";

    // setting up the build ribbon on page served
    $showsArray = array("HIFI Salutes","HIFI is Collecting","Guitar Picks Webisodes");
    // var_dump($showsArray);
    // echo "<br>==============================<br>";

    $client = new Google_Client();  
    $client->setDeveloperKey($DEVELOPER_KEY);  

    $youtube = new Google_YoutubeService($client);  

    foreach ($showsArray as $show) {
        $showData = $youtube->search->listSearch(
            'id,snippet', 
            array( 
                'channelId' => 'UCFYW7f1mdCpuGRJ__OKgMEQ', 
                'q' => $show,  
                'maxResults' => $_POST['maxResults'],
                'type' => 'video'
            )
        );
        // var_dump($showData);
        // echo "<br>============================<br>";
        ?>
        <h3> <?php echo $show; ?> </h3>
            <ul>
            <?php
                populateShow($showData);
            ?>
            </ul>
        <?php
        // echo "<br>============================<br>";
        // echo "============================<br>";
    }

    function populateShow($dataObj){
        foreach ($dataObj['items'] as $obj) { 
            $vidURL = "http://www.youtube.com/watch?v=".$obj['id']['videoId'];
            $vidThumb = $obj['snippet']['thumbnails']['default']["url"];
            $vidTitle = $obj['snippet']['title']
        ?>
            <li class="clearfix">
                <a href="<?php echo $vidURL; ?>" target='_blank'>
                    <img src="<?php echo $vidThumb; ?>" alt"<?php echo $vidTitle; ?>" />
                    <div class="showTitle"><?php echo $vidTitle; ?></div>
                </a>
            </li>
        <?php
            // var_dump($obj);
            // echo "<br>=====================================<br>";
        }
    }

/*    if($_POST){
      // Call set_include_path() as needed to point to your client library.  
      require_once ($_SERVER["DOCUMENT_ROOT"].'/API/youtube/google-api-php-client/src/Google_Client.php');  
      require_once ($_SERVER["DOCUMENT_ROOT"].'/API/youtube/google-api-php-client/src/contrib/Google_YouTubeService.php');  
      
      /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the 
      Google APIs Console <http://code.google.com/apis/console#access> 
      Please ensure that you have enabled the YouTube Data API for your project.   
      $DEVELOPER_KEY = 'AIzaSyBs_O3pjkf1T_ilus69HYnrcu0stEoBQHM';  
      
      $client = new Google_Client();  
      $client->setDeveloperKey($DEVELOPER_KEY);  
      
      $youtube = new Google_YoutubeService($client);  
      
      try {  
        $searchResponse = $youtube->search->listSearch('id,snippet', array( 
          'channelId' => 'UCFYW7f1mdCpuGRJ__OKgMEQ', 
          'q' => $_POST['q'],  
          'maxResults' => $_POST['maxResults']
        ));  
      
        $videos = '';  
        $channels = '';  
      
        foreach ($searchResponse['items'] as $searchResult) {  
//            var_dump($searchResult);
//            echo "<br>=========================================<br>";
          switch ($searchResult['id']['kind']) {  
            case 'youtube#video':  
/*                $videos .= sprintf(
                                    '<li>%s (%s)</li>', 
                                    $searchResult['snippet']['title'], 
                                    $searchResult['id']['videoId']."<a href=http://www.youtube.com/watch?v=".$searchResult['id']['videoId']." target=_blank>   Watch This Video</a>"
                                );
                $videos .= sprintf(
                                    '<li> %s </li>',
                                    "<a href=http://www.youtube.com/watch?v=".$searchResult['id']['videoId']." target=_blank><img src=".$searchResult['snippet']['thumbnails']['default']["url"]." </a>"
                                );
              break;  
            case 'youtube#channel':  
              $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],  
                $searchResult['id']['channelId']);  
              break;  
           }  
        }  
      
       } catch (Google_ServiceException $e) {  
        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',  
          htmlspecialchars($e->getMessage()));  
      } catch (Google_Exception $e) {  
        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',  
          htmlspecialchars($e->getMessage()));  
      }  
    }*/ 
//    - See more at: http://www.w3resource.com/API/youtube/tutorial.php#sthash.o44R0oKL.dpuf

// youtube api v2 (depricated)... 
    /*function get_thumbnail($src) {
        $video_id = explode("v/", $src);
        $video_id = explode("?", $video_id[1]);
        $video_id = $video_id[0];
        return $video_id;
    }

    $user    = "TheHIFIchannel";
    $userURL = "http://gdata.youtube.com/feeds/api/users/$user/uploads?v=2&max-results=50&alt=jsonc&start-index=1";
    // echo $userURL;
    // $url   = 'https://gdata.youtube.com/feeds/api/playlists/'.$id.'?v=2&alt=json';
    // $json  = @file_get_contents($url);
    // var_dump($json);
    $info = @file_get_contents($userURL);

    $data  = json_decode($info, TRUE);
    var_dump($data);
    echo "<br>===========================<br>";
    echo count($data[1]);
    echo "<br>===========================<br>";
    var_dump($data[0]);
    echo "<br>===========================<br>";
    var_dump($data->items);

    foreach($data as $e) {
        echo "number of elements in the entry array: ".count($e["items"]);
        echo "<br>===========================<br>";

        // var_dump($e["items"]);
        $entry = $e["items"];
        foreach ($entry as $element) {
            var_dump($element);
            echo "<br>===========================<br>";
            echo $element['title'];
            echo "<br>===========================<br>";
        }
        // echo "<br>==============================<br>";
        
        $thumbnail = get_thumbnail($e["content"]["src"]);
        echo $e["title"]["\$t"];
        echo nl2br($e["media\$group"]["media\$description"]["\$t"]);
        
    }*/
 
?>
<!--<section>
    <form method="POST" action=''>  
        <div>  
            Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">  
        </div>  
        <div>  
            Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">  
        </div>  
            <input type="submit" value="Search">  
        </form>  
        <h3>Videos</h3>  
        <ul><?php echo $videos; ?></ul>  
        <h3>Channels</h3>  
        <ul><?php echo $channels; ?></ul>  
 - See more at: http://www.w3resource.com/API/youtube/tutorial.php#sthash.o44R0oKL.dpuf 

</section> -->

        <script src=<?php echo(get_site_url())."/js/jquery-1.11.0.js"; ?>></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>

        <!-- build:js({app,.tmp}) scripts/main.js -->
        <script src=<?php echo(get_site_url())."/js/main.js"; ?>></script>
        <!-- endbuild -->
<?php get_footer(); ?>