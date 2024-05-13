<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Management</title>
    <style>
      h1 {
        text-align: center;
      }
      .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }
    .button {
        background-color: #37718e;
        width: 150px;
        height: 20px;
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
    }
    .button:hover {
        background-color: #37718e;
    }
    </style>
  </head>
  <body>
    <h1>Stock Management</h1>
    <div class="container">
        <a href="view_stocks.php" class="button">View Stock</a>
        <a href="update_stocks.php" class="button">Update Stock</a>
        
    </div>
  </body>
</html>
