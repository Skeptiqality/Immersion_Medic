<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discharged History</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="..\js\bootstrap.bundle.min.js" />
  <link rel="icon" type="image/x-icon" href="../Pics/Logos/Lagro_High_School_logo.png">
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    main {
      display: flex;
    }

    .sidebar-container {
      position: relative;
      left: 0;
    }

    .container {
      flex: 1;
      padding: 24px;
    }

    .table-section h2 {
      font-size: 20px;
      font-weight: 700;
      color: #1a1a2e;
      margin-bottom: 16px;
    }

    .search-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      margin-right: 15px;
    }

    .search-bar {
      border-radius: 8px;
      padding: 8px 12px;
      border: 1px solid #ccc;
      width: 250px;
      font-size: 14px;
      margin-right: -35px;
      padding-right: 35px;
    }

    .search-btn {
      position: relative;
      background-color: #ffffff00;
      border: none;
      cursor: pointer;
      font-size: 18px;
    }

    .table-container {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      max-height: 600px;
      overflow-y: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table thead {
      background: var(--gradient-color);
      position: sticky;
      top: 0;
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

    .no-records {
      text-align: center;
      padding: 40px;
      color: #999;
    }
  </style>
</head>

<body>
  <main>
    <div class="sidebar-container">
      <?php include "../include/sidebar.php"; ?>
    </div>
    <div class="container">
      <div class="table-section">
        <div class="search-container">
          <h2>Discharged History</h2>
          <div class="search">
            <input type="text" class="search-bar" id="searchInput" placeholder="Search by name...">
            <button class="search-btn" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
              </svg></button>
          </div>
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Patient Name</th>
                <th>Guardian Name</th>
                <th>Contact#</th>
                <th>Address</th>
                <th>Relationship</th>
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>

        <tbody id="patientsTableBody">
          <?php
          include '../include/db.php';

          $sql = "SELECT * FROM discharged";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <tr>
                <td><?php echo $row["student_name"] ?></td>
                <td><?php echo $row["guardians_name"] ?></td>
                <td><?php echo $row["contact_no"] ?></td>
                <td><?php echo $row["address"] ?></td>
                <td><?php echo $row["relationship"] ?></td>
                <td data-time-out="<?php echo $row["time_out"] ?>">-</td>
                <td data-time-out="<?php echo $row["time_out"] ?>">-</td>
              </tr>

          <?php

            }
          } else {
            echo "<tr><td colspan='7' class='no-records'>No records found</td></tr>";
          }
          ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php include "../include/footer.php" ?>

  <script>
    // Format datetime string - returns separate date and time
    function formatDate(dt) {
      if (!dt || dt === '0000-00-00 00:00:00') return {
        date: '-',
        time: '-'
      };
      const d = new Date(dt);
      const dateStr = d.toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      });
      const timeStr = d.toLocaleString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
      });
      return {
        date: dateStr,
        time: timeStr
      };
    }

    // Format all date/time cells
    document.addEventListener('DOMContentLoaded', function() {
      const dateCells = document.querySelectorAll('td[data-time-out]');
      let cellIndex = 0;
      
      for (let i = 0; i < dateCells.length; i += 2) {
        const timeOut = dateCells[i].getAttribute('data-time-out');
        const formatted = formatDate(timeOut);
        
        dateCells[i].textContent = formatted.date;
        if (dateCells[i + 1]) {
          dateCells[i + 1].textContent = formatted.time;
        }
      }
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('patientsTableBody');
    const rows = tableBody.querySelectorAll('tr');
    const allRows = Array.from(rows);

    searchInput.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      
      allRows.forEach(row => {
        const patientName = row.querySelector('td:first-child')?.textContent.toLowerCase() || '';
        if (patientName.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>
