<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}
require 'includes/db.php';

$message = '';

// Handle Add Employee
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $name    = $_POST['name'];
    $contact = $_POST['contact_no'];
    $uname   = $_POST['username'];
    $pass    = $_POST['password'];

    if (!$name || !$contact || !$uname || !$pass) {
        $message = "Error: All fields are required.";
    } else {
        $check = $pdo->prepare("SELECT id FROM employees WHERE username = ?");
        $check->execute([$uname]);
        if ($check->fetch()) {
            $message = "Error: Username already taken.";
        } else {
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO employees (name, contact_no, username, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $contact, $uname, $hashed]);
            $message = "Employee added successfully!";
        }
    }
}

// Handle Update Employee
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $contact = $_POST['contact_no'];
    $uname   = $_POST['username'];
    $pass    = $_POST['password'];

    if (!$id || !$name || !$contact || !$uname) {
        $message = "Error: All fields are required.";
    } else {
        $check = $pdo->prepare("SELECT id FROM employees WHERE username = ? AND id != ?");
        $check->execute([$uname, $id]);
        if ($check->fetch()) {
            $message = "Error: Username already taken by another employee.";
        } else {
            if ($pass != '') {
                $hashed = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE employees SET name=?, contact_no=?, username=?, password=? WHERE id=?");
                $stmt->execute([$name, $contact, $uname, $hashed, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE employees SET name=?, contact_no=?, username=? WHERE id=?");
                $stmt->execute([$name, $contact, $uname, $id]);
            }
            $message = "Employee updated successfully!";
        }
    }
}

// Handle Delete Employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id=?");
    $stmt->execute([$id]);
    $message = "Employee deleted.";
}

// Get employee to edit
$editEmp = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editEmp = $stmt->fetch();
}

// Get all employees
$employees = $pdo->query("SELECT * FROM employees ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Shop Management</title>
</head>
<body>

    <h2>Shop Management System</h2>
    <p>Logged in as: <b><?= $_SESSION['admin_username'] ?></b> | <a href="php/logout.php">Logout</a></p>

    <hr>

    <?php if ($message): ?>
        <p style="color:<?= strpos($message, 'Error') !== false ? 'red' : 'green' ?>;">
            <?= $message ?>
        </p>
    <?php endif; ?>

    <!-- ADD EMPLOYEE FORM -->
    <h3><?= $editEmp ? 'Edit Employee' : 'Add New Employee' ?></h3>

    <form method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="action" value="<?= $editEmp ? 'update' : 'add' ?>">
        <?php if ($editEmp): ?>
            <input type="hidden" name="id" value="<?= $editEmp['id'] ?>">
        <?php endif; ?>

        <p>
            Name: <input type="text" name="name" id="f_name" value="<?= $editEmp ? htmlspecialchars($editEmp['name']) : '' ?>">
        </p>
        <p>
            Contact No: <input type="text" name="contact_no" id="f_contact" value="<?= $editEmp ? htmlspecialchars($editEmp['contact_no']) : '' ?>">
        </p>
        <p>
            Username: <input type="text" name="username" id="f_username" value="<?= $editEmp ? htmlspecialchars($editEmp['username']) : '' ?>">
        </p>
        <p>
            Password: <input type="password" name="password" id="f_password">
            <?php if ($editEmp): ?><small>(leave blank to keep current password)</small><?php endif; ?>
        </p>
        <p>
            <input type="submit" value="<?= $editEmp ? 'Update Employee' : 'Add Employee' ?>">
            <?php if ($editEmp): ?>
                <a href="dashboard.php">Cancel</a>
            <?php endif; ?>
        </p>
    </form>

    <hr>

    <!-- SEARCH -->
    <h3>Employee List</h3>
    <p>
        Search: <input type="text" id="searchBox" onkeyup="doSearch()" placeholder="Type to search...">
        <span id="searchInfo"></span>
    </p>

    <!-- EMPLOYEE TABLE -->
    <table border="1" id="empTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Contact No</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="empBody">
            <?php if (empty($employees)): ?>
                <tr><td colspan="5">No employees found.</td></tr>
            <?php else: ?>
                <?php foreach ($employees as $i => $emp): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($emp['name']) ?></td>
                    <td><?= htmlspecialchars($emp['contact_no']) ?></td>
                    <td><?= htmlspecialchars($emp['username']) ?></td>
                    <td>
                        <a href="dashboard.php?edit=<?= $emp['id'] ?>">Edit</a> |
                        <a href="dashboard.php?delete=<?= $emp['id'] ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
    // Form Validation
    function validateForm() {
        var name    = document.getElementById('f_name').value;
        var contact = document.getElementById('f_contact').value;
        var username= document.getElementById('f_username').value;
        var password= document.getElementById('f_password').value;
        var isEdit  = <?= $editEmp ? 'true' : 'false' ?>;

        if (name == '') {
            alert('Name is required!');
            return false;
        }
        if (contact == '') {
            alert('Contact number is required!');
            return false;
        }
        if (username == '') {
            alert('Username is required!');
            return false;
        }
        if (!isEdit && password == '') {
            alert('Password is required!');
            return false;
        }
        return true;
    }

    // AJAX Search
    function doSearch() {
        var query = document.getElementById('searchBox').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/search_employee.php?q=' + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                var tbody = document.getElementById('empBody');
                var info  = document.getElementById('searchInfo');

                if (data.employees.length == 0) {
                    tbody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>';
                    info.innerHTML  = '';
                } else {
                    var html = '';
                    for (var i = 0; i < data.employees.length; i++) {
                        var emp = data.employees[i];
                        html += '<tr>';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + emp.name + '</td>';
                        html += '<td>' + emp.contact_no + '</td>';
                        html += '<td>' + emp.username + '</td>';
                        html += '<td><a href="dashboard.php?edit=' + emp.id + '">Edit</a> | <a href="dashboard.php?delete=' + emp.id + '" onclick="return confirm(\'Delete?\')">Delete</a></td>';
                        html += '</tr>';
                    }
                    tbody.innerHTML = html;
                    if (query != '') {
                        info.innerHTML = ' — ' + data.employees.length + ' result(s) found';
                    } else {
                        info.innerHTML = '';
                    }
                }
            }
        };
        xhr.send();
    }
    </script>

</body>
</html>
