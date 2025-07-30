<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "barbershop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Revenue Page</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .container {
      max-width: 800px;
      margin: 80px auto;
      padding: 20px;
      background: #f9f9f9;
      border-radius: 10px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
    }

    button {
      background-color: #333;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th {
      background: #333;
      color: white;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ccc;
    }

    hr {
      margin: 40px 0;
    }
    .side-nav {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }

        .side-nav.active {
            transform: translateX(0);
        }

        .side-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-top: 60px;
        }

        .side-nav ul li {
            margin: 20px 0;
        }

        .side-nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            transition: color 0.3s ease;
        }

        .side-nav ul li a:hover {
            color: var(--bs-success);
        }

        .side-nav ul li a i {
            margin-right: 10px;
        }

        .menu-icon {
            background: none;
            border: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            cursor: pointer;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
        }

        .menu-line {
            width: 100%;
            height: 3px;
            background-color: white;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .menu-icon.active .menu-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .menu-icon.active .menu-line:nth-child(2) {
            opacity: 0;
        }

        .menu-icon.active .menu-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        .main-content {
            margin-left: 60px;
            padding: 20px;
        }
         .search-bar {
    text-align: right;
    margin-bottom: 10px;
  }

  .search-bar input[type="text"] {
    padding: 5px;
    width: 200px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
    table {
    width: 100%;
    border-collapse: collapse;
  }
  .table-container {
    position: relative;
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ccc;
    margin-top: 10px;
  }
  thead th {
    position: sticky;
    top: 0;
    background: #333;
    color: white;
  }

  th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  </style>
</head>
<body>
   <button class="menu-icon" id="menuToggle">
        <div class="menu-line"></div>
        <div class="menu-line"></div>
        <div class="menu-line"></div>
    </button>

    <nav class="side-nav" id="sideNav">
           <ul>
  <li><a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
  <li><a href="client_checkin.php"><i class="bi bi-person-check"></i> Client Check-In</a></li>
  <li><a href="expenses.php"><i class="bi bi-cash-coin"></i> Expenses</a></li>
  <li><a href="revenue.php"><i class="bi bi-graph-up"></i> Revenue</a></li>
<li><a href="debts.php"><i class="bi bi-credit-card"></i> Debts</a></li>
  <li><a href="monthly_record.php"><i class="bi bi-journal-text"></i> Monthly Record</a></li>
  <li><a href="barbers.php"><i class="bi bi-scissors"></i> Barbers Record</a></li>
 <!--<li><a href="manage_barbers.php"><i class="bi bi-person-gear"></i> Manage Barbers</a></li>-->
 <li><a href="services.php"><i class="bi bi-briefcase"></i> Services</a></li>
 <li><a href="advances.php"><i class="bi bi-wallet2"></i> Salary Advances</a></li>
<!--<li><a href="monthly_record.php"><i class="bi bi-briefcase"></i> Services</a></li>-->

  <li><a href="index.html" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
    </nav>

  <!-- Optional Header -->
  <?php if (file_exists('inc/header.php')) include 'inc/header.php'; ?>
<div class="container">
  <h2>Record Revenue</h2>
  <form action="revenue_process.php" method="POST">
    <label>Date:</label>
    <input type="date" name="date" required>

    <label>Client Name:</label>
    <input type="text" name="client_name" required>

    <label>Service:</label>
    <input type="text" name="service" required>

    <label>Price (KSh):</label>
    <input type="number" step="0.01" name="price" required>

    <label>Offered By:</label>
    <input type="text" name="offered_by" required>

    <button type="submit">Add Record</button>
  </form>

  <hr>

  <h3>All Revenue Records</h3>
  <div class="search-bar">
  <input type="text" id="searchInput" placeholder="Search records..." />
</div>

<!-- Scrollable Table Container -->
<div class="table-container">
  <table id="revenueTable">
    <thead>
      <tr>
        <th>Date</th>
        <th>Client Name</th>
        <th>Service</th>
        <th>Price (KSh)</th>
        <th>Offered By</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $conn = new mysqli("localhost", "root", "", "barbershop");
      if ($conn->connect_error) {
        echo "<tr><td colspan='6'>❌ Connection failed: " . $conn->connect_error . "</td></tr>";
      } else {
        $result = $conn->query("SELECT id, date, client_name, service, price, offered_by FROM revenue ORDER BY date DESC");

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td>" . htmlspecialchars($row['client_name']) . "</td>
                    <td>" . htmlspecialchars($row['service']) . "</td>
                    <td>KSh " . htmlspecialchars($row['price']) . "</td>
                    <td>" . htmlspecialchars($row['offered_by']) . "</td>
                    <td>
                      <form method='POST' action='delete_revenue.php' onsubmit=\"return confirm('Are you sure you want to delete this record?');\">
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' style='color: red;'>Delete</button>
                      </form>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No revenue records found.</td></tr>";
        }

        $conn->close();
      }
      ?>
    </tbody>
  </table>
</div>


  <!-- Optional Footer -->
  <?php if (file_exists('inc/footer.php')) include 'inc/footer.php'; ?>
<script>



        const menuToggle = document.getElementById('menuToggle');
        const sideNav = document.getElementById('sideNav');

        menuToggle.addEventListener('click', () => {
            sideNav.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });

        // Close navigation when clicking outside
        document.addEventListener('click', (e) => {
            if (!sideNav.contains(e.target) && !menuToggle.contains(e.target) && sideNav.classList.contains('active')) {
                sideNav.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        });


        const searchInput = document.getElementById("searchInput");
  const tableRows = document.querySelectorAll("#revenueTable tbody tr");

  searchInput.addEventListener("keyup", function () {
    const query = this.value.toLowerCase();

    tableRows.forEach(row => {
      const rowText = row.innerText.toLowerCase();
      row.style.display = rowText.includes(query) ? "" : "none";
    });
  });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
