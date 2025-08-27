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
                    <span class="navbar-brand">Orders</span>
                    <div class="ml-auto">
                        <select id="filterStatus" class="form-control">
                            <option value="">All Orders</option>
                            <?php foreach($data['statuses'] as $status): ?>
                                <option value="<?=$status->id?>"><?=$status->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </nav>

                <!-- Alert for displaying messages -->
                <div id="alertMessage" class="alert" style="display: none;"></div>

                <!-- Orders Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($data['orders'])): ?>
                                        <?php foreach($data['orders'] as $order): ?>
                                            <tr data-status="<?=$order->status_id?>">
                                                <td>#<?=$order->id?></td>
                                                <td>
                                                    <?=$order->customer_name?><br>
                                                    <small class="text-muted"><?=$order->customer_email?></small>
                                                </td>
                                                <td>$<?=number_format($order->total_amount, 2)?></td>
                                                <td>
                                                    <span class="status-<?=strtolower($order->status_name)?>">
                                                        <?=$order->status_name?>
                                                    </span>
                                                </td>
                                                <td><?=$order->payment_method?></td>
                                                <td><?=date('M d, Y H:i', strtotime($order->created_at))?></td>
                                                <td>
                                                    <a href="<?=ROOT?>admin/order_details/<?=$order->id?>" 
                                                       class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-primary update-status" 
                                                            data-id="<?=$order->id?>"
                                                            data-status="<?=$order->status_id?>">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No orders found</td>
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
                        <input type="hidden" name="order_id">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status_id" required>
                                <?php foreach($data['statuses'] as $status): ?>
                                    <option value="<?=$status->id?>"><?=$status->name?></option>
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

            // Filter orders by status
            $('#filterStatus').change(function() {
                var status = $(this).val();
                if(status === '') {
                    $('tbody tr').show();
                } else {
                    $('tbody tr').hide();
                    $('tbody tr[data-status="' + status + '"]').show();
                }
            });

            // Update Status
            $('.update-status').click(function() {
                var orderId = $(this).data('id');
                var currentStatus = $(this).data('status');
                
                $('#updateStatusForm input[name="order_id"]').val(orderId);
                $('#updateStatusForm select[name="status_id"]').val(currentStatus);
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
