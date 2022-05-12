<?php
use app\views\headerTemplate;
use app\views\footerTemplate;

new headerTemplate('Sign Up');
?>
    <h1>This Sing Up</h1>

    <form action="<?php echo $_ENV['URL'];?>register" method="POST">
        <h2>Registrate</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Registrarse</button>
    </form>

<?php new footerTemplate();  ?>