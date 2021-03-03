<?php
require APPROOT .'/views/includes/header.php';
?>

<main role="main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>

    <section class="login-container">
        <aside class="wrapper-login">
            <h2>Sign in</h2>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">

                <input type="text" placeholder="Firstname *" name="firstname">
                <input type="text" placeholder="Lastname *" name="lastname">

                <input type="text" placeholder="Email *" name="email">
                <span class="invalidFeedback">
                    <?php echo $data['emailError']; ?>
                </span>

                <input type="text" placeholder="Username *" name="username">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>

                <input type="password" placeholder="Password *" name="password">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>

                <input type="password" placeholder="Confirm Password *" name="confirmPassword">
                <span class="invalidFeedback">
                    <?php echo $data['confirmPasswordError']; ?>
                </span>


                <button id="submit" type="submit" value="submit">Submit</button>

                <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an account </a></p>
            </form>
        </aside>
    </section>

</main>