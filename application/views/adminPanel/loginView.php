<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="<?php echo base_url('index.php/admin/login/authenticate'); ?>" method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="name" required>
        </div>
        <br>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>