<?php include(APPPATH . 'views/layout/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
    </div>
    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li><a href="<?php echo base_url('admin'); ?>">Setting Period</a></li>
        <li><a href="<?php echo base_url('setuser'); ?>">Setting User</a></li>
        
        <li class="buy-tickets">
    <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
</li>

      </ul>
    </nav>
  </div>
</header>

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal:target {
        display: flex;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 500px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 18px;
    }

    .close {
        font-size: 30px;
        text-decoration: none;
        color: black;
    }

    .close:hover {
        color: red;
    }

    .modal-body {
        padding-bottom: 20px;
    }

    /* Optional: Add some padding and spacing for the button */
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<main id="main">


<section id="main-content" style="background-color: white; padding: 20px; margin-top: 50px;">
<div class="container">
<div class="container" style="background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
    <div class="section-header">
        <h2 style="color: black;">Setting Period</h2>
        <p style="color: black;">Hai <?php echo $this->session->userdata('username'); ?>, Here you can set the schedules</p>
    </div>

    <!-- Button to trigger modal for adding schedule -->
    <a href="#addScheduleModal" class="btn btn-primary mt-4">Add Schedule</a>
</div>

<!-- Add Schedule Modal -->
<div id="addScheduleModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Match Schedule</h5>
            <a href="#" class="close">&times;</a>
        </div>
        <div class="modal-body">
            <!-- Schedule form -->
            <form method="POST" action="<?php echo base_url('admin/save_schedule'); ?>">
        <!-- Match Number -->
        <div class="mb-3">
            <label for="matchNumber" class="form-label">Match Number</label>
            <input type="text" class="form-control" id="matchNumber" name="matchNumber" required placeholder="Enter match number (e.g., 1)">
        </div>

        <!-- Division (ML or FIFA) -->
        <div class="mb-3">
            <label for="division" class="form-label">Division</label>
            <select class="form-control" id="division" name="division" required>
                <option value="ml">Mobile Legends</option>
                <option value="fifa">FIFA</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="startDate" required>
        </div>

        <!-- Start Time -->
        <div class="mb-3">
            <label for="startTime" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="startTime" name="startTime" required>
        </div>

        <!-- End Date -->
        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" required>
        </div>

        <!-- End Time -->
        <div class="mb-3">
            <label for="endTime" class="form-label">End Time</label>
            <input type="time" class="form-control" id="endTime" name="endTime" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

        </div>
    </div>
</div>


 <br>
<div class="container"></div>

  <div class="container" style="background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
    <div class="section-header">
        <h2 style="color: black;">Registered Teams</h2>
        <p style="color: black;">Hai <?php echo $this->session->userdata('username'); ?>, Here are the details of the registered teams:</p>
    </div>

    <div class="period-toggle-stripe">
        <span id="mobileLegendsPeriodBtn" class="period-btn active">Mobile Legends</span>
        <span id="fifaPeriodBtn" class="period-btn">FIFA</span>
    </div>

    <table class="table table-bordered table-striped" id="teamsTable">
    <thead>
        <tr style="background-color: #f4f4f4;">
            <th>Team</th>
            <th>Plant</th>
            <th>Leader Name</th>
            <th>Division</th>
            <th>Points</th> <!-- Added Points Column -->
            <th>Action</th> <!-- New Action column -->
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($teams)): ?>
            <?php foreach ($teams as $team): ?>
                <tr class="team" data-division="<?php echo $team->division; ?>" id="team-<?php echo $team->id; ?>">
                    <td><?php echo $team->team; ?></td>
                    <td><?php echo $team->plant; ?></td>
                    <td><?php echo $team->leadername; ?></td>
                    <td><?php echo $team->division; ?></td>
                    <td><?php echo $team->points; ?></td> <!-- Display Points -->
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $team->id; ?>">Edit</button>
                        
                        <!-- Delete Button -->
                        <form method="POST" action="<?php echo site_url('admin/delete_team/' . $team->id); ?>" style="display:inline;">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this team?');">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal for this team -->
                <div class="modal fade" id="editModal<?php echo $team->id; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $team->id; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?php echo $team->id; ?>">Edit Team</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form to edit team details -->
                                <form method="POST" action="<?php echo site_url('admin/update_team'); ?>">
                                    <input type="hidden" name="team_id" value="<?php echo $team->id; ?>" />
                                    <div class="mb-3">
                                        <label for="teamName" class="form-label">Team</label>
                                        <input type="text" class="form-control" id="teamName" name="teamName" value="<?php echo $team->team; ?>" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="plant" class="form-label">Plant</label>
                                        <input type="text" class="form-control" id="plant" name="plant" value="<?php echo $team->plant; ?>" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="leaderName" class="form-label">Leader Name</label>
                                        <input type="text" class="form-control" id="leaderName" name="leaderName" value="<?php echo $team->leadername; ?>" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text" class="form-control" id="division" name="division" value="<?php echo $team->division; ?>" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="points" class="form-label">Points</label>
                                        <input type="number" class="form-control" id="points" name="points" value="<?php echo $team->points; ?>" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No teams registered</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

  </div>
</section>







</main>

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<script src="<?php echo base_url('application/template/lib/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/jquery/jquery-migrate.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/easing/easing.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/superfish/hoverIntent.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/superfish/superfish.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/wow/wow.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/venobox/venobox.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('application/template/contactform/contactform.js'); ?>"></script>
<script src="<?php echo base_url('application/template/js/main.js'); ?>"></script>

<script>
  $(document).ready(function() {
    $('.team').each(function() {
        if ($(this).data('division') !== 'ml') {
            $(this).hide();
        }
    });

    $('#mobileLegendsPeriodBtn').click(function() {
        $(this).addClass('active');
        $('#fifaPeriodBtn').removeClass('active');
        $('#teamsTable .team').each(function() {
            if ($(this).data('division') === 'ml') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#fifaPeriodBtn').click(function() {
        $(this).addClass('active');
        $('#mobileLegendsPeriodBtn').removeClass('active');
        $('#teamsTable .team').each(function() {
            if ($(this).data('division') === 'fifa') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>

</body>
</html>
