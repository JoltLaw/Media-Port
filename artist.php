<?php include("includes/includedFiles.php");

if(isset($_GET["id"])) {
$artistId = $_GET["id"];
} else {
  header("Location: index.php");
}

$artist = new Artist($conn, $artistId);

?>


<div class="entityInfo borderBottom">
  <div class="centerSection">
    <div class="artistInfo">

      <h1 class="artistName"><?php echo $artist->getName(); ?></h1>
      
      <div class="headerBtns">

        <button class="btn orange" onclick="playFirstSong()">Play</button>
      </div>
    </div>
  </div>
</div>

<div class="tracklistContainer borderBottom">
  <h2>SONGS</h2>
      <ul class="tracklist">
        <?php 
          $songIdArray = $artist->getSongIds();
          $i = 1;
          foreach($songIdArray as $songId){
            if($i > 5) {
              break;
            } 
            $artistSong = new Song($conn, $songId);
          echo  "<li class='tracklistRow'>
                    <div class='trackCount'> 
                    <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"". $artistSong->getId() ."\", tempPlaylist, true)' >
                    <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'> 
                    <span class='trackName'>" . $artistSong->getTitle() ."</span>
                    <span class='artistName'>" . $artist->getName() ."</span>
                    </div>

                    <div class='trackOptions'> 
                    <input type='hidden' class='songId' value='" . $albumSong->getId() ."'>
                    <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'> 
                      <span class='duration'>" . $artistSong->getDuration() . "</span>
                    </div>
                  </li>";
            $i++;
          }
        ?></ul>
        <script>
          var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
          tempPlaylist = JSON.parse(tempSongIds);
        </script>

</div>

<div class="gridViewContainer">
  <h2>ALBUMS</h2>
  <?php $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE artist=$artistId");
    while($row = mysqli_fetch_array($albumQuery)) {
      echo "<div class='gridViewItem'>
          <span onclick='openPage(\"album.php?id=" . $row['id'] . "\")' role='link' tabindex='0'>
          <img src='". $row["artworkPath"] ."'>
          <div class='gridViewInfo'> "
          . $row["title"] .
          "</div>
          </span>
      </div>";
    }
  ?>
      
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistDropdown($conn, $userLoggedIn->getUserName()); ?>
  </nav>