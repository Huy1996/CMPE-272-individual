<?php 
session_start();
include 'header.php'; 
?>

<div class="form-container">
    <h2>Add User</h2>
    <form action="includes/insert_user.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="home_address">Home Address:</label>
        <input type="text" id="addhome_addressress" name="home_address">

        <label for="home_phone">Home Phone:</label>
        <input type="tel" id="home_phone" name="home_phone">

        <label for="cell_phone">Cell Phone:</label>
        <input type="tel" id="cell_phone" name="cell_phone">

        <input type="submit" value="Create User">
    </form>
</div>

<?php include 'footer.php'; ?>