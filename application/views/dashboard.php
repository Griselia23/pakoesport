<?php include(APPPATH . 'views/layout/header.php'); ?>
<!-- Main content here, like the body of the page -->
<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
      <a href="#intro" class="scrollto"><img src="<?php echo base_url('application/template/img/logo.png'); ?>" alt="" title=""></a>
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="menu-active"><a href="#intro">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#leaderboard">Leaderboard</a></li>
        <li><a href="#schedule">Schedule</a></li>
        <li><a href="#venue">Venue</a></li>
        <li><a href="#teams">Upload Result</a></li>
        <!-- <li><a href="#gallery">Gallery</a></li> -->
        <li><a href="#buy-tickets">Register</a></li>
        <!-- <li><a href="#contact">Contact</a></li> -->
        <li class="buy-tickets"><a href="login">Admin</a></li>
        
      </ul>
    </nav><!-- #nav-menu-container -->
  </div>
</header><!-- #header -->

<!-- Your main content continues here -->
<section id="intro">
  <div class="intro-container wow fadeIn">
    <h1 class="mb-4 pb-0">The Annual<br><span>Gaming</span> League</h1>
    <p class="mb-4 pb-0">29-31 February, Pako Group, Karawang</p>
    <a href="https://www.youtube.com/watch?v=rYBjPWV3esY" class="venobox play-btn mb-4" data-vbtype="video"
      data-autoplay="true"></a>
    <a href="#about" class="about-btn scrollto">About The Event</a>
  </div>
</section>

<main id="main">

  <!--==========================
      About Section
    ============================-->
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h2>About The Event</h2>
          <p>Pako Esport is an activity's held by Pako Group institution that leads all the workers
            to join the gaming league that available every year in every plants that pako has</p>
        </div>
        <div class="col-lg-3">
          <h3>Where</h3>
          <p>Inkoasku, Karawang Surya Cipta</p>
        </div>
        <div class="col-lg-3">
          <h3>When</h3>
          <p>Monday to Wednesday<br>29-31 Feb</p>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
      Speakers Section
    ============================-->
  <section id="leaderboard" class="wow fadeInUp">
    <div class="container">
      <div class="section-header">
        <h2>Leaderboard</h2>
        <p>Here is the leaderboard</p>
      </div>


    </div>

  </section>

  <!--==========================
      Schedule Section
    ============================-->
    <section id="schedule" class="section-with-bg">
    <div class="container wow fadeInUp">
        <div class="section-header">
            <h2>Event Schedule</h2>
            <p>Here is our event schedule</p>
        </div>

        <div class="schedule-toggle-stripe">
            <span id="mlbtn" class="toggle-stripe active">Mobile Legends</span>
            <span id="fifabtn" class="toggle-stripe">FIFA</span>
        </div>

        <div id="mobileLegendsTable" class="schedule-table">
            <h3>Mobile Legends Schedule</h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Match</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="fifaTable" class="schedule-table" style="display:none;">
            <h3>FIFA Schedule</h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Match</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Include External JS File -->
<script src="script.js"></script>


  <!--==========================
      Venue Section
    ============================-->
  <section id="venue" class="wow fadeInUp">

    <div class="container-fluid">

      <div class="section-header">
        <h2>Event Venue</h2>
        <p>Event venue location info and gallery</p>
      </div>

      <div class="row no-gutters">
        <div class="col-lg-6 venue-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.819724626866!2d107.34923760963044!3d-6.417204762729167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6974ef0453eda3%3A0x9bb7f0952787436d!2sInkoasku%20-%20Pako%20Group%20Pt.%2C%20Kutanegara%2C%20Kec.%20Ciampel%2C%20Karawang%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1735198068092!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="col-lg-6 venue-info">
          <div class="row justify-content-center">
            <div class="col-11 col-lg-8">
              <h3>PT Inkoasku, Karawang</h3>
              <p>Factory of the best rim in indonesia</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container-fluid venue-gallery-container">
      <div class="row no-gutters">

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/1.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/1.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/2.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/2.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/3.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/3.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/4.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/4.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/5.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/5.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/6.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/6.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/7.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/7.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="venue-gallery">
            <a href="application/template/img/venue-gallery/8.jpg" class="venobox" data-gall="venue-gallery">
              <img src="application/template/img/venue-gallery/8.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

      </div>
    </div>

  </section>

  <!--==========================
      Hotels Section
    ============================-->
  <section id="teams" class="section-with-bg wow fadeInUp">

      <!-- upload_result_view.php -->
<div class="container">
    <div class="section-header">
        <h2>Upload Result</h2>
        <p>Fill this form to upload the match result.</p>
    </div>
    
</div>


       
      </div>

    </section>

  <!--==========================
      Gallery Section
    ============================-->
  <!-- <section id="gallery" class="wow fadeInUp">

    <div class="container">
      <div class="section-header">
        <h2>Gallery</h2>
        <p>Check our gallery from the recent events</p>
      </div>
    </div>

    <div class="owl-carousel gallery-carousel">
      <a href="application/template/img/gallery/1.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/1.jpg" alt=""></a>
      <a href="application/template/img/gallery/2.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/2.jpg" alt=""></a>
      <a href="application/template/img/gallery/3.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/3.jpg" alt=""></a>
      <a href="application/template/img/gallery/4.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/4.jpg" alt=""></a>
      <a href="application/template/img/gallery/5.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/5.jpg" alt=""></a>
      <a href="application/template/img/gallery/6.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/6.jpg" alt=""></a>
      <a href="application/template/img/gallery/7.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/7.jpg" alt=""></a>
      <a href="application/template/img/gallery/8.jpg" class="venobox" data-gall="gallery-carousel"><img src="application/template/img/gallery/8.jpg" alt=""></a>
    </div>

  </section> -->

  <!--==========================
      Sponsors Section
    ============================-->
  <!-- <section id="sponsors" class="section-with-bg wow fadeInUp">

    <div class="container">
      <div class="section-header">
        <h2>Sponsors</h2>
      </div>

      <div class="row no-gutters sponsors-wrap clearfix">

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/1.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/2.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/3.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/4.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/5.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/6.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/7.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="sponsor-logo">
            <img src="application/template/img/sponsors/8.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>

    </div>

  </section> -->

  <!--==========================
      F.A.Q Section
    ============================-->
  <section id="faq" class="wow fadeInUp">

    <div class="container">

      <div class="section-header">
        <h2>F.A.Q </h2>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-9">
          <ul id="faq-list">

            <li>
              <a data-toggle="collapse" class="collapsed" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="fa fa-minus-circle"></i></a>
              <div id="faq1" class="collapse" data-parent="#faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="fa fa-minus-circle"></i></a>
              <div id="faq2" class="collapse" data-parent="#faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="fa fa-minus-circle"></i></a>
              <div id="faq3" class="collapse" data-parent="#faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="fa fa-minus-circle"></i></a>
              <div id="faq4" class="collapse" data-parent="#faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="fa fa-minus-circle"></i></a>
              <div id="faq5" class="collapse" data-parent="#faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="fa fa-minus-circle"></i></a>
              <div id="faq6" class="collapse" data-parent="#faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                </p>
              </div>
            </li>

          </ul>
        </div>
      </div>

    </div>

  </section>

  <!--==========================
      Subscribe Section
    ============================-->
  <section id="subscribe">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h2>Last Winner</h2>
        <p>Last Season Winner Each Divisions</p>
      </div>
    </div>
  </section>

  <!--==========================
      Buy Ticket Section
    ============================-->
  <section id="buy-tickets" class="section-with-bg wow fadeInUp">
    <div class="container">

      <div class="section-header">
        <h2>Registration</h2>
        <p>Dare to lose is the winner!</p>
      </div>

      <div class="row">
        <!-- Card for registration form -->
        <div class="card">
          <h3>Register Your Team</h3>
          <form action="<?= base_url('dashboard/submit_registration') ?>" method="POST">
            <!-- Team Information -->
            <div class="form-group">
              <label for="team">Team Name:</label>
              <input type="text" id="team" name="team" required placeholder="Enter team name">
            </div>

            <div class="form-group">
              <label for="plant">Plant:</label>
              <input type="text" id="plant" name="plant" required placeholder="Enter plant name">
            </div>

            <div class="form-group">
              <label for="leadernpk">Leader NPK:</label>
              <input type="number" id="leadernpk" name="leadernpk" required placeholder="Enter leader's NPK">
            </div>

            <div class="form-group">
              <label for="leadername">Leader Name:</label>
              <input type="text" id="leadername" name="leadername" required placeholder="Enter leader's name">
            </div>

            <div class="form-group">
              <label for="number">Leader No hp:</label>
              <input type="text" id="number" name="number" required placeholder="Enter whatsapp number">
            </div>

            <div class="form-group">
              <label for="division">Division:</label>
              <select id="division" name="division" required>
                <option value="" disabled selected>Select Division</option>
                <option value="ml">Mobile Legend</option>
                <option value="fifa">FIFA</option>
              </select>
            </div>
            
            <!-- Member Information -->
            <h4>Members:</h4>

            <div id="members-container">
              <!-- First Member Input -->
              <div class="form-group member">
                <label for="member1npk">Member 1 NPK:</label>
                <input type="number" id="member1npk" name="member1npk" placeholder="Enter member 1 NPK">
                <label for="member1name">Member 1 Name:</label>
                <input type="text" id="member1name" name="member1name" placeholder="Enter member 1 name">
              </div>
            </div>

            <div class="form-group">
    <button type="button" id="add-member-btn" style="float: left;">Add Member</button>
    <button type="submit" style="float: right;">Submit</button>
</div>

          </form>
        </div>

  </section>

  <!--==========================
      Contact Section
    ============================-->
  <!-- <section id="contact" class="section-bg wow fadeInUp">

    <div class="container">

      <div class="section-header">
        <h2>Contact Us</h2>
        <p>Nihil officia ut sint molestiae tenetur.</p>
      </div>

      <div class="row contact-info">

        <div class="col-md-4">
          <div class="contact-address">
            <i class="ion-ios-location-outline"></i>
            <h3>Address</h3>
            <address>A108 Adam Street, NY 535022, USA</address>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-phone">
            <i class="ion-ios-telephone-outline"></i>
            <h3>Phone Number</h3>
            <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-email">
            <i class="ion-ios-email-outline"></i>
            <h3>Email</h3>
            <p><a href="mailto:info@example.com">info@example.com</a></p>
          </div>
        </div>

      </div>

      <div class="form">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <form action="" method="post" role="form" class="contactForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validation"></div>
            </div>
            <div class="form-group col-md-6">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
            <div class="validation"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
            <div class="validation"></div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
      </div>

    </div>
  </section>#contact -->

</main>

<script>
  document.getElementById("add-member-btn").addEventListener("click", function() {
    var memberCount = document.querySelectorAll(".member").length;

    // Limit to 5 members
    if (memberCount < 5) {
      var memberContainer = document.getElementById("members-container");

      var newMemberDiv = document.createElement("div");
      newMemberDiv.classList.add("form-group", "member");

      // Create Member NPK input
      var memberNPKLabel = document.createElement("label");
      memberNPKLabel.setAttribute("for", "member" + (memberCount + 1) + "npk");
      memberNPKLabel.textContent = "Member " + (memberCount + 1) + " NPK:";
      newMemberDiv.appendChild(memberNPKLabel);
      var memberNPKInput = document.createElement("input");
      memberNPKInput.setAttribute("type", "number");
      memberNPKInput.setAttribute("id", "member" + (memberCount + 1) + "npk");
      memberNPKInput.setAttribute("name", "member" + (memberCount + 1) + "npk");
      memberNPKInput.setAttribute("placeholder", "Enter member " + (memberCount + 1) + " NPK");
      newMemberDiv.appendChild(memberNPKInput);

      // Create Member Name input
      var memberNameLabel = document.createElement("label");
      memberNameLabel.setAttribute("for", "member" + (memberCount + 1) + "name");
      memberNameLabel.textContent = "Member " + (memberCount + 1) + " Name:";
      newMemberDiv.appendChild(memberNameLabel);
      var memberNameInput = document.createElement("input");
      memberNameInput.setAttribute("type", "text");
      memberNameInput.setAttribute("id", "member" + (memberCount + 1) + "name");
      memberNameInput.setAttribute("name", "member" + (memberCount + 1) + "name");
      memberNameInput.setAttribute("placeholder", "Enter member " + (memberCount + 1) + " name");
      newMemberDiv.appendChild(memberNameInput);

      // Append the new member div to the container
      memberContainer.appendChild(newMemberDiv);
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
  // Check if there's flashdata for success or error
  <?php if ($this->session->flashdata('success')): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '<?= $this->session->flashdata('success'); ?>',
      showConfirmButton: true,
      timer: 4000 // The alert will disappear after 4 seconds
    });
  <?php elseif ($this->session->flashdata('error')): ?>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?= $this->session->flashdata('error'); ?>',
      showConfirmButton: true,
      timer: 4000 // The alert will disappear after 4 seconds
    });
  <?php endif; ?>
</script>


<?php include(APPPATH . 'views/layout/footer.php'); ?>

<!-- schedule script -->

<script>
    
const mlbtn = document.getElementById('mlbtn');
const fifabtn = document.getElementById('fifabtn');
const mobileLegendsTable = document.getElementById('mobileLegendsTable');
const fifaTable = document.getElementById('fifaTable');

// Add event listeners for the toggle buttons
mlbtn.addEventListener('click', function() {
    mobileLegendsTable.style.display = 'block';
    fifaTable.style.display = 'none';
    mlbtn.classList.add('active');
    fifabtn.classList.remove('active');
});

fifabtn.addEventListener('click', function() {
    mobileLegendsTable.style.display = 'none';
    fifaTable.style.display = 'block';
    fifabtn.classList.add('active');
    mlbtn.classList.remove('active');
});
window.addEventListener('load', function() {
    mlbtn.click();
});

</script>