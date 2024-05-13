<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            h1{
                text-align: center;
            }
            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 70vh;
            }
            .button {
                background-color: #37718e;
                width: 225px;
                height: 50px;
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 5px 2px;
                cursor: pointer;
                border-radius: 8px;
            }
            .button:hover {
                background-color: #37718e;
            }
        </style>
    </head>
    <body>
        <h1>Welcome to the Admin Dashboard</h1>
        <div class="container">
            <a href="home_bill.php" class="button">Bill Management</a>
            <a href="stock-management.php" class="button">Stock Management</a>
            <a href="add_detail.php" class="button">Hostel Management</a>
        </div>
    </body>
</html>
