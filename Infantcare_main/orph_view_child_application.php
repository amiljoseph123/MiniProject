<?php 
session_start();
 //echo $_SESSION["username"];
if (isset($_SESSION['username'])) {
    // User is logged in
    // You can display user-specific content here
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to stop execution after the redirect
}

?>





<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	 Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="Dstyle.css">

	<title>WELCOME</title>

	<style>
        /* CSS code to change the color */
        .text {
            color: blue; /* Change 'red' to the desired color */
        }
        #sidebar {
            background-color: #5bc1ac; /* Change '#f0f0f0' to the desired color */
            /* You can also use color names like 'red', HEX values, or RGB values */
        }
		.brand {
             color: red; /* Change this color to your desired color */
		}
	

    </style>
	<style>
				.apply-button {
					width: 150px;
            padding: 12px;
            background-color: #5bc1ac;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
		.reject-button {
					width: 150px;
            padding: 12px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        /* Optional hover effect */
        .apply-button:hover {
            background-color: #2980b9;
        }
		.reject-button:hover {
            background-color: #2980b9;
        }
	
    </style>
<style>
        

        .left {
            text-align: center;
			}

        h2 {
            color: green;
        }
    </style>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Welcome</span>
			<br>
			<span class="text"></span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="orphanage_homepage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="view_profile.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			<li>
				<a href="add_student3.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Add Student</span>
				</a>
			
			<li>
				<a href="view_student3.php">
					<i class='bx bxs-group' ></i>
					<span class="text">View Student</span>
				</a>
			</li>
		<!-- </ul> -->
		 <!-- <ul class="side-menu">  -->
			 <li>
				<a href="vol_dash.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">volunteer application</span>
				</a>
			</li> 

			<li>
				<a href="orph_view_child_application.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">sponsor application</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<!-- <i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a> -->
			<form action="#">
				<div class="form-input">
					<!-- <input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button> -->
					
				<input type="text" id="searchInput" oninput="searchTable()" placeholder="Search by Name">
          <button onclick="searchTable()"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
			<div class="left">
					<h2>List of sponsors applied for sponsor a student</h2>
					<ul class="breadcrumb">
						<!-- <li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li> -->
					</ul>
				</div>
				<?php
                    require './vendor/autoload.php';
					use PHPMailer\PHPMailer\PHPMailer;
					use PHPMailer\PHPMailer\SMTP;
					use PHPMailer\PHPMailer\Exception;

					function send_password_reset($get_email, $pswd) {
						$mail = new PHPMailer();
						// Example code around line 201
						// $mail = new PHPMailer();

						try {
							$mail->isSMTP();
							$mail->SMTPAuth = true;
							$mail->Host = 'smtp.gmail.com';
							$mail->Username = 'infantcare123@gmail.com';
							$mail->Password = 'ydee fjiu zver fsng';
							$mail->SMTPSecure = 'tls';
							$mail->Port = 587;

							$mail->setFrom('infantcare123@gmail.com', 'In');
							$mail->addAddress($get_email);
							$mail->isHTML(true);
							$mail->Subject = 'Your credential';
							$email_template = "
								<h2>Your volunteer application is approved . Use this username and password to login </h2>
								<h5>Username : $get_email</h5>
								<h5>Password : $pswd</h5>
								<br><br>
								<a href='http://localhost/Infantcare_main/login.php?email=$get_email'>Click me</a>";
							$mail->Body = $email_template;
							$mail->send();

							return true;
						} catch (Exception $e) {
							return false;
						}
					}

					?>
				<?php
                require_once 'config.php';
				$result = mysqli_query($con, "SELECT * FROM `sponsor_child` ") or die("error");
                // $result = mysqli_query($con, "SELECT * FROM `volunteer`") or die("error");
				 if (isset($_POST["add"])){
				$id= $_POST["app_id"];
				 	echo $id;
				 	mysqli_query($con, "UPDATE `sponsor_child` SET `status`='approved' WHERE `id`=$id") or die("error");
				// }


				// $result = mysqli_query($con, "SELECT * FROM `volunteer`") or die("error");
				// 	 if (isset($_POST['add'])) {
				// 	 	$id = $_POST['app_id'];
				//  		$result1=mysqli_query($con, "SELECT `email` FROM `sponsor` WHERE `id` = $id");
				// 		$row = $result1->fetch_assoc();
				// // 		// 
				//  		$get_email = $row['email'];
			   	// // 	    // Send the approval email
				// 	$subject = "Your application has been approved";
				// 	$message = "Dear applicant,\n\nYour application has been approved. Thank you for your interest in our program.";

				// 	// Additional headers
				// 	$headers = "From: infantcare123@gmail.com";

				// 	// Send the email
				// 	$success = mail($get_email, $subject, $message, $headers);

				// 	if ($success) {
				// 		echo "Email sent successfully.";
				// 	} else {
				// 		echo "Error sending email.";
				// 	}
				// }



					 } elseif (isset($_POST['reject'])) {
					 	$id = $_POST['app_id'];
					 	echo $id;
						mysqli_query($con, "UPDATE `sponsor_child` SET `status`='rejected' WHERE `id`=$id") or die("error");
					}
				?> 

                <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table id="myTable">
						<thead>
							<tr>
                                <th>Sl.No</th>
                                <th>FirstName</th>
								<th>LastName</th>
                                <th>Email</th>
                                <th> Phone</th>
                                <th>aadhar</th>
                                <th>District</th>
								<th>Address</th>
								 <th>Status</th>
								</tr>
						</thead>
						<tbody>
                        <?php
						     $c=0;
                            while ($row = $result->fetch_assoc()) {
                                $fname=$row["fname"];
								$lname=$row["lname"];
                                $email=$row["email"];
                                $pphone=$row["pphone"];
                                $aaadhar=$row["aaadhar"];
                                $district=$row["district"];
								$address=$row["address"];
								$status=$row["status"];
                               	$id=$row["id"];
								   $statusColor = ($status == 'approved') ? 'green' : 'red';
                                 $c++;
                        ?>
                <tr>
                    <td><?php echo $c; ?></td>
                    <td><?php echo $fname; ?></td>
					<td><?php echo $lname; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo  $pphone; ?></td>
					<td><?php echo $aaadhar; ?></td>
					<td><?php echo $district; ?></td>
					<td><?php echo $address; ?></td>
					<!-- <td style="color: <?php echo $statusColor; ?>"><?php echo $status; ?></td> -->
				   <td style="color: <?php echo $statusColor; ?>">
					<?php if ($status == 'approved'): ?>
						<span class="text-danger">Accepted</span>
					<?php elseif ($status == 'rejected'): ?>
						<span class="text-primary">Rejected</span>
					<?php else: ?>
						<form method="post">
							<input type="hidden" name="app_id"  value="<?php echo $id; ?>">
							<input name="add"  class="apply-button" type="submit" value="Approve">
						</form>
						<form action="" method="post">
                   <input type="hidden" name="app_id" value="<?php echo $id; ?>">
				   <br>
                   <button class="reject-button" type="submit" name="reject" >Reject</button>
		</form>
    <?php endif; ?>
</td>   
            
			</tr><?php
                }
                ?>
				</table> 
			</div> 
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<style>
        .status.not-accepted {
            color: #ff0000; /* Red color for rejected status */
            font-weight: bold; /* Make the text bold, if desired */
            /* Add any additional styles you want */
        }
    </style>
	<script src="Dscript.js"></script>
	<script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                // Skip the header row
                if (i !== 0) {
                    td = tr[i].getElementsByTagName("td")[1]; // Assuming the name is in the second cell
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        var containsLetter = txtValue.toUpperCase().includes(filter);
                        tr[i].style.display = containsLetter ? "" : "none";
                    }
                }
            }
        }
    </script>
</body>

</html>

