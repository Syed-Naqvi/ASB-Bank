
<?php
 # Script 9.3 - register.php
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = []; // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = trim($_POST['first_name']);
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = trim($_POST['last_name']);
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}

	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = trim($_POST['pass1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		require('../mysqli_connect.php'); // Connect to the db.

		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA2('$p', 512), NOW() )";
		$r = @mysqli_query($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br></p>';

		} else { // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include('includes/footer.html');
		exit();

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';

	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
<h1>Register</h1>
<form action="register.php" method="post">

        <p>

            <label for="User_id">id(enter 4 character id):</label>

            <input type="text" name="User_id" id="User_id">

        </p>
	<p>

            <label for="Track_id"> Tracker id(enter 5 character Tracker id):</label>

            <input type="text" name="Track_id" id="Track_id">

        </p>



	<p>

            <label for="f_name">First Name:</label>

            <input type="text" name="f_name" id="f_name">

        </p>

        <p>

            <label for="l_name">Last Name:</label>

            <input type="text" name="l_name" id="l_name">

        </p>

        <p>

            <label for="Address">Address:</label>

            <input type="text" name="Address" id="Address">

        </p>


	<p>

            <label for="Date_joined">Date Joined:</label>

            <input type="text" name="Date_joined" id="Date_joined">

        </p>
        <input type="submit" name= "submit" value="Submit">

    </form>
<?php include('includes/footer.html'); ?>



