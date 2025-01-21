<?php include(APPPATH . 'views/layout/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
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
        <li><a href="uploadresult">Upload Result</a></li>
        <!-- <li><a href="#gallery">Gallery</a></li> -->
        <li><a href="#buy-tickets">Register</a></li>
        <!-- <li><a href="#contact">Contact</a></li> -->
        <li class="buy-tickets"><a href="admin">Admin</a></li>
      </ul>

    </nav>
  </div>
</header>
<style>
  body {
    zoom: 120%;
  }
</style>

<section id="intro">
  <div class="intro-container wow fadeIn">

    <!-- Intro Text -->
    <h1 class="mb-4 pb-0">The Annual<br><span>Gaming</span> League</h1>
    <p class="mb-4 pb-0">Pako Group, Karawang</p>
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
  <section id="leaderboard" class="section-with-bg">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h2>Leaderboard</h2>
        <p>Join to compete!</p>
      </div>

      <div class="schedule-toggle-stripe">
        <span id="mlbtn1" class="toggle-stripe active">Mobile Legends</span>
        <span id="fifabtn1" class="toggle-stripe">FIFA</span>
      </div>

      <!-- Mobile Legends Leaderboard -->
      <div id="mobileLegendsLeaderboard" class="mt-4">
        <h3>Leaderboard - Mobile Legends</h3>
        <table id="mlLeaderboard" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" style="color: black;">Rank</th>
              <th scope="col" style="color: black;">Team</th>
              <th scope="col" style="color: black;">Play</th>
              <th scope="col" style="color: black;">Win</th>
              <th scope="col" style="color: black;">Lose</th>
              <th scope="col" style="color: black;">Points</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ml_leaderboard as $team): ?>
              <tr>
                <td><?php echo $team['rank']; ?></td>
                <td><?php echo $team['team']; ?></td>
                <td><?php echo $team['play']; ?></td>
                <td><?php echo $team['win']; ?></td>
                <td><?php echo $team['lose']; ?></td>
                <td><?php echo $team['points']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- FIFA Leaderboard -->
      <div id="fifaLeaderboard" class="mt-4" style="display:none;">
        <h3>Leaderboard - FIFA</h3>
        <table id="fifaLeaderboardTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" style="color: black;">Rank</th>
              <th scope="col" style="color: black;">Team</th>
              <th scope="col" style="color: black;">Play</th>
              <th scope="col" style="color: black;">Win</th>
              <th scope="col" style="color: black;">Lose</th>
              <th scope="col" style="color: black;">Draw</th>
              <th scope="col" style="color: black;">Points</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fifa_leaderboard as $team): ?>
              <tr>
                <td><?php echo $team['rank']; ?></td>
                <td><?php echo $team['team']; ?></td>
                <td><?php echo $team['play']; ?></td>
                <td><?php echo $team['win']; ?></td>
                <td><?php echo $team['lose']; ?></td>
                <td><?php echo $team['draw']; ?></td>
                <td><?php echo $team['points']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </section>

  <!-- DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#mlLeaderboard').DataTable();
      $('#fifaLeaderboardTable').DataTable();
    });
  </script>

  <script>
    const mlbtn1 = document.getElementById('mlbtn1');
    const fifabtn1 = document.getElementById('fifabtn1');
    const mobileLegendsLeaderboard = document.getElementById('mobileLegendsLeaderboard');
    const fifaLeaderboard = document.getElementById('fifaLeaderboard');

    // Add event listeners for the toggle buttons
    mlbtn1.addEventListener('click', function() {
      mobileLegendsLeaderboard.style.display = 'block';
      fifaLeaderboard.style.display = 'none';
      mlbtn1.classList.add('active');
      fifabtn1.classList.remove('active');
    });

    fifabtn1.addEventListener('click', function() {
      mobileLegendsLeaderboard.style.display = 'none';
      fifaLeaderboard.style.display = 'block';
      fifabtn1.classList.add('active');
      mlbtn1.classList.remove('active');
    });

    // Trigger the first click event to display the Mobile Legends table by default
    window.addEventListener('load', function() {
      mlbtn1.click();
    });
  </script>

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

      <!-- Mobile Legends Table -->
      <div id="mobileLegendsTable" class="schedule-table">
        <h3>Mobile Legends Schedule</h3>
        <table id="mlTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" style="color: black;">Date</th>
              <th scope="col" style="color: black;">Match</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($matches_by_division['ml']) && !empty($matches_by_division['ml'])): ?>
              <?php foreach ($matches_by_division['ml'] as $match): ?>
                <tr>
                  <td><?php echo date('Y-m-d', strtotime($match['match_day'])); ?></td>
                  <td><?php echo $match['match_title']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="2">No matches scheduled.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- FIFA Table -->
      <div id="fifaTable" class="schedule-table" style="display:none;">
        <h3>FIFA Schedule</h3>
        <table id="fifaTableData" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" style="color: black;">Date</th>
              <th scope="col" style="color: black;">Match</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($matches_by_division['fifa']) && !empty($matches_by_division['fifa'])): ?>
              <?php foreach ($matches_by_division['fifa'] as $match): ?>
                <tr>
                  <td><?php echo date('Y-m-d', strtotime($match['match_day'])); ?></td>
                  <td><?php echo $match['match_title']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="2">No matches scheduled.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <script>
        $(document).ready(function() {
          $('#mlTable').DataTable();
          $('#fifaTableData').DataTable();
        });
      </script>



    </div>
  </section>

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
        <h2>Rules</h2>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-9">
          <ul id="faq-list">

            <li>
              <a data-toggle="collapse" class="collapsed" href="#faq1">Registrasi cukup 1 kali diwakili oleh leader perteam<i class="fa fa-minus-circle"></i></a>
              <div id="faq1" class="collapse" data-parent="#faq-list">
                <p>
                  Isi data team, masukkan npk dan password yang mudah diingat, catat jika perlu!
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq2" class="collapsed">Upload hasil diwakili oleh team yang menang dalam masing masing pertandingan <i class="fa fa-minus-circle"></i></a>
              <div id="faq2" class="collapse" data-parent="#faq-list">
                <p>
                  Pilih match secara bijak untuk upload hasil dan pastikan untuk jujur.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq3" class="collapsed">Ketauan licik dalam upload hasil akan diberikan sanksi sesuai pelanggaran!<i class="fa fa-minus-circle"></i></a>
              <div id="faq3" class="collapse" data-parent="#faq-list">
                <p>
                  Bijak terhadap upload hasil karena kami percaya kepada anda.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq4" class="collapsed">Score ML dan FIFA berbeda!<i class="fa fa-minus-circle"></i></a>
              <div id="faq4" class="collapse" data-parent="#faq-list">
                <p>
                  FIFA menang akan mendapat 3 points kalah 0 dan draw 1, ML menang akan mendapatkan point dari banyak nya kemenangan.
                </p>
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq5" class="collapsed">Lupa password!<i class="fa fa-minus-circle"></i></a>
              <div id="faq5" class="collapse" data-parent="#faq-list">
                <p>
                  Minta panitia untuk berikan password baru sesuai nama tim dan npk leader.
              </div>
            </li>

            <li>
              <a data-toggle="collapse" href="#faq6" class="collapsed">Dilarang melontarkan kalimat toxic atau menyangkut rasisme antar tim!<i class="fa fa-minus-circle"></i></a>
              <div id="faq6" class="collapse" data-parent="#faq-list">
                <p>
                  Raih juaramu tanpa menyakiti team lain!
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

    <div class="row justify-content-center">
      <!-- Card for registration form -->
      <div class="card registration-card" id="registration-form">
        <h3>Register Your Team</h3>
        <p style="font-size: 0.8em; color: rgba(0, 0, 0, 0.6); font-style: bold;">Baca <a href="#faq">peraturan</a> sebelum mendaftar!</p>
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
            <label for="npk">Leader NPK:</label>
            <input type="text" id="npk" name="npk" required placeholder="Enter leader's NPK">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <h7 style="font-size: 0.8em; color: rgba(0, 0, 0, 0.6); font-style: italic;">*ingat password untuk login upload result nantinya</h7>
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
              <input type="text" id="member1npk" name="member1npk" placeholder="Enter member 1 NPK">
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

    </div>
  </div>
</section>

<style>
  
  .registration-card {
    max-width: 500px; 
    margin: 0 auto; 
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  
  .form-group {
    margin-bottom: 1em;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
  }

  .section-header h2 {
    font-size: 2em;
  }

  
  @media (max-width: 768px) {
    .registration-card {
      width: 90%; 
    }
  }
</style>


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
      memberNPKInput.setAttribute("type", "text");
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

<script>
  window.onload = function() {
    var form = document.getElementById('registration-form');
    var formState = sessionStorage.getItem('hideRegistrationForm');

    if (formState === 'true') {
      form.style.display = 'none';  // Hide the form
    } else {
      form.style.display = 'block';  // Show the form
    }
  };
</script>

