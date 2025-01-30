<?php include(APPPATH . 'views/layout/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li><a href="<?php echo base_url('uploadresult'); ?>">Upload Result</a></li>
                <li><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                
                <li class="buy-tickets">
                    <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
                </li>

            </ul>
        </nav>
    </div>
</header>

<style>
 /* General Form Styles */
.upload-result-form {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  
  /* Adding drop shadow */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.upload-result-form .form-row {
  margin-bottom: 20px;
}

.upload-result-form label {
  font-weight: bold;
  display: block;
  margin-bottom: 8px;
}

.upload-result-form select,
.upload-result-form input {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.upload-result-form button {
  background-color: rgb(226, 14, 14);
  color: #fff;
  padding: 12px 24px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.upload-result-form button:hover {
  background-color: rgb(226, 14, 14);
}

/* Match Selection */
.form-row.match-selection {
  display: flex;
  flex-direction: column;
}

.schedule-toggle-stripe {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.schedule-toggle-stripe .toggle-stripe {
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
  margin-right: 10px;
}

.schedule-toggle-stripe .toggle-stripe.active {
  background-color:rgb(226, 14, 14);
  color: #fff;
}

/* Team Selection */
.form-row.team-selection {
  display: flex;
  flex-direction: column;
}

/* Score Input Box */
.form-row.score-inputs {
  display: flex;
  justify-content: space-between;
  gap: 20px;
}

.score-left, .score-right {
  width: 48%;
}

.score-left input, .score-right input {
  width: 100%;
}

/* Image Upload */
.form-row.image-upload {
  display: flex;
  flex-direction: column;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
  /* Stack score inputs vertically on smaller screens */
  .form-row.score-inputs {
    flex-direction: column;
  }

  .score-left, .score-right {
    width: 100%;
  }

  .form-row.team-selection {
    margin-top: 20px;
  }

  .upload-result-form {
    padding: 10px;
  }

  .schedule-toggle-stripe {
    flex-direction: column;
    align-items: center;
  }

  .schedule-toggle-stripe .toggle-stripe {
    margin-bottom: 10px;
  }
}

@media (max-width: 480px) {
  /* Adjusting button and form spacing for very small screens */
  .upload-result-form button {
    width: 100%;
    font-size: 14px;
    padding: 10px;
  }
}


</style>
<main id="main">

<section id="teams" class="section-with-bg wow fadeInUp">
  <div class="container smaller-container">
    <div class="section-header">
      <h2>Upload Result</h2>
      <p style="color: black;">Hai <?php echo $this->session->userdata('leadername'); ?>, Tolong isi hasil dengan jujur</p>
    </div>

    <div class="schedule-toggle-stripe">
      <span id="mlresultbtn" class="toggle-stripe active">Mobile Legends</span>
      <span id="fifaresultbtn" class="toggle-stripe">FIFA</span>
    </div>

    <form action="dashboard/submit_score" method="post" enctype="multipart/form-data" class="upload-result-form" id="submitscore">
  <div class="form-row match-selection">
    <div>
        <label for="match_title">Match:</label>
        <select name="match_title" id="match_title" required onchange="populateTeams()">
          <option value="">Select Match</option>
          <?php if (!empty($matches_by_division)) { ?>
            <?php foreach ($matches_by_division as $division => $matches) { ?>
              <optgroup label="<?php echo htmlspecialchars(ucfirst($division)); ?>">
                <?php foreach ($matches as $match) { 
                  $match_id = $match['team_a_id'] . '-' . $match['team_b_id'];
                  $match_date = $match['start_date']; 
                ?>
                  <option value="<?php echo $match_id; ?>" 
                          data-team-a-id="<?php echo $match['team_a_id']; ?>" 
                          data-team-b-id="<?php echo $match['team_b_id']; ?>" 
                          data-division="<?php echo $match['categ']; ?>"
                          data-team-a-name="<?php echo htmlspecialchars($match['team_a_name']); ?>" 
                          data-team-b-name="<?php echo htmlspecialchars($match['team_b_name']); ?>"
                          data-match-date="<?php echo $match_date; ?>">
                    <?php echo htmlspecialchars($match['match_title']); ?> (<?php echo htmlspecialchars($match_date); ?>)
                  </option>
                <?php } ?>
              </optgroup>
            <?php } ?>
          <?php } else { ?>
            <option value="">No matches available for today</option>
          <?php } ?>
        </select>
    </div>
  </div>

  <div class="form-row team-selection" id="team-selection"></div>

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

  <div class="form-row image-upload">
    <label for="evidence_image">Upload Evidence (Images):</label>
    <input type="file" name="evidence_image[]" id="evidence_image" accept="image/*" required multiple>
    <small>Max 3 images, each up to 2MB</small>
</div>


  <input type="hidden" id="division" name="division" value="">

  <div class="form-row">
    <button type="button" onclick="confirmSubmit_score()">Submit Scores</button>
  </div>
</form>
<script>
  function confirmSubmit_score() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Jangan curang!", 
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('submitscore').submit();
        }
    });
  }

  <?php if ($this->session->flashdata('success')): ?>
    Swal.fire({
      title: 'Success!',
      text: '<?php echo $this->session->flashdata('success'); ?>',
      icon: 'success',
      confirmButtonText: 'Ok'
    });
  <?php elseif ($this->session->flashdata('error')): ?>
    Swal.fire({
      title: 'Error!',
      text: '<?php echo $this->session->flashdata('error'); ?>',
      icon: 'error',
      confirmButtonText: 'Ok'
    });
  <?php endif; ?>
</script>
  </div>
</section>

<?php include(APPPATH . 'views/layout/footer.php'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const mlResultBtn = document.getElementById("mlresultbtn");
    const fifaResultBtn = document.getElementById("fifaresultbtn");
    const matchSelect = document.getElementById("match_title");
    const teamSelection = document.getElementById("team-selection");

    const matchesByDivision = <?php echo json_encode($matches_by_division); ?>;

    function updateMatchDropdown(division) {
        matchSelect.innerHTML = '<option value="">Select Match</option>';

        if (matchesByDivision[division]) {
            matchesByDivision[division].forEach(function (match) {
                const matchId = match['team_a_id'] + '-' + match['team_b_id'];
                const option = document.createElement('option');
                option.value = matchId;
                option.textContent = match['match_title'];
                option.setAttribute('data-team-a-id', match['team_a_id']);
                option.setAttribute('data-team-b-id', match['team_b_id']);
                option.setAttribute('data-division', match['categ']);
                option.setAttribute('data-team-a-name', match['team_a_name']);
                option.setAttribute('data-team-b-name', match['team_b_name']);
                matchSelect.appendChild(option);
            });
        } else {
            const noMatchesOption = document.createElement('option');
            noMatchesOption.value = '';
            noMatchesOption.textContent = `No ${division} matches available`;
            matchSelect.appendChild(noMatchesOption);
        }
    }

    function populateTeams(matchId) {
        teamSelection.innerHTML = '';

        if (matchId) {
            const [teamAId, teamBId] = matchId.split('-');
            const selectedMatch = matchesByDivision['ml'].concat(matchesByDivision['fifa']).find(function (match) {
                return (match['team_a_id'] === teamAId && match['team_b_id'] === teamBId) || 
                       (match['team_a_id'] === teamBId && match['team_b_id'] === teamAId);
            });

            if (selectedMatch) {
                const teamLeft = document.createElement('div');
                teamLeft.classList.add('team-left');
                teamLeft.textContent = selectedMatch['team_a_name'];

                const vsSpan = document.createElement('span');
                vsSpan.classList.add('vs');
                vsSpan.textContent = 'VS';

                const teamRight = document.createElement('div');
                teamRight.classList.add('team-right');
                teamRight.textContent = selectedMatch['team_b_name'];

                teamSelection.appendChild(teamLeft);
                teamSelection.appendChild(vsSpan);
                teamSelection.appendChild(teamRight);
            }
        }
    }

    mlResultBtn.addEventListener('click', function () {
        mlResultBtn.classList.add('active');
        fifaResultBtn.classList.remove('active');
        updateMatchDropdown('ml');
    });

    fifaResultBtn.addEventListener('click', function () {
        fifaResultBtn.classList.add('active');
        mlResultBtn.classList.remove('active');
        updateMatchDropdown('fifa');
    });

    matchSelect.addEventListener('change', function () {
        const matchId = matchSelect.value;
        populateTeams(matchId);
    });

    mlResultBtn.click();
});

function populateDivision() {
    const matchSelect = document.getElementById('match_title');
    const selectedOption = matchSelect.options[matchSelect.selectedIndex];
    const division = selectedOption.getAttribute('data-division');
    document.getElementById('division').value = division;
}

document.getElementById('match_title').addEventListener('change', populateDivision);
</script>


</main>

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
