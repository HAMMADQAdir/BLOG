<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Article</h2>

    <?php if(validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('index.php/admin/article/update_article/' . $article->id); ?>" method="post">
        
        <div class="form-group">
            <label>Article Name:</label>
            <input type="text" name="article_name" class="form-control" 
                   value="<?php echo set_value('article_name', $article->article_name); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Article Body:</label>
            <textarea name="body" class="form-control" rows="5" required><?php echo set_value('body', $article->body); ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Article</button>
        <a href="<?php echo base_url('index.php/admin/article'); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>