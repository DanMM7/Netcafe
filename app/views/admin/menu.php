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
        .menu-item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            display: none;
            margin-top: 10px;
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
                            <a class="nav-link" href="<?=ROOT?>admin/categories">
                                <i class="fas fa-list"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=ROOT?>admin/menu">
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
                    <span class="navbar-brand">Menu Items</span>
                    <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addMenuItemModal">
                        <i class="fas fa-plus"></i> Add Menu Item
                    </button>
                </nav>

                <!-- Alert for displaying messages -->
                <div id="alertMessage" class="alert" style="display: none;"></div>

                <!-- Menu Items Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($data['menu_items'])): ?>
                                        <?php foreach($data['menu_items'] as $item): ?>
                                            <tr>
                                                <td>
                                                    <?php if($item->image): ?>
                                                        <img src="<?=ASSETS?>Netcafe/images/menu/<?=$item->image?>" 
                                                             class="menu-item-image" alt="<?=$item->name?>">
                                                    <?php else: ?>
                                                        <img src="<?=ASSETS?>Netcafe/images/no-image.jpg" 
                                                             class="menu-item-image" alt="No Image">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?=$item->name?></td>
                                                <td><?=$item->category_name?></td>
                                                <td><?=$item->description?></td>
                                                <td>$<?=number_format($item->price, 2)?></td>
                                                <td>
                                                    <span class="badge badge-<?=$item->is_available ? 'success' : 'danger'?>">
                                                        <?=$item->is_available ? 'Available' : 'Not Available'?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info edit-btn" 
                                                            data-id="<?=$item->id?>"
                                                            data-name="<?=$item->name?>"
                                                            data-description="<?=$item->description?>"
                                                            data-price="<?=$item->price?>"
                                                            data-category="<?=$item->category_id?>"
                                                            data-available="<?=$item->is_available?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                            data-id="<?=$item->id?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No menu items found</td>
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

    <!-- Add Menu Item Modal -->
    <div class="modal fade" id="addMenuItemModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addMenuItemForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach($data['categories'] as $category): ?>
                                    <option value="<?=$category->id?>"><?=$category->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                            <img id="previewImage" class="preview-image" src="" alt="Preview">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="isAvailable" name="is_available" checked>
                                <label class="custom-control-label" for="isAvailable">Available</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addMenuItemBtn">Add Item</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Menu Item Modal -->
    <div class="modal fade" id="editMenuItemModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editMenuItemForm" enctype="multipart/form-data">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach($data['categories'] as $category): ?>
                                    <option value="<?=$category->id?>"><?=$category->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                            <img id="editPreviewImage" class="preview-image" src="" alt="Preview">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="editIsAvailable" name="is_available">
                                <label class="custom-control-label" for="editIsAvailable">Available</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editMenuItemBtn">Update Item</button>
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

            // Preview Image
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewId).attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('input[name="image"]').change(function() {
                readURL(this, $(this).closest('form').find('.preview-image'));
            });

            // Add Menu Item
            $('#addMenuItemBtn').click(function() {
                var formData = new FormData($('#addMenuItemForm')[0]);
                $.ajax({
                    url: '<?=ROOT?>admin/add_menu_item',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if(data.success) {
                            $('#addMenuItemModal').modal('hide');
                            showAlert(data.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'danger');
                        }
                    }
                });
            });

            // Edit Menu Item
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var price = $(this).data('price');
                var category = $(this).data('category');
                var available = $(this).data('available');

                $('#editMenuItemForm input[name="id"]').val(id);
                $('#editMenuItemForm input[name="name"]').val(name);
                $('#editMenuItemForm textarea[name="description"]').val(description);
                $('#editMenuItemForm input[name="price"]').val(price);
                $('#editMenuItemForm select[name="category_id"]').val(category);
                $('#editMenuItemForm input[name="is_available"]').prop('checked', available == 1);

                $('#editMenuItemModal').modal('show');
            });

            $('#editMenuItemBtn').click(function() {
                var formData = new FormData($('#editMenuItemForm')[0]);
                $.ajax({
                    url: '<?=ROOT?>admin/edit_menu_item',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if(data.success) {
                            $('#editMenuItemModal').modal('hide');
                            showAlert(data.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'danger');
                        }
                    }
                });
            });

            // Delete Menu Item
            $('.delete-btn').click(function() {
                if(confirm('Are you sure you want to delete this menu item?')) {
                    var id = $(this).data('id');
                    $.post('<?=ROOT?>admin/delete_menu_item', {id: id}, function(response) {
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
