<?php require_once "../includes/adminHeader.php" ?>
<div class="adminmain">
  <form>
<div class="section no-pad-bot  card-style" id="index-banner">
     <div class="card card-style">
        <div class="card-image">
          <img class="responsive-img" src="../images/index1.jpg">
        </div>
      </div>
      <div class="container">
      <h1 class="header center orange-text">Online Tutoring</h1>
      <div class="row center">
        <h5 class="header col s12 light">
        <textarea id="textarea1" class="materialize-textarea">Our mentoring programs are customized to meet the learning needs of each student,whether he or she is falling behind in course or needs assistance progressing his orher grades.</textarea>
        <label for="textarea1">Textarea</label></h5>
      </div>
      <!-- <div class="row center">
        <a href="register.php" id="download-button" class="btn-large waves-effect waves- blue-grey">Register now</a>
      </div> -->
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">
      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center orange-text"><i class="material-icons">note</i></h2>
            <input placeholder="Placeholder" id="first_name" type="text" value="Online notes and PDFs" class="validate">
          <label for="first_name">Title</label>
            <textarea id="textarea2" class="materialize-textarea">Coaching expenses shouldn’t stand in the way of making a difference to reach your potential. At our learning center, we donate families over the nation to get coaching administrations that are worth each penny.</textarea>
            <label for="textarea1">Online notes and PDFs</label>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center orange-text"><i class="material-icons">desktop_windows</i></h2>
            <input placeholder="Placeholder" id="first_name" type="text" value="Instant tutoring" class="validate">
            <textarea id="textarea2" class="materialize-textarea">We know the costs of raising children add up rapidly. That’s why our learning offers a competitive hourly rate that's steady with professionally prepared supplemental instruction suppliers industry-wide, furthermore available installment options.</textarea>
            <label for="textarea1">Instant Tutoring</label>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center orange-text"><i class="material-icons">book</i></h2>
            <input placeholder="Placeholder" id="first_name" type="text" value="Best Result" class="validate">
            <textarea id="textarea2" class="materialize-textarea">Our mentoring programs are customized to meet the learning needs of each student, whether he or she is falling behind in course or needs assistance progressing his or her grades.</textarea>
            <label for="textarea1">Best results</label>
          </div>
        </div>
        
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Update
              <i class="material-icons right">create</i>
            </button>
          </div>
      </div>

    </div>
    <br><br>
  </div>
  </form>
</div>
  <?php require_once "../includes/adminFooter.php" ?>