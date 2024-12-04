<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include __DIR__ . '/../users/nav.view.php'; ?>
    <div class="container">
        <div class="row py-2 justify-content-center h5">
            Categories
        </div>
        <div class="row">
            <div class="col-md-10 m-auto mt-4">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $category): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($category['name']); ?></td>
                                <td>
                                    <a href="/categories/edit/<?= $category['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/categories/delete/<?= $category['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/categories/add" class="btn btn-sm btn-primary">Add New Category</a>
            </div>
        </div>
    </div>
</body>
</html>
