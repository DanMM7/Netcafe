<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['page_title']?> | <?=WEBSITE_NAME?></title>
    <link rel="stylesheet" href="<?=ASSETS?>Netcafe/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .errors {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Admin Login</h2>
            
            <?php if(!empty($data['errors'])): ?>
                <div class="alert alert-danger errors">
                    <?php foreach($data['errors'] as $error): ?>
                        <div><?=$error?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="<?=ROOT?>" class="text-muted">Back to Website</a>
            </div>
        </div>
    </div>

    <script src="<?=ASSETS?>Netcafe/js/jquery.min.js"></script>
    <script src="<?=ASSETS?>Netcafe/js/bootstrap.min.js"></script>
</body>
</html>
