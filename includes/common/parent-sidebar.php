<nav class="navbar-nav mb-5 h-100 ">
  <div class="nav-title">
    <h1><img class="img-logo" src="/assets/images/dx-info-hub-logo.svg" alt="DX Info Hub" /></h1>
  </div>

  <ul class="h-100" style="flex:1">
    <!-- HOME -->
    <li class="nav-item">
      <a class="nav-link js-scroll-trigger <?php if($page == 'home') { echo ' active'; } ?>" href="/"> <i class="fa fa-home" aria-hidden="true"></i>Home</a>
    </li>

      <!-- WEBINAR AND EVENTS -->
      <li class="nav-item">
      <a class="nav-link js-scroll-trigger <?php if($page == 'o-webinar-and-events') { echo ' active'; } ?>" href="/o-webinar-and-events"><i class="fa fa-calendar" aria-hidden="true"></i>Webinars And Events</a>
    </li>

      <!-- DOCUMENTS AND QUICK LINKS -->
      <li class="nav-item">
      <a class="nav-link js-scroll-trigger <?php if($page == 'o-documents') { echo ' active'; } ?>" href="/o-documents"><i class="fa fa-file" aria-hidden="true"></i>Documents And Quick Links</a>
    </li>

      <!-- THE TEAM -->
      <li class="nav-item">
      <a class="nav-link js-scroll-trigger <?php if($page == 'o-teams') { echo ' active'; } ?>" href="/o-teams"><i class="fa fa-users" aria-hidden="true"></i>The Team</a>
    </li>

      <!-- ANNOUNCEMENTS -->
      <li class="nav-item">
      <a class="nav-link js-scroll-trigger <?php if($page == 'o-announcements') { echo ' active'; } ?>" href="/o-announcements"><i class="fa fa-bullhorn" aria-hidden="true"></i>Announcements</a>
    </li>  
  </ul>

  <div class="nav-footer mb-0"><hr>
    <ul>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'login') { echo ' active'; } ?>" href="/login">
          <i class="fa fa-user" aria-hidden="true"></i> Login
        </a>
      </li>
    </ul>
  </div>

</nav>
