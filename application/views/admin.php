<?php include(APPPATH . 'views/layout/header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
        <a href="#intro" class="scrollto"><img src="<?php echo base_url('application/template/img/logo.png'); ?>" alt="" title=""></a>
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li><a href="<?php echo base_url('admin'); ?>">Matches Monitor</a></li>
                <li><a href="<?php echo base_url('setuser'); ?>">Setting User</a></li>
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

    <!-- Add Schedule Button -->
    <a href="#addScheduleModal" class="btn btn-primary mt-4">Add Schedule</a>

    <!-- Period Toggle Buttons -->
    <div class="period-toggle-stripe mt-4">
        <span id="mlschedulebtn" class="period-btn active">Mobile Legends</span>
        <span id="fifaschedulebtn" class="period-btn">FIFA</span>
    </div>

    <!-- Schedules Table -->
    <table class="table table-bordered table-striped mt-4" id="mlscheduleTable">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th scope="col" style="color: black;">Match Number</th>
                <th scope="col" style="color: black;">Date</th>
                <th scope="col" style="color: black;">Teams</th>
                <th scope="col" style="color: black;">Division</th>
                <th scope="col" style="color: black;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($schedules)): ?>
                <?php foreach ($schedules as $schedule): ?>
                    <tr data-division="<?php echo $schedule->division; ?>">
                        <td><?php echo $schedule->match_number; ?></td>
                        <td><?php echo $schedule->start_date; ?></td>
                        <td>
                            <?php foreach ($match_titles as $match_title) {
                                if ($match_title['categ'] == $schedule->division) {
                                    echo $match_title['match_title'] . '<br>';
                                }
                            } ?>
                        </td>
                        <td><?php echo ($schedule->division == 'ml') ? 'Mobile Legends' : 'FIFA'; ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editschedule<?php echo $schedule->id; ?>">Edit</button>

                            <!-- Delete Button -->
                            <form method="POST" action="<?php echo site_url('admin/delete_schedule/' . $schedule->id); ?>" style="display:inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
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
                                            <label for="matchNumber" class="form-label">Match Number</label>
                                            <input type="text" class="form-control" id="matchNumber" name="matchNumber" value="<?php echo $schedule->match_number; ?>" required>
                                        </div>

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
                                            <label for="teams" class="form-label">Teams</label>
                                            <p><?php echo !empty($schedule->team_1_name) && !empty($schedule->team_2_name) ? $schedule->team_1_name . ' vs ' . $schedule->team_2_name : 'TBD'; ?></p>
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
                    <td colspan="5">No schedules available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

        <!-- Add Schedule Modal -->
        <div id="addScheduleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Match Schedule</h5>
                    <a href="#" class="close">&times;</a>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('admin/save_schedule'); ?>">
                        <div class="mb-3">
                            <label for="matchNumber" class="form-label">Match Number</label>
                            <input type="text" class="form-control" id="matchNumber" name="matchNumber" required placeholder="Enter match number (e.g., 1)">
                        </div>

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

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#mlscheduleTable').DataTable({
            "paging": true, 
            "searching": true, 
            "ordering": true, 
            "order": [[0, 'asc']], 
            "lengthMenu": [10, 20, 30, 40], 
            "columnDefs": [
                {
                    "targets": 4, 
                    "orderable": false
                }
            ]
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

        <!-- Period Toggle Buttons -->
        <div class="period-toggle-stripe mt-4">
            <span id="mobileLegendsPeriodBtn" class="period-btn active">Mobile Legends</span>
            <span id="fifaPeriodBtn" class="period-btn">FIFA</span>
        </div>

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
            "order": [[0, 'asc']], 
            "lengthMenu": [10, 20, 30, 50], 
            "columnDefs": [
                {
                    "targets": 4, 
                    "orderable": false
                }
            ]
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

        <!-- Period Toggle Buttons -->
        <!-- <div class="period-toggle-stripe mt-4">
            <span id="mlresultbtn" class="period-btn active">Mobile Legends</span>
            <span id="fifaresultbtn" class="period-btn">FIFA</span>
        </div> -->

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
                <td><a href="<?php echo $result->evidence_image; ?>" target="_blank">View Image</a></td>
                
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editresult<?php echo $result->id; ?>">Edit</button>

                    <!-- Delete Button -->
                    <form method="POST" action="<?php echo site_url('admin/delete_results/' . $result->id); ?>" style="display:inline;">
                    <button type="submit" class="btn btn-danger">Del</button>
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
                            <form method="POST" action="<?php echo site_url('admin/update_results/'.$result->id); ?>">
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
    <!-- <script>
    $(document).ready(function() {
        $('.team').each(function() {
            if ($(this).data('division') !== 'ml') {
                $(this).hide();
            }
        });

        $('#mlresultbtn').click(function() {
            $(this).addClass('active');
            $('#fifaresultbtn').removeClass('active');
            $('#resulttable .team').each(function() {
                if ($(this).data('division') === 'ml') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#fifaresultbtn').click(function() {
            $(this).addClass('active');
            $('#mlresultbtn').removeClass('active');
            $('#resulttable .team').each(function() {
                if ($(this).data('division') === 'fifa') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script> -->
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#resulttable').DataTable({
            "paging": true, 
            "searching": true, 
            "ordering": true, 
            "order": [[0, 'asc']], 
            "lengthMenu": [10, 20, 30, 40], 
            "columnDefs": [
                {
                    "targets": 4, 
                    "orderable": false
                }
            ]
        });
    });
</script>
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
<script>
    $(document).ready(function() {
        // On page load, check which button is active and display the relevant rows
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

</html>

<?php include(APPPATH . 'views/layout/footer.php'); ?>