<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
</head>
<body>
    <h2>Add New Article</h2>

    <?php echo validation_errors(); ?>

    <form action="<?php echo base_url('index.php/admin/article/add_article'); ?>" method="post">
        
        <div>
            <label>Article Title:</label><br>
            <input type="text" name="article_title" style="width: 300px;">
        </div>
        <br>
        
        <div>
            <label>Article Body:</label><br>
            <textarea name="article_body" rows="5" cols="40"></textarea>
        </div>
        <br>
        
        <button type="submit">Publish Article</button>
    </form>
</body>
</html>