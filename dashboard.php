<?php
session_start();
include 'db.php';

// Ensure the user is logged in before accessing the dashboard
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirect back to the dashboard after deletion
    header("Location: dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <!-- Logout Button -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="logout.php" method="post" class="d-flex">
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Users List -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Users List</h4>
                        <a href="add_user.php" class="btn btn-outline-primary d-flex align-items-center" style="gap: 0.25rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 1 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 1 0 0-1h-3v-3z" />
                            </svg>
                            <span>Add</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['firstname']; ?></td>
                                        <td><?php echo $row['lastname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><a class="btn btn-primary" href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
                                            &nbsp;
                                            <a class="btn btn-danger" href="dashboard.php?id=<?php echo $row['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal End -->

    <!-- <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                id = tr.getElementsByTagName("td")[0].innerText;
                firstname = tr.getElementsByTagName("td")[1].innerText;
                lastname = tr.getElementsByTagName("td")[2].innerText;
                email = tr.getElementsByTagName("td")[3].innerText;
                console.table(id, firstname, lastname, email);

                window.location.href = `edit_user.php?id=${id}&firstname=${firstname}&lastname=${lastname}&email=${email}`;
            })
        });

        let userIdToDelete; // Store the ID of the user we want to delete

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // Get the user ID from the button
                userIdToDelete = e.target.id.substr(7);
                // Show the Bootstrap modal
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });

        document.getElementById('confirmDelete').addEventListener("click", () => {
            if (userIdToDelete) {
                window.location = `dashboard.php?delete=${userIdToDelete}`;
            }
        });
    </script> -->

</body>

</html>