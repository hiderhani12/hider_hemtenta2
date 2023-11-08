<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


    <style>
        
    </style>
</head>
<body>
        <div class="boxA">
            <nav class="top">
                <div><a href="../index.php">hem</a></div>
                <div><a href="../functions/create.php">skapa</a></div>
                <div><a href="../functions/delete.php">radera</a></div>
                <div><a href="../functions/read.php">se allt</a></div>
                <div><a href="../functions/update.php">ändra</a></div>
            </nav>
        </div>

        <h2 class="text-center">Products List</h2>

        <div class="center-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        // Include the configuration file to connect to the database
                        include "config.php";

                        // SQL query to retrieve all products from the database
                        $sql = "SELECT * FROM products";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Print data in each row of the table
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='max-width:100px;max-height:100px;'></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>0 results</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

    <?php
        // Close the database connection after processing the data
        $conn->close();
    ?>
</body>
</html>
