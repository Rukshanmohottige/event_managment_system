<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ITUM Event Management System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header back>

    <img src="images\header-logo.jpg" alt="uni image" >

    <h1> Students Event Management at ITUM </h1>
    <nav>
      <a href="#" data-page="home">Home</a>
      <a href="#" data-page="events" id="nav-events">Events</a>
      
      <a href="#" data-page="login" id="nav-login">Login</a>
      <a href="#" data-page="register" id="nav-register">Register</a>
      <a href="#" id="nav-logout" style="display: none;">Logout</a>
    </nav>
  </header>

  <main>
    <section id="home" class="page">
      <h2>Welcome to Your Favourite University Management System</h2>
      <p>Discover, register for, and manage all academic and extracurricular events happening at the
            Institute of Technology University of Moratuwa..</p>
      <button data-page="events">See Events</button>
    </section>

    <section id="events" class="page hidden">
      <h2>Upcoming Events</h2>
      <div id="event-list"></div>
    </section>

    <section id="login" class="page hidden">
      <h2>Login</h2>
      <form id="loginForm">
        <label>Email:</label><br>
        <input type="email" id="loginEmail" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" id="loginPass" name="password" required><br><br>

        <button type="submit">Login</button>
        <p id="loginMsg"></p>
      </form>
    </section>

    <section id="register" class="page hidden">
      <h2>Create Account</h2>
      <form id="registerForm">
        <label>Name:</label><br>
        <input type="text" id="regName" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" id="regEmail" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" id="regPass" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" id="regConfirm" required><br><br>

        <button type="submit">Register</button>
        <p id="regMsg"></p>
      </form>
    </section>
  </main>

  <footer>
    <p>© 2025 ITUM - All Rights Reserved</p>
  </footer>

  <script src="java_script.js"></script>
</body>
</html>