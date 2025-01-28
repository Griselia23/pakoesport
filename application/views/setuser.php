<?php include(APPPATH . 'views/layout/header.php'); ?>
<!-- Include SweetAlert2 CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
     -->



<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
    </div>
    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li><a href="<?php echo base_url('admin'); ?>">Matches Monitor</a></li>
        <li><a href="<?php echo base_url('setuser'); ?>">Setting User</a></li>
        <li><a href="<?php echo base_url('uploadresult'); ?>">Upload Result</a></li>
        <li><a href="<?php echo base_url('#home'); ?>">Home</a></li>
        <li class="buy-tickets">
                    <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
                </li>
      </ul>
    </nav>
  </div>
</header>

<section id="main-content" style="background-color: white; padding: 20px; margin-top: 50px;">
    <div class="container">
        <div class="section-header">
            <h2>Registered Users</h2>
            <p>Here are the details of the registered users:</p>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addUserModal" style="padding: 5px 10px;">Add User</button>
        </div>

        <table class="table table-bordered table-striped mt-4" id="usersTable">
    <thead style="background-color:rgb(255, 255, 255);">
        <tr>
            <th style="color: black;">Username</th>
            <th style="color: black;">NPK</th>
            <th style="color: black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->npk; ?></td>
                    <td>
                        <!-- Edit button triggers the modal to edit the user -->
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editUserModal" 
                            data-id="<?php echo $user->id; ?>"
                            data-username="<?php echo $user->username; ?>"
                            data-npk="<?php echo $user->npk; ?>">
                            Edit
                        </button>
                        <a href="<?php echo base_url('setuser/delete_user/' . $user->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No users registered</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "order": [[0, 'asc']],
            "lengthMenu": [10, 25, 50, 100],
            "columnDefs": [
                {
                    "targets": 2, // Disable sorting for the Action column
                    "orderable": false
                }
            ]
        });
    });
</script>

    </div>
</section>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('setuser/add_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="npk">NPK</label>
                        <input type="text" class="form-control" id="npk" name="npk" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('setuser/edit_user/' . (isset($user) ? $user->id : '')); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="id" value="<?php echo isset($user) ? $user->id : ''; ?>">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" value="<?php echo isset($user) ? $user->username : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password">
                    </div>
                    <div class="form-group">
                        <label for="editNPK">NPK</label>
                        <input type="text" class="form-control" id="editNPK" name="npk" value="<?php echo isset($user) ? $user->npk : ''; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (isset($message)): ?>
        Swal.fire({
            title: 'Success!',
            text: '<?php echo $message; ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>



<main id="main">
</main>

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<!-- Include SweetAlert2 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> -->


</body>
</html>
<?php include(APPPATH . 'views/layout/footer.php'); ?>