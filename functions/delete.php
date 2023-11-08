<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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

        <h2 class="text-center">Delete Product by ID</h2>
        <div class="form-div">
            <form method="POST">
                <div class="form-group">
                    <label for="remWhat">Remove ID:</label>
                    <input type="text" class="form-control" id="remWhat" name="remWhat">
                </div>
                <input class="btn btn-primary" type="submit" value="Submit" name="removeSubmit">
            </form>
        </div>

        <div class="table-div">
            <h2 class="text-center">Products List</h2>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>

                <?php
                // Include the configuration file to connect to the database
                include "config.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeSubmit'])) {
                    if(isset($_POST['remWhat'])) {
                        $product_id = $_POST['remWhat'];

                        // SQL-fråga för att radera en produkt baserat på angivet ID
                        $sql = "DELETE FROM products WHERE id = $product_id";

                        if ($conn->query($sql) === TRUE) {
                            echo "Record with ID $product_id deleted successfully";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }
                    } else {
                        echo "Please specify the ID of the product to be removed.";
                    }
                }

                // SQL-fråga för att hämta alla produkter från databasen
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='max-width: 150px;'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }

                // Stäng anslutningen till databasen
                $conn->close();
                ?>
            </table>
        </div>
</body>
</html>
