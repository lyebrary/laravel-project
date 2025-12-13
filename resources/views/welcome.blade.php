<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Third Space</title>
  <link rel="stylesheet" href="{{ asset('css/front.css') }}">

  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
  <header class="navbar">
    <div class="left-navbar">
      <div class="logo">
        <img src="{{ URL::asset('/images/logo-thirds.png') }}" alt="logo"> 
      </div>
      <ul>
        <li><a href="#">about</a></li>
        <li><a href="#">faqs</a></li>
      </ul>
    </div>

    <div class="right-navbar">
      <div class="register-container">
        <a class="register" href="#"> Register </a>
      </div>
    </div>
  </header>

  <div class="main">
    <div class="left-main">
      <img src="{{ URL::asset('/images/happy-thirds.png') }}">
    </div>

    <div class="right-main">
      <img src="{{ URL::asset('/images/five-logo.png') }}">
      <h1>find your space in    <br> the third space.</h1>
      <form action="#">
        <label>Student Number (20XXXXXXX)</label>
        <input type="text" name="Input your student number">
      </form>

      <div class="user-auth">
        <div class="login">Log in</div>
        <div class="logout">Log out</div>
      </div>
      <p>Haven't registered? <span><a href="#">Register here.</a></span></p>
    </div>

    <div class="bottom-main">

    </div>
  </div>
  <div class="footer"></div>
</body>
</html>

<div class="bottom-main">
      <div class="card card-seats">
        <img src="{{ URL::asset('/images/chair-icon.png') }}" alt="chair-icon" id="chair-icon">
        <p><span class="seat">87</span> / <span class="seat">250</span></p>
      </div>


      <div class="card card-time">
        <img src="{{ URL::asset('/images/clock-icon.png') }}" alt="clock-icon" id="clock-icon">
        <p><span class="time">8</span>AM - <span class="time">8</span>PM</p>
      </div>


      <div class="card card-sched">
        <p>ORANGE ZONE</p>
        <p><span class="time-sched">8:00AM-10:00AM</span> UP FLIPP</p>
        <p><span class="time-sched">3:00PM-6:00PM</span> UP Kalilayan</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
      </div>
    </div>
  </div>


  <div class="footer">
    <div class="orange">
     
      <div class="copyright">
        <h3>STAY IN THE LOOP, STAY IN THE ZONE</h3>
        <h3>©2025 THE THIRD SPACE DILIMAN</h3>
      </div>


      <div class="vl"></div>


      <div class="links">
        <p><a href="#">About Us</a> | <a href="#">FAQs</a></p>
        <div class="socials">
          <div class="social-item">
            <img src="{{ URL::asset('/images/facebook-icon.png') }}" alt="facebook icon">
            <img src="{{ URL::asset('images/instagram-icon.png') }}" alt="instagram-icon">
            <span>@thirdspace.upd</span>
          </div>
          <div class="social-item">
            <img src="{{ URL::asset('/images/email-icon.png') }}">
            <span>the.thirdspace.upd@up.edu.ph</span>
          </div>
        </div>
      </div>
    </div>
    <div class="green"></div>
    <div class="blue"></div>
  </div>


  <script>
    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar');
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>
</body>
</html>
