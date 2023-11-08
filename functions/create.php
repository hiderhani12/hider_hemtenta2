<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products List</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
        <div class="boxA">
            <nav class="top">
                <a href="../index.php">hem</a>
                <a href="../functions/create.php">skapa</a>
                <a href="../functions/delete.php">radera</a>
                <a href="../functions/read.php">se allt</a>
                <a href="../functions/update.php">ändra</a>
            </nav>
        </div>
        <h2>Add New Product</h2>

        <div class="form-div">
            <form method="POST" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                <br><br>
                
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" required>
                <br><br>
                
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
                <br><br>
                
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" required>
                <br><br>
                
                <input type="submit" name="submit" value="Add Product">
            </form>
        </div>

        
                    <?php
                        include "config.php";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = $_POST['name'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];

                            $targetDir = "uploads/";
                            $targetFile = $targetDir . basename($_FILES['image']['name']);

                            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                                $image = $targetFile;

                                $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";

                                if ($conn->query($sql) === TRUE) {
                                    echo "New product added successfully";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            } else {
                                echo "Error uploading the image.";
                            }
                        }
                    ?>

            </table>
        </div>
</body>
</html>
