<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Pics/Logos/Lagro_High_School_logo.png">
    <title> Admin Page | LHS Clinic</title>
    <style>
    :root {
      --primary-color: green;
      --secondary-color: blue;
      --font-color: white;
      --gradient-color: linear-gradient(90deg, rgb(10, 89, 52) 50%, rgb(55, 123, 77) 100%);
      --input-color: #f1f1f1;
      --shadow: 0 2px 5px rgba(0, 0, 0, 0.4)
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    main {
      display: flex;
      justify-content: centerS;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .sidebar-container {
      position: relative;
      right: 100;
      margin-bottom: -10px;
    }

    /* ===== Table Section ===== */
    .table-section {
      display: flex;
      flex-direction: column;
      text-align: center;
    }

    .table-section h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 16px;
    }
    
    .table-container {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background: var(--gradient-color);
    }
    
    table thead th {
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-align: left;
    }

    table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.15s ease;
    }

    table tbody tr:hover {
        background: #f8f8fb;
    }

    table tbody td {
        padding: 12px 16px;
        font-size: 14px;
        color: #333;
    }
    </style>
</head>
<body>
  
  <main>
      <section class="sidebar-container">
        <?php include "../include/sidebar.php"; ?>
      </section>

      <section class="table-section">
        <div class="section-header">
          <h1>Admin Dashboard</h1>
        </div>

        <div class="table-container">
        <h2>Student List</h2>

          <table>
            <thead>
              <tr>
                <th>LRN</th>
                <th>Student Name</th>
                <th>Grade & Section</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody id="studentTableBody">
              <tr>
                <td colspan="6" class="loading-text">Loading student data...</td>
              </tr>
            </tbody>

          </table>
        </div>
      </section>
    </main>

    <footer>

    </footer>
</body>
</html>