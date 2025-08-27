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
        .status-new { color: #007bff; }
        .status-processing { color: #ffc107; }
        .status-ready { color: #17a2b8; }
        .status-delivering { color: #6610f2; }
        .status-completed { color: #28a745; }
        .status-cancelled { color: #dc3545; }
        .menu-item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
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
                            <a class="nav-link" href="<?=ROOT?>admin/menu">
                                <i class="fas fa-utensils"></i> Menu Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=ROOT?>admin/orders">
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
                    <span class="navbar-brand">Order #<?=$data['order']->id?></span>
                    <div class="ml-auto">
                        <button class="btn btn-primary update-status" 
                                data-id="<?=$data['order']->id?>"
                                data-status="<?=$data['order']->status_id?>">
                            <i class="fas fa-sync-alt"></i> Update Status
                        </button>
                        <a href="<?=ROOT?>admin/orders" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </nav>

                <!-- Alert for displaying messages -->
                <div id="alertMessage" class="alert" style="display: none;"></div>

                <div class="row">
                    <!-- Order Details -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Details</h5>
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8">
                                        <span class="status-<?=strtolower($data['order']->status_name)?>">
                                            <?=$data['order']->status_name?>
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Date:</dt>
                                    <dd class="col-sm-8">
                                        <?=date('M d, Y H:i', strtotime($data['order']->created_at))?>
                                    </dd>

                                    <dt class="col-sm-4">Payment:</dt>
                                    <dd class="col-sm-8"><?=$data['order']->payment_method?></dd>

                                    <dt class="col-sm-4">Total:</dt>
                                    <dd class="col-sm-8">$<?=number_format($data['order']->total_amount, 2)?></dd>
                                </dl>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Customer Details</h5>
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">Name:</dt>
                                    <dd class="col-sm-8"><?=$data['order']->customer_name?></dd>

                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8"><?=$data['order']->customer_email?></dd>

                                    <dt class="col-sm-4">Phone:</dt>
                                    <dd class="col-sm-8"><?=$data['order']->customer_phone?></dd>

                                    <dt class="col-sm-4">Address:</dt>
                                    <dd class="col-sm-8"><?=$data['order']->delivery_address?></dd>

                                    <?php if($data['order']->special_instructions): ?>
                                        <dt class="col-sm-4">Notes:</dt>
                                        <dd class="col-sm-8"><?=$data['order']->special_instructions?></dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Items</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($data['items'] as $item): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <?php if($item->image): ?>
                                                                <img src="<?=ASSETS?>Netcafe/images/menu/<?=$item->image?>" 
                                                                     class="menu-item-image mr-2" alt="<?=$item->name?>">
                                                            <?php endif; ?>
                                                            <?=$item->name?>
                                                        </div>
                                                    </td>
                                                    <td>$<?=number_format($item->price, 2)?></td>
                                                    <td><?=$item->quantity?></td>
                                                    <td>$<?=number_format($item->price * $item->quantity, 2)?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                                <td><strong>$<?=number_format($data['order']->total_amount, 2)?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateStatusForm">
                        <input type="hidden" name="order_id" value="<?=$data['order']->id?>">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status_id" required>
                                <?php foreach($data['statuses'] as $status): ?>
                                    <option value="<?=$status->id?>" <?=$status->id == $data['order']->status_id ? 'selected' : ''?>>
                                        <?=$status->name?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Note (Optional)</label>
                            <textarea class="form-control" name="status_note" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateStatusBtn">Update Status</button>
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

            // Update Status
            $('.update-status').click(function() {
                $('#updateStatusModal').modal('show');
            });

            $('#updateStatusBtn').click(function() {
                var formData = $('#updateStatusForm').serialize();
                $.post('<?=ROOT?>admin/update_order_status', formData, function(response) {
                    var data = JSON.parse(response);
                    if(data.success) {
                        $('#updateStatusModal').modal('hide');
                        showAlert(data.message, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message, 'danger');
                    }
                });
            });
        });
    </script>
</body>
</html>
