<?php
date_default_timezone_set('America/Los_Angeles');
include("includes/functions.php");
include_once("includes/config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>TODO</title>
    <link rel="stylesheet" href="css/stylesheet.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">


</head>

<?php
if (isset($_POST['btn_ADD'])) {
    $Date = ($_POST["Date"]);
    $Time = ($_POST["Time"]);
    $Description = trim($_POST["Desc"]);
    $Completed = 0;
    if (isset($_POST['Completed'])) {
        $Completed = 1;
    }
    $sql = "INSERT INTO tasks (UserID,Date,Time,Description,Completed) VALUES ('" . $_SESSION['UID'] . "','" . $Date . "','" . $Time . "','" . $Description . "'," . $Completed . ");";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<body>
    <div class="home">
        <div class="container ">
            <nav class="navbar  navv ">
                <div class="container-fluid">
                    <h3>
                        Welcome <?php echo $_SESSION['name'] ?> 👋👋👋👋
                    </h3>
                </div>
            </nav>


            <div class="content">
                <div class="todolist">
                    <h2>📝To Do List</h2>
                    <div class="todo">
                        <div class="card">
                            <h3 class="card-header">Yesterday</h3>
                            <div class="card-body">

                                <ul>
                                    <h4>
                                    <?php
                                        $getQuery = "select * from tasks where UserID=" . $_SESSION['UID'] . " and Date = '" . date("Y-m-d",strtotime("-1 days")) . "';";
                                        $result = $conn->query($getQuery)  or die($conn->error);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<li>";
                                                if ($row["Completed"] == 1) {
                                                    echo "<del>";
                                                }
                                                echo $row["Description"];
                                                if ($row["Completed"] == 1) {
                                                    echo "</del>";
                                                }
                                                echo "</li>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </h4>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="todo">
                        <div class="card">
                            <h3 class="card-header">Today</h3>
                            <div class="card-body">

                                <ul>
                                    <h4>

                                        <?php
                                        $getQuery = "select * from tasks where UserID=" . $_SESSION['UID'] . " and Date = '" . date("Y-m-d") . "';";
                                        $result = $conn->query($getQuery)  or die($conn->error);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<li>";
                                                if ($row["Completed"] == 1) {
                                                    echo "<del>";
                                                }
                                                echo $row["Description"];
                                                if ($row["Completed"] == 1) {
                                                    echo "</del>";
                                                }
                                                echo "</li>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>

                                    </h4>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="todo">
                        <div class="card">
                            <h3 class="card-header">Tomorrow</h3>
                            <div class="card-body">

                                <ul>
                                    <h4>
                                    <?php
                                        $getQuery = "select * from tasks where UserID=" . $_SESSION['UID'] . " and Date = '" . date("Y-m-d",strtotime("+1 days")) . "';";
                                        $result = $conn->query($getQuery)  or die($conn->error);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<li>";
                                                if ($row["Completed"] == 1) {
                                                    echo "<del>";
                                                }
                                                echo $row["Description"];
                                                if ($row["Completed"] == 1) {
                                                    echo "</del>";
                                                }
                                                echo "</li>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </h4>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="right">
                    <h2>📅Calendar</h2>
                    <div class="calendar">
                        <h3><?php echo date("Y-m-d") ?></h3>
                        <?php
                        $getQuery = "select * from tasks where UserID=" . $_SESSION['UID'] . " and Date = '" . date("Y-m-d") . "';";
                        $result = $conn->query($getQuery)  or die($conn->error);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<p>" . $row["Time"] . "&nbsp;&nbsp;&nbsp;";
                                if ($row["Completed"] == 1) {
                                    echo "<del>";
                                }
                                echo $row["Description"];
                                if ($row["Completed"] == 1) {
                                    echo "</del>";
                                }
                                echo "</p>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </div>
                    <h2>📖Scheduler</h2>
                    <div class="calendar">
                        <form method="POST">
                            <label for="Date">Choose due date</label>
                            <input id="Date" class="form-control form-control-sm" type="date" min="2018-01-01" name="Date" required>

                            <label for="Time">Choose a time</label>
                            <input id="Time" class="form-control form-control-sm" type="time" name="Time" required>

                            <label for="Desc">Create your task description</label>
                            <input id="Desc" class="form-control form-control-sm" type="text" name="Desc" placeholder="Enter the text" required>

                            <label for="Completed">Task Completed?</label>
                            <input id="Completed" type="checkbox" name="Completed">
                            <br>

                            <input type="submit" name="btn_ADD" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <a href="logout.php" class="btn btn-dark btns" name='logout'>LOGOUT</a>
        </div>
    </div>
    </div>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>

</html>