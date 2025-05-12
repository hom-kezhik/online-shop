<form action="handle_profile.php" method="POST">
    <section id="account">
        <fieldset>
            <legend>Account:</legend>

            <label>Username:</label>
            <input type="text" name="name" value="<?= $user['name'] ?>">
            <label>Email address:</label>
            <input type="text" name="email" value="<?= $user['email'] ?>">
            <label>Password:</label>
            <input type="password" name="psw">
            <label>Confirm password:</label>
            <input type="password" name="psw-rep">
        </fieldset>
    </section>
    <div id="go"><button>Go</button></div>
</form>

<style>
    body {
        font-size: 2vh;
        font-family: sans-serif;
    }

    nav {
        display: flex;
    }

    nav a {
        margin: 0.5rem 0.25rem;
        padding: 1rem;
        background: #CCC;
        color: black;
    }

    form {
        width: 60%;
    }

    fieldset {
        margin: 2rem;
        padding: 1rem;
        border: 0;
    }

    legend {
        font-size: 1.5rem;
    }

    label {
        display: block;
        margin-top: 1rem;
    }

    section {
        display: none;
    }

    section:first-of-type {
        display: block;
    }
</style>