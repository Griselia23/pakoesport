<?php include(APPPATH . 'views/layout/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />

<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <a href="dashboard" class="scrollto"><img src="<?php echo base_url('application/template/img/logo.png'); ?>" alt="" title=""></a>
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li><a href="<?php echo base_url('admin'); ?>">Matches Monitor</a></li>
                <li><a href="<?php echo base_url('setuser'); ?>">Setting User</a></li>
                <li><a href="<?php echo base_url('uploadresult'); ?>">Upload Result</a></li>
                <li><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>

                <li class="buy-tickets">
                    <a href="#" onclick="confirmLogout(event)">Logout</a>
                </li>




            </ul>
        </nav>
    </div>
</header>

<style>
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
</style>

<main id="main">


    <section id="main-content" style="background-color: white; padding: 20px; margin-top: 50px;">
        <div class="container">
            <!-- Schedule Section (Setting Period) -->
            <div class="container" style="background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <div class="section-header">
                    <h2 style="color: black;">Setting Period</h2>
                    <p style="color: black;">Hai <?php echo $this->session->userdata('username'); ?>, Here you can set the schedules</p>
                </div>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <a href="#addScheduleModal" class="btn btn-primary mt-4">Add Schedule</a>
                <a id="hideregister" class="btn btn-primary mt-4" style="color: white;">Hide Registration Form</a>
                <form action="<?= site_url('admin/clearSchedule') ?>" method="post" id="clearScheduleForm">
                    <a type="button" class="btn btn-primary mt-4" style="color: white;" onclick="confirmClearSchedule()">
                        Clear Schedule
                    </a>
                </form>



                <div>
                    <br>
                </div>

                <table class="table table-bordered table-striped mt-4" id="mlscheduleTable">
                    <thead>
                        <tr style="background-color: #f4f4f4;">
                            <th scope="col" style="color: black;">Start Date</th>
                            <th scope="col" style="color: black;">Match Title</th>
                            <th scope="col" style="color: black;">Division</th>
                            <th scope="col" style="color: black;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($schedules)): ?>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr data-division="<?php echo $schedule->division; ?>">
                                    <!-- Ensure 4 td elements corresponding to the 4 th headers -->
                                    <td><?php echo $schedule->start_date; ?></td>
                                    <td><?php echo $schedule->match_title; ?></td> <!-- Display Match Title -->
                                    <td><?php echo ($schedule->division == 'ml') ? 'Mobile Legends' : 'FIFA'; ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#editschedule<?php echo $schedule->id; ?>">Edit</button>

                                        <form method="POST" action="<?php echo site_url('admin/delete_schedule/' . $schedule->id); ?>" style="display:inline;">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editschedule<?php echo $schedule->id; ?>" tabindex="-1" aria-labelledby="editscheduleLabel<?php echo $schedule->id; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editscheduleLabel<?php echo $schedule->id; ?>">Edit Match Schedule</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo base_url('admin/update_schedule/' . $schedule->id); ?>">

                                                    <div class="mb-3">
                                                        <label for="division" class="form-label">Division</label>
                                                        <select class="form-control" id="division" name="division" required>
                                                            <option value="ml" <?php echo ($schedule->division == 'ml' ? 'selected' : ''); ?>>Mobile Legends</option>
                                                            <option value="fifa" <?php echo ($schedule->division == 'fifa' ? 'selected' : ''); ?>>FIFA</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="startDate" class="form-label">Start Date</label>
                                                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo $schedule->start_date; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="endDate" class="form-label">End Date</label>
                                                        <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo $schedule->end_date; ?>" required>
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
                                <td colspan="4">No schedules available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>


            </div>

            <div id="addScheduleModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Match Schedule</h5>
                        <a href="#" class="close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php elseif ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" id="scheduleform" action="<?php echo base_url('admin/save_schedule'); ?>">
                            <div class="mb-3">
                                <label for="division" class="form-label">Division</label>
                                <select class="form-control" id="division" name="division" required>
                                    <option value="ml">Mobile Legends</option>
                                    <option value="fifa">FIFA</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>

                            <div class="mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#mlscheduleTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "order": [
                        [0, 'asc']
                    ],
                    "lengthMenu": [5, 20, 30, 40],
                    "columnDefs": [{
                        "targets": 3,
                        "orderable": false
                    }]
                });
            });
        </script>

        <!-- Registered Teams Section -->
        <div class="container mt-5">
            <div class="container" style="background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <div class="section-header">
                    <h2 style="color: black;">Registered Teams</h2>
                    <p style="color: black;">Hai <?php echo $this->session->userdata('username'); ?>, Here are the details of the registered teams:</p>
                </div>

                <!-- <div class="period-toggle-stripe mt-4">
                    <span id="mobileLegendsPeriodBtn" class="period-btn active">Mobile Legends</span>
                    <span id="fifaPeriodBtn" class="period-btn">FIFA</span>
                </div> -->

                <!-- Teams Table -->
                <div id="teamsLeaderboard" class="mt-4">
                    <h3>Teams Table</h3>
                    <table id="teamsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="color: black;">Team</th>
                                <th scope="col" style="color: black;">Plant</th>
                                <th scope="col" style="color: black;">Leader Name</th>
                                <th scope="col" style="color: black;">Division</th>
                                <th scope="col" style="color: black;">Action</th>
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

                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editregister<?php echo $team->id; ?>">Edit</button>

                                            <!-- Delete Button -->
                                            <form method="POST" action="<?php echo site_url('admin/delete_team/' . $team->id); ?>" style="display:inline;">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this team?');">Del</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal for this team -->
                                    <div class="modal fade" id="editregister<?php echo $team->id; ?>" tabindex="-1" aria-labelledby="editregisterLabel<?php echo $team->id; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editregisterLabel<?php echo $team->id; ?>">Edit Team</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#teamsTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "order": [
                        [0, 'asc']
                    ],
                    "lengthMenu": [5, 20, 30, 50],
                    "columnDefs": [{
                        "targets": 4,
                        "orderable": false
                    }]
                });
            });
        </script>

        <!-- results -->
        <div class="container mt-5">
            <div class="container" style="background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <div class="section-header">
                    <h2 style="color: black;">Match Monitor</h2>
                    <p style="color: black;">Hai <?php echo $this->session->userdata('username'); ?>, Make sure everything is under control</p>
                </div>
                <!-- Teams Table -->
                <div id="resultteams" class="mt-4">
                    <table id="resulttable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="color: black;">Date</th>
                                <!-- <th scope="col" style="color: black;">Team 1</th>
                        <th scope="col" style="color: black;">Team 2</th> -->
                                <th scope="col" style="color: black;">Titles </th>
                                <th scope="col" style="color: black;">Pts Team 1</th>
                                <th scope="col" style="color: black;">Pts Team 2</th>
                                <th scope="col" style="color: black;">division </th>
                                <th scope="col" style="color: black;">Evidences</th>
                                <th scope="col" style="color: black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($results)): ?>
                                <?php foreach ($results as $result): ?>
                                    <tr class="results" data-division="<?php echo $result->division; ?>" id="results-<?php echo $result->id; ?>">
                                        <td><?php echo $result->match_date; ?></td>
                                        <td><?php echo $result->match_title; ?></td>
                                        <td><?php echo $result->points_a; ?></td>
                                        <td><?php echo $result->points_b; ?></td>
                                        <td><?php echo $result->division; ?></td>
                                        <td>
                                            <?php
                                            $image_paths = explode(',', $result->evidence_image);
                                            foreach ($image_paths as $index => $image) {
                                                echo '<a href="' . base_url($image) . '" target="_blank">View Evidence  ' . ($index + 1) . '</a><br>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editresult<?php echo $result->id; ?>">Edit</button>

                                            <!-- Delete Button -->
                                            <form method="POST" action="<?php echo site_url('admin/delete_results/' . $result->id); ?>" style="display:inline;">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this team?');">Del</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal for this result -->
                                    <div class="modal fade" id="editresult<?php echo $result->id; ?>" tabindex="-1" aria-labelledby="editresultLabel<?php echo $result->id; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editresultLabel<?php echo $result->id; ?>">Edit Result</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo site_url('admin/update_results/' . $result->id); ?>">
                                                        <input type="hidden" name="id" value="<?php echo $result->id; ?>" />

                                                        <div class="mb-3">
                                                            <label for="teampoints1" class="form-label">Points 1</label>
                                                            <input type="number" class="form-control" id="teampoints1" name="teampoints1" value="<?php echo $result->points_a; ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="teampoints2" class="form-label">Points 2</label>
                                                            <input type="number" class="form-control" id="teampoints2" name="teampoints2" value="<?php echo $result->points_b; ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="division" class="form-label">Division</label>
                                                            <input type="text" class="form-control" id="division" name="division" value="<?php echo $result->division; ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="matchdate" class="form-label">Date</label>
                                                            <input type="date" class="form-control" id="matchdate" name="matchdate" value="<?php echo $result->match_date; ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $result->match_title; ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="evidence" class="form-label">Evidence</label>
                                                            <input type="text" class="form-control" id="evidence" name="evidence" value="<?php echo $result->evidence_image; ?>" />
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
                                    <td colspan="8">No match results available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


        <?php include(APPPATH . 'views/layout/footer.php'); ?>
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#resulttable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "order": [
                        [0, 'asc']
                    ],
                    "lengthMenu": [10, 20, 30, 40],
                    "columnDefs": [{
                        "targets": 4,
                        "orderable": false
                    }]
                });
            });
        </script>
    </section>


</main>

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>



<script>
    $(document).ready(function() {

        if ($('#mlschedulebtn').hasClass('active')) {
            $('#mlscheduleTable tbody tr').each(function() {
                if ($(this).data('division') === 'ml') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        } else if ($('#fifaschedulebtn').hasClass('active')) {
            $('#mlscheduleTable tbody tr').each(function() {
                if ($(this).data('division') === 'fifa') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // For Mobile Legends Schedule Table
        $('#mlschedulebtn').click(function() {
            $(this).addClass('active');
            $('#fifaschedulebtn').removeClass('active');

            $('#mlscheduleTable tbody tr').each(function() {
                if ($(this).data('division') === 'ml') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // For FIFA Schedule Table
        $('#fifaschedulebtn').click(function() {
            $(this).addClass('active');
            $('#mlschedulebtn').removeClass('active');

            $('#mlscheduleTable tbody tr').each(function() {
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
<script>
    $(document).ready(function() {
        // On page load, check which button is active and display the relevant rows
        if ($('#mlResultBtn').hasClass('active')) {
            $('#resultTable tbody tr').each(function() {
                if ($(this).data('division') === 'ml') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        } else if ($('#fifaResultBtn').hasClass('active')) {
            $('#resultTable tbody tr').each(function() {
                if ($(this).data('division') === 'fifa') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // For Mobile Legends Results
        $('#mlResultBtn').click(function() {
            $(this).addClass('active');
            $('#fifaResultBtn').removeClass('active');

            $('#resultTable tbody tr').each(function() {
                if ($(this).data('division') === 'ml') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // For FIFA Results
        $('#fifaResultBtn').click(function() {
            $(this).addClass('active');
            $('#mlResultBtn').removeClass('active');

            $('#resultTable tbody tr').each(function() {
                if ($(this).data('division') === 'fifa') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<script>
    window.onload = function() {
        var button = document.getElementById('hideregister');
        var currentState = sessionStorage.getItem('hideRegistrationForm');

        if (currentState === 'true') {
            button.textContent = 'Unhide Registration Form';
        } else {
            button.textContent = 'Hide Registration Form';
        }
    };

    document.getElementById('hideregister').addEventListener('click', function() {
        var currentState = sessionStorage.getItem('hideRegistrationForm');

        if (currentState === 'true') {
            sessionStorage.setItem('hideRegistrationForm', 'false');
            Swal.fire({
                icon: 'success',
                title: 'Registration Form is Shown',
                confirmButtonText: 'OK',
                timer: 4000,
                timerProgressBar: true,
            }).then(() => {
                window.location.reload();
            });
        } else {
            sessionStorage.setItem('hideRegistrationForm', 'true');
            Swal.fire({
                icon: 'success',
                title: 'Registration Form is Hidden',
                confirmButtonText: 'OK',
                timer: 4000,
                timerProgressBar: true,
            }).then(() => {
                window.location.reload();
            });
        }
    });
</script>

<script type="text/javascript">
    function confirmClearSchedule() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action will permanently clear the schedule. You cannot undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, clear it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('clearScheduleForm').submit();


                Swal.fire({
                    title: 'Success!',
                    text: 'The schedule has been cleared.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function confirmLogout(event) {
        event.preventDefault();  

        if (confirm("Are you sure you want to log out?")) {
            
            window.location.href = "<?php echo base_url('login/logout'); ?>";
        }
    }
</script>





</html>