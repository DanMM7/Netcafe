<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['page_title']?> | <?=WEBSITE_NAME?></title>
    <link rel="stylesheet" href="<?=ASSETS?>Netcafe/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
        }
        .sidebar .nav-link:hover {
            color: rgba(255,255,255,1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="p-3">
                    <h4><?=WEBSITE_NAME?> Admin</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=ROOT?>admin">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=ROOT?>admin/categories">
                                <i class="fas fa-list"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=ROOT?>admin/menu">
                                <i class="fas fa-utensils"></i> Menu Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=ROOT?>admin/orders">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=ROOT?>admin/bookings">
                                <i class="fas fa-calendar-alt"></i> Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=ROOT?>admin/users">
                                <i class="fas fa-users"></i> Users
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?=ROOT?>admin/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                    <span class="navbar-brand">Categories</span>
                    <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </nav>

                <!-- Alert for displaying messages -->
                <div id="alertMessage" class="alert" style="display: none;"></div>

                <!-- Categories Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($data['categories'])): ?>
                                        <?php foreach($data['categories'] as $category): ?>
                                            <tr>
                                                <td><?=$category->id?></td>
                                                <td><?=$category->name?></td>
                                                <td><?=$category->description?></td>
                                                <td><?=$category->created_at?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info edit-btn" 
                                                            data-id="<?=$category->id?>"
                                                            data-name="<?=$category->name?>"
                                                            data-description="<?=$category->description?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                            data-id="<?=$category->id?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No categories found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addCategoryBtn">Add Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editCategoryBtn">Update Category</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=ASSETS?>Netcafe/js/jquery.min.js"></script>
    <script src="<?=ASSETS?>Netcafe/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show Alert Message
            function showAlert(message, type) {
                $('#alertMessage')
                    .removeClass()
                    .addClass('alert alert-' + type)
                    .html(message)
                    .show()
                    .delay(3000)
                    .fadeOut();
            }

            // Add Category
            $('#addCategoryBtn').click(function() {
                var formData = $('#addCategoryForm').serialize();
                $.post('<?=ROOT?>admin/add_category', formData, function(response) {
                    var data = JSON.parse(response);
                    if(data.success) {
                        $('#addCategoryModal').modal('hide');
                        showAlert(data.message, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message, 'danger');
                    }
                });
            });

            // Edit Category
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');

                $('#editCategoryForm input[name="id"]').val(id);
                $('#editCategoryForm input[name="name"]').val(name);
                $('#editCategoryForm textarea[name="description"]').val(description);

                $('#editCategoryModal').modal('show');
            });

            $('#editCategoryBtn').click(function() {
                var formData = $('#editCategoryForm').serialize();
                $.post('<?=ROOT?>admin/edit_category', formData, function(response) {
                    var data = JSON.parse(response);
                    if(data.success) {
                        $('#editCategoryModal').modal('hide');
                        showAlert(data.message, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message, 'danger');
                    }
                });
            });

            // Delete Category
            $('.delete-btn').click(function() {
                if(confirm('Are you sure you want to delete this category?')) {
                    var id = $(this).data('id');
                    $.post('<?=ROOT?>admin/delete_category', {id: id}, function(response) {
                        var data = JSON.parse(response);
                        if(data.success) {
                            showAlert(data.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'danger');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
