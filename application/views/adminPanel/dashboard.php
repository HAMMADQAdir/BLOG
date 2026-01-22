<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, Admin!</h2>
    
    <a href="<?php echo base_url('index.php/admin/article/add_view'); ?>" class="btn btn-primary mb-3">
        + Add New Article
    </a>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Article Name</th>
                <th>Article Body</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php if(count($articles)): ?>
        <?php $count = 0; ?>
   
        
            <?php foreach($articles as $art): ?>
                <?php $count++; ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $art->article_name; ?></td>
            <td><?php echo $art->body; ?></td>
            
            <td>
                <a href="<?php echo base_url('index.php/admin/article/edit_article/' . $art->id); ?>" class="btn btn-sm btn-info">Edit</a>
                
                <a href="<?php echo base_url('index.php/admin/article/delete_article/' . $art->id); ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Are you sure you want to delete this Article?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" class="text-center">No articles found.</td>
        </tr>
    <?php endif; ?>
</tbody>
    </table>

    <a href="<?php echo base_url('index.php/admin/login/logout'); ?>" class="btn btn-danger">
            Logout
        </a>
</div>
</body>
</html>