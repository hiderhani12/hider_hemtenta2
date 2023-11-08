<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


</head>
<body>
    <div class="boxA">
        
        <nav class="top">
            <div> <a href="../index.php">hem</a></div>
            <div> <a href="../functions/create.php">skapa</a></div>
            <div> <a href="../functions/delete.php">radera</a></div>
            <div> <a href="../functions/read.php">se allt</a></div>
            <div> <a href="../functions/update.php">ändra</a></div>


        </nav>

    </div>
    <h2>Update Product</h2>

    <form method="POST" enctype="multipart/form-data">
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" required>
        <br><br>

        <label for="name">New Name:</label>
        <input type="text" name="name" id="name">
        <br><br>

        <label for="description">New Description:</label>
        <input type="text" name="description" id="description">
        <br><br>

        <label for="price">New Price:</label>
        <input type="number" name="price" id="price">
        <br><br>
        
        <label for="image">New Image:</label>
        <input type="file" name="image" id="image">
        <br><br>
        
        <input type="submit" value="Update Product">
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_id = $_POST['product_id'];
        $new_name = $_POST['name'];
        $new_description = $_POST['description'];
        $new_price = $_POST['price'];

        if (isset($_FILES['image'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $new_image = $targetFile;
                $sql = "UPDATE products SET name = '$new_name', description = '$new_description', price = '$new_price', image = '$new_image' WHERE id = $product_id";

                if ($conn->query($sql) === TRUE) {
                    echo "Product updated successfully";
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            } else {
                echo "Error uploading the image.";
            }
        } else {
            $sql = "UPDATE products SET name = '$new_name', description = '$new_description', price = '$new_price' WHERE id = $product_id";

            if ($conn->query($sql) === TRUE) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product: " . $conn->error;
            }
        }
    }
    ?>
</body>
</html>
