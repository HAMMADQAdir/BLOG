<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Register New user</h2>

    <?php if(validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('index.php/admin/register/register_user'); ?>" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="<?php echo base_url('index.php/admin/login'); ?>" class="btn btn-link">Already have an account? Login</a>
    </form>
</div>
</body>
</html>