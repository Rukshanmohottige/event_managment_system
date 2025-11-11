document.addEventListener("DOMContentLoaded", async function () { 
  const pages = document.querySelectorAll(".page");
  const links = document.querySelectorAll("a[data-page], button[data-page]");

  // --- Nav Links ---
  const navLogin = document.getElementById("nav-login");
  const navRegister = document.getElementById("nav-register");
  const navLogout = document.getElementById("nav-logout");

  // --- Page switching ---
  links.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const pageId = this.getAttribute("data-page");
      showPage(pageId);
    });
  });

  function showPage(id) {
    pages.forEach((p) => p.classList.add("hidden"));
    document.getElementById(id).classList.remove("hidden");
  }

  
  
  function updateNav(isLoggedIn) {
    if (isLoggedIn) {
      navLogin.style.display = "none";
      navRegister.style.display = "none";
      navLogout.style.display = "inline"; 
    } else {
      navLogin.style.display = "inline"; 
      navRegister.style.display = "inline"; 
      navLogout.style.display = "none";
    }
  }

  // --- Logout Handler ---
  navLogout.addEventListener("click", async (e) => {
    e.preventDefault();
    const res = await fetch("logout.php");
    const result = await res.text();
    
    if (result === "success") {
      updateNav(false); 
      showPage("home"); 
      showEvents(); 
    }
  });
  
  // --- Events ---
  const eventList = document.getElementById("event-list");

  async function showEvents() {
    eventList.innerHTML = "Loading events..."; 
    
    try {
      const res = await fetch("get_events.php");
      const events = await res.json();
      eventList.innerHTML = ""; 

      if (events.length === 0) {
        eventList.innerHTML = "<p>No upcoming events.</p>";
        return;
      }

      events.forEach((ev) => {
        const div = document.createElement("div");
        div.style.border = "1px solid gray";
        div.style.padding = "10px";
        div.style.margin = "10px";
        div.style.borderRadius = "8px";
        div.style.backgroundColor = "lightyellow";

        const eventDate = new Date(ev.event_date).toLocaleDateString("en-US", {
          year: 'numeric', month: 'long', day: 'numeric'
        });

        div.innerHTML = `<h3 style="color:blue">${ev.title}</h3>
                         <p>${eventDate} at ${ev.place}</p>
                         <button class="register-btn" data-event-id="${ev.id}">Register</button>
                         <span class="register-msg" style="margin-left: 10px;"></span>`;
        eventList.appendChild(div);
      });

    } catch (error) {
        console.error("Failed to load events:", error);
        eventList.innerHTML = "<p>Error loading events.</p>";
    }
  }

  // --- Event Registration Handler ---
  eventList.addEventListener("click", async function(e) {
    if (e.target.classList.contains("register-btn")) {
      const button = e.target;
      const eventId = button.getAttribute("data-event-id");
      const msgSpan = button.nextElementSibling; 

      const formData = new FormData();
      formData.append("event_id", eventId);

      const res = await fetch("register_event.php", {
        method: "POST",
        body: formData
      });
      const result = await res.text();

      if (result === "success") {
        msgSpan.textContent = "Registered!";
        msgSpan.style.color = "green";
        button.disabled = true;
        button.textContent = "Registered";
      } else if (result === "already_registered") {
        msgSpan.textContent = "You are already registered.";
        msgSpan.style.color = "blue";
        button.disabled = true;
        button.textContent = "Registered";
      } else if (result === "not_logged_in") {
        msgSpan.textContent = "Please login to register.";
        msgSpan.style.color = "red";
      } else {
        msgSpan.textContent = "Something went wrong.";
        msgSpan.style.color = "red";
      }
    }
  });

  // --- Login ---
  const loginForm = document.getElementById("loginForm");
  const loginMsg = document.getElementById("loginMsg");

  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);

    const res = await fetch("login.php", {
      method: "POST",
      body: formData,
    });

    const result = await res.text();
    if (result === "success") {
      loginMsg.style.color = "green";
      loginMsg.textContent = "Login Successful!";
      showEvents(); 
      showPage("events");
      updateNav(true); 
    } else {
      loginMsg.style.color = "red";
      loginMsg.textContent = "Login Failed! Check email or password.";
    }
  });

  // --- Register ---
  const regForm = document.getElementById("registerForm");
  const regMsg = document.getElementById("regMsg");

  regForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(regForm);

    const res = await fetch("register.php", {
      method: "POST",
      body: formData,
    });

    const result = await res.text();
    if (result === "success") {
      regMsg.style.color = "green";
      regMsg.textContent = "Registration successful! You can login now.";
      regForm.reset();
      setTimeout(() => showPage("login"), 1500);
    } else {
      regMsg.style.color = "red";
      regMsg.textContent = "Something went wrong! (Maybe email exists?)";
    }
  });

  // ---  Check session on page load ---
  async function checkSession() {
    const res = await fetch("check_session.php");
    const data = await res.json();
    if (data.loggedIn) {
      updateNav(true);
    } else {
      updateNav(false);
    }
  }

  // --- Initial Page Load ---
  await checkSession(); 
  showPage("home");
  showEvents(); 
});