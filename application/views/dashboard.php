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
<style>
 .upload-result-form {
  margin-top: 20px;
  font-family: Arial, sans-serif;
}

.smaller-container {
  width: 50%; /* You can adjust this percentage to make it smaller or bigger */
  margin: 0 auto;
  padding: 20px;
  background-color: #fff; /* White background for the form box */
  border-radius: 10px; /* Rounded corners */
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Drop shadow */
}

.match-selection,
.team-selection,
.score-inputs,
.upload-section,
.submit-section {
  margin-bottom: 20px;
}

.match-selection label,
.team-selection label,
.score-inputs label,
.upload-section label {
  font-weight: bold;
  display: block;
  margin-bottom: 10px;
}

.form-row {
  display: flex;
  justify-content: space-between; /* Distribute items evenly across the row */
  align-items: center;
  flex-wrap: wrap; /* Wrap if space is too small */
}

.form-row > div {
  margin-right: 10px;
  flex: 1; /* Allow all items to flex and adjust their width */
  min-width: 120px; /* Set a minimum width for each input */
}

.vs {
  font-weight: bold;
  font-size: 20px;
  padding: 0 15px;
  margin: 0 20px; /* Add margin to the left and right of the VS to space out team 1 and team 2 */
}

/* Styling for the left side of the form (Team 1 and Score 1) */
.team-left, .score-left {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.score-inputs {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

/* Styling for the right side of the form (Team 2 and Score 2) */
.team-right, .score-right {
  flex: 1;
  display: flex;
  flex-direction: column;
  margin-right: auto; /* Align to the right */
}

.score-inputs input {
  width: 80px;
  padding: 5px;
  margin-bottom: 10px;
}

.upload-section {
  margin-bottom: 20px;
}

.submit-section {
  text-align: center;
}

.rslt-btn {
  padding: 10px 20px;
  font-size: 16px;
  background-color: rgb(245, 42, 15);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.rslt-btn:hover {
  background-color: rgb(245, 42, 15);
}

.rslt-btn:active {
  background-color: #3e8e41;
}

.upload-section input {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
}

</style>
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

    <!-- Mobile Legends Table -->
    <div id="mobileLegendsTable" class="schedule-table">
      <h3>Mobile Legends Schedule</h3>
      <table style="border-collapse: collapse; width: 100%;">
        <thead>
          <tr>
            <th style="border: none; padding: 8px;">Date</th>
            <th style="border: none; padding: 8px;">Match</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($matches_by_division['ml']) && !empty($matches_by_division['ml'])): ?>
            <?php foreach ($matches_by_division['ml'] as $match): ?>
              <tr>
                <td style="border: none; padding: 8px;"><?php echo date('Y-m-d', strtotime($match['match_day'])); ?></td>
                <td style="border: none; padding: 8px;"><?php echo $match['match_title']; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" style="border: none; padding: 8px;">No matches scheduled.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- FIFA Table -->
    <div id="fifaTable" class="schedule-table" style="display:none;">
      <h3>FIFA Schedule</h3>
      <table style="border-collapse: collapse; width: 100%;">
        <thead>
          <tr>
            <th style="border: none; padding: 8px;">Date</th>
            <th style="border: none; padding: 8px;">Match</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($matches_by_division['fifa']) && !empty($matches_by_division['fifa'])): ?>
            <?php foreach ($matches_by_division['fifa'] as $match): ?>
              <tr>
                <td style="border: none; padding: 8px;"><?php echo date('Y-m-d', strtotime($match['match_day'])); ?></td>
                <td style="border: none; padding: 8px;"><?php echo $match['match_title']; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" style="border: none; padding: 8px;">No matches scheduled.</td>
            </tr>
          <?php endif; ?>
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
  <div class="container smaller-container">
    <div class="section-header">
      <h2>Upload Result</h2>
      <p>Fill this form to upload the match result.</p>
    </div>

    <div class="schedule-toggle-stripe">
      <span id="mlresultbtn" class="toggle-stripe active">Mobile Legends</span>
      <span id="fifaresultbtn" class="toggle-stripe">FIFA</span>
    </div>

    <!-- Form to upload result -->
    <form action="dashboard/submit_score" method="post" enctype="multipart/form-data" class="upload-result-form">
  
    <!-- Match Selection -->
    <div class="form-row match-selection">
        <div>
            <label for="match_title">Match:</label>
            <select name="match_title" id="match_title" required onchange="populateTeams()">
                <option value="">Select Match</option>
                <!-- Loop through matches and populate the dropdown -->
                <?php if (!empty($matches_by_division)) { ?>
                    <?php foreach ($matches_by_division as $division => $matches) { ?>
                        <optgroup label="<?php echo htmlspecialchars(ucfirst($division)); ?>">
                            <?php foreach ($matches as $match) { 
                                // Generate unique match ID for each match
                                $match_id = $match['team_a_id'] . '-' . $match['team_b_id'];
                            ?>
                            <option value="<?php echo $match_id; ?>" 
                                    data-team-a-id="<?php echo $match['team_a_id']; ?>" 
                                    data-team-b-id="<?php echo $match['team_b_id']; ?>" 
                                    data-team-a-name="<?php echo htmlspecialchars($match['team_a_name']); ?>" 
                                    data-team-b-name="<?php echo htmlspecialchars($match['team_b_name']); ?>">
                                <?php echo htmlspecialchars($match['match_title']); ?>
                            </option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
                <?php } else { ?>
                    <option value="">No matches available</option>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- Team Selection Box (Populated dynamically) -->
    <div class="form-row team-selection" id="team-selection">
        <!-- Teams will be displayed here based on the selected match -->
    </div>

    <!-- Score Input Box -->
    <div class="form-row score-inputs">
        <div class="score-left">
            <label for="team_1_score">Score Team 1:</label>
            <input type="number" name="team_1_score" id="team_1_score" required>
        </div>

        <div class="score-right">
            <label for="team_2_score">Score Team 2:</label>
            <input type="number" name="team_2_score" id="team_2_score" required>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-row">
        <button type="submit">Submit Scores</button>
    </div>

</form>

  </div>
</section>



<script>
   document.addEventListener("DOMContentLoaded", function () {
    const mlResultBtn = document.getElementById("mlresultbtn");
    const fifaResultBtn = document.getElementById("fifaresultbtn");
    const matchSelect = document.getElementById("match_title");
    const teamSelection = document.getElementById("team-selection");

    // Store matches grouped by division (Mobile Legends and FIFA)
    const matchesByDivision = <?php echo json_encode($matches_by_division); ?>;

    // Function to update the match dropdown based on selected division
    function updateMatchDropdown(division) {
        matchSelect.innerHTML = '<option value="">Select Match</option>'; // Clear the current options

        if (matchesByDivision[division]) {
            // Populate the dropdown with matches from the selected division
            matchesByDivision[division].forEach(function (match) {
                const matchId = match['team_a_id'] + '-' + match['team_b_id'];
                const option = document.createElement('option');
                option.value = matchId;
                option.textContent = match['match_title'];
                matchSelect.appendChild(option);
            });
        } else {
            const noMatchesOption = document.createElement('option');
            noMatchesOption.value = '';
            noMatchesOption.textContent = `No ${division} matches available`;
            matchSelect.appendChild(noMatchesOption);
        }
    }

    // Function to populate teams based on the selected match
    function populateTeams(matchId) {
        teamSelection.innerHTML = ''; // Clear previous team details

        if (matchId) {
            // Find the selected match based on matchId
            const [teamAId, teamBId] = matchId.split('-');
            const selectedMatch = matchesByDivision['ml'].concat(matchesByDivision['fifa']).find(function (match) {
                return (match['team_a_id'] === teamAId && match['team_b_id'] === teamBId) || 
                       (match['team_a_id'] === teamBId && match['team_b_id'] === teamAId);
            });

            if (selectedMatch) {
                const teamLeft = document.createElement('div');
                teamLeft.classList.add('team-left');
                teamLeft.textContent = selectedMatch['team_a_name'];  // Team A

                const vsSpan = document.createElement('span');
                vsSpan.classList.add('vs');
                vsSpan.textContent = 'VS';

                const teamRight = document.createElement('div');
                teamRight.classList.add('team-right');
                teamRight.textContent = selectedMatch['team_b_name'];  // Team B

                teamSelection.appendChild(teamLeft);
                teamSelection.appendChild(vsSpan);
                teamSelection.appendChild(teamRight);
            }
        }
    }

    // Event listener for Mobile Legends result button
    mlResultBtn.addEventListener('click', function () {
        mlResultBtn.classList.add('active');
        fifaResultBtn.classList.remove('active');
        updateMatchDropdown('ml'); // Show matches for Mobile Legends
    });

    // Event listener for FIFA result button
    fifaResultBtn.addEventListener('click', function () {
        fifaResultBtn.classList.add('active');
        mlResultBtn.classList.remove('active');
        updateMatchDropdown('fifa'); // Show matches for FIFA
    });

    // Event listener for match selection
    matchSelect.addEventListener('change', function () {
        const matchId = matchSelect.value;
        populateTeams(matchId);  // Populate teams based on the selected match
    });

    // Initial setup: Show Mobile Legends matches by default
    mlResultBtn.click();
});

</script>


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