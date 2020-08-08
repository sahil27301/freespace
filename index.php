<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>freespace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 class="heading">Welcome to freespace</h1>
    <h3 class="subHeading">(Like dspace, but better)</h3>
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg sticky-top">
        <span class="navbar-brand" href="">freespace</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link scroll" href="#inst">How To</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#year">Years</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#subject">Subjects</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#topics">Topics</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#dateAsked">Year Asked</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#examType">Exam Type</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link scroll" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
        <form class="form-inline formClass" action="display.php" method="post">
          <button class="btn btn-outline-light btn-lg my-2 my-sm-0 search" type="submit">Search</button>
        </form>
      </nav>
    <div class="instructions container-fluid" id="inst">
      <h3 class="instHead">How To</h3>
      <ul>
        <li>This is a free, convenient and easy-access repository of SPIT test papers.</li>
        <li>Hitting search straightaway will display all available papers.</li>
        <li>Selecting one or more items under each parameter will restrict the search results to items that match the specified parameters.</li>
        <li>Selecting multiple options in one parameter will show results with <strong><em>any one</em></strong> matching condition.</li>
        <li>Selecting options under multiple parameters will show results with <strong><em>atleast one</em></strong> matching condition in <strong><em>each field</em></strong>.</li>
        <li>If anything is unclear, please feel free to reach out to us at our <a class='contactLink scroll' href="#contact">contact section</a>.</li>
      </ul>
    </div>
    <div class="year container-fluid" id="year">
      <div class="row">
        <p class="prompt col-12">Select 0 or more years</p>
          <?php
          $server = "localhost";
          $username = "root";
          $password = "";
          $db = "freespace";
          $conn = new mysqli($server, $username, $password, $db);
          if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
          }
          else{
            $sql="select distinct doc_year from documents";
            $r=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($r)){
              echo "
                <div class='col-lg-3 col-md-6 col-sm-12'>
                  <button type='button' name='year' class='button yearButton btn btn-lg'>".$row['doc_year']."</button>
                </div>
              ";
            }
            mysqli_close($conn);
          }
          ?>
      </div>
    </div>
    <?php
    $conn = new mysqli($server, $username, $password, $db);
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }
    else{
      $sql="select distinct doc_subject from documents";
      $r=mysqli_query($conn,$sql);
    ?>
    <div class="subject container-fluid" id="subject">
      <p class="prompt">Select 0 or more subjects</p>
      <input type="text" placeholder="Start typing to search" class="subjectSearch">
      <div class="row">
        <?php
          while($row = mysqli_fetch_assoc($r)){
            echo "
              <div class='col-lg-3 col-md-6 col-sm-12'>
                <button type='button'class='button subjectButton btn btn-lg'>".$row['doc_subject']."</button>
              </div>
            ";
          }
        ?>
      </div>
    </div>
    <?php
      }
      mysqli_close($conn);
    ?>
    <div class="topics container-fluid" id="topics">
      <p class="prompt">Select 0 or more topics</p>
      <input type="text" placeholder="Start typing to search" class="topicSearch">
      <div class="row">
          <?php
          $conn = new mysqli($server, $username, $password, $db);
          if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
          }
          else{
            $sql="select distinct topic from documents, topics where documents.doc_id=topics.doc_id";
            $r=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($r)){
              echo "
                <div class='col-lg-3 col-md-6 col-sm-12'>
                  <button type='button' class='button topicButton btn btn-lg'>".$row['topic']."</button>
                </div>
              ";
            }
            mysqli_close($conn);
          }
          ?>
      </div>
    </div>
    <div class="dateAsked container-fluid" id="dateAsked">
      <p class="prompt">Select 0 or more years asked</p>
      <input type="text" placeholder="Start typing to search" class="dateSearch">
      <div class="row">
          <?php
          $conn = new mysqli($server, $username, $password, $db);
          if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
          }
          else{
            $sql="select distinct doc_date_asked from documents";
            $r=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($r)){
              echo "
                <div class='col-lg-3 col-md-6 col-sm-12'>
                  <button type='button' class='button dateAskedButton btn btn-lg'>".$row['doc_date_asked']."</button>
                </div>
              ";
            }
            mysqli_close($conn);
          }
          ?>
      </div>
    </div>
    <div class="examType container-fluid" id="examType">
      <p class="prompt">Select 0 or more exam types</p>
      <div class="row">
          <?php
          $conn = new mysqli($server, $username, $password, $db);
          if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
          }
          else{
            $sql="select distinct doc_exam from documents";
            $r=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($r)){
              echo "
                <div class='col-lg-4 col-md-6 col-sm-12'>
                  <button type='button' class='button examTypeButton btn btn-lg'>".$row['doc_exam']."</button>
                </div>
              ";
            }
            mysqli_close($conn);
          }
          ?>
      </div>
    </div>
    <div class="container-fluid contact" id='contact'>
      <h3>Contacts</h3>
      <p style='display:inline-block; font-weight:bold;'>Email: sahil.marwaha@spit.ac.in</p>
    </div>
    <script src="index.js" charset="utf-8"></script>
  </body>
</html>
