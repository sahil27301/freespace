<head>
  <title>Display</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    ?>
    <div class="push">
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg sticky-top">
        <span class="navbar-brand" style="font-weight:bold;">freespace</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link scroll" href="#contact">Contact</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Go Back</a>
            </li>
        </div>
      </nav>
      <?php
      $server = "localhost";
      $username = "root";
      $password = "";
      $db = "freespace";
      echo "<h1 class='heading'>Click on any Paper to Download it</h1><hr>";
      $conn = new mysqli($server, $username, $password, $db);
      if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
      }
      else {
        $atleastOne=false;
        $sql="select * from documents";
        if (isset($_POST['topics'])) {
          $sql="select * from documents, topics";
        }
        if(isset($_POST['years'])){
          $sql=$sql." where (";
          $atleastOne=true;
          for ($i=0; $i < count($_POST['years']); $i++) {
            if ($i) {
              $sql=$sql." or";
            }
            $sql=$sql." doc_year='".$_POST['years'][$i]."'";
          }
          $sql=$sql.")";
        }
        if(isset($_POST['subjects'])){
          if (!$atleastOne) {
            $sql=$sql." where (";
          }else {
            $sql=$sql." and (";
          }
          $atleastOne=true;
          for ($i=0; $i < count($_POST['subjects']); $i++) {
            if ($i) {
              $sql=$sql." or";
            }
            $sql=$sql." doc_subject='".$_POST['subjects'][$i]."'";
          }
          $sql=$sql.")";
        }
        if(isset($_POST['dates'])){
          if (!$atleastOne) {
            $sql=$sql." where (";
          }else {
            $sql=$sql." and (";
          }
          $atleastOne=true;
          for ($i=0; $i < count($_POST['dates']); $i++) {
            if ($i) {
              $sql=$sql." or";
            }
            $sql=$sql." doc_date_asked='".$_POST['dates'][$i]."'";
          }
          $sql=$sql.")";
        }
        if(isset($_POST['exams'])){
          if (!$atleastOne) {
            $sql=$sql." where (";
          }else {
            $sql=$sql." and (";
          }
          $atleastOne=true;
          for ($i=0; $i < count($_POST['exams']); $i++) {
            if ($i) {
              $sql=$sql." or";
            }
            $sql=$sql." doc_exam='".$_POST['exams'][$i]."'";
          }
          $sql=$sql.")";
        }
        if(isset($_POST['topics'])){
          if (!$atleastOne) {
            $sql=$sql." where (";
          }else {
            $sql=$sql." and (";
          }
          $atleastOne=true;
          for ($i=0; $i < count($_POST['topics']); $i++) {
            if ($i) {
              $sql=$sql." or";
            }
            $sql=$sql." topic='".$_POST['topics'][$i]."'";
          }
          $sql=$sql.") and documents.doc_id=topics.doc_id";
        }
        $sql=$sql." group by documents.doc_id order by doc_date_asked desc";
        $r=mysqli_query($conn,$sql);
        ?>
        <?php
        while($row = mysqli_fetch_assoc($r)){
          echo "
            <a href='".$row['doc_link']."' target='blank'><h2 class='paper'>".$row['doc_subject']." ".$row['doc_exam']." - ".$row['doc_date_asked']."</h2></a>
            <h3 class='subHeading'>Asked to ".$row['doc_year']." students</h3>
          ";
          $conn2 = new mysqli($server, $username, $password, $db);
          if ($conn2->connect_error){
            die("Connection failed: " . $conn->connect_error);
          }else{
            $sql2="select * from topics where doc_id=".$row['doc_id'];
            $r2=mysqli_query($conn2,$sql2);
            $entered=false;
            while($row2 = mysqli_fetch_assoc($r2)){
              if(!$entered){
                echo "<h3 class='subHeading'>Topics</h3><div class='container-fluid topicListDiv'><ul>";
              }
              $entered=true;
              echo "<li class='displaySubject'>".$row2['topic']."</li>";
            }
            mysqli_close($conn2);
            if (!$entered) {
              echo "<h3 class='subHeading'>No topics are currently available for this paper</h3>";
            }else {
              echo "</ul></div>";
            }
            echo "<hr>";
          }
        }
        mysqli_close($conn);
        ?>
      </div>
      <div class="container-fluid contact" id='contact'>
        <h3>Contacts</h3>
        <p style='display:inline-block; font-weight:bold;'>Email: sahil.marwaha@spit.ac.in</p>
      </div>
      <script src="display.js" charset="utf-8"></script>
      <?php
    }
  }else
    {
  		?>
  		<meta http-equiv="refresh" content="5;URL=index.php" />
  		<p class="timer">Cannot access this page directly. You will be redirected in <span class="timer" id="countdowntimer">5 </span> Seconds</p>
  		<script type="text/javascript">
  	    var timeleft = 5;
  	    var downloadTimer = setInterval(function(){
  	    timeleft--;
  	    document.getElementById("countdowntimer").textContent = timeleft;
  	    if(timeleft <= 0)
  	        clearInterval(downloadTimer);
  	    },1000);
  	</script>
  	<?php
    }
  ?>
