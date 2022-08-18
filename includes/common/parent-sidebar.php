<nav class="navbar-nav">
    <div class="nav-title">
      <h1><img class="img-logo" src="/assets/images/dx-info-hub-logo.svg" alt="DX Info Hub" /></h1>
    </div>

    <ul>
      <!-- HOME -->
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'home') { echo ' active'; } ?>" href="/"> <i class="fa fa-home" aria-hidden="true"></i>HOME</a>
      </li>

       <!-- WEBINAR AND EVENTS -->
       <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'webinar-and-events') { echo ' active'; } ?>" href="/webinar-and-events"><i class="fa fa-calendar" aria-hidden="true"></i>WEBINAR AND EVENTS</a>
      </li>

       <!-- DOCUMENTS AND QUICK LINKS -->
       <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'documents') { echo ' active'; } ?>" href="/documents"><i class="fa fa-file-text-o" aria-hidden="true"></i>DOCUMENTS AND QUICK LINKS</a>
      </li>

       <!-- THE TEAM -->
       <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'users') { echo ' active'; } ?>" href="/teams"><i class="fa fa-users" aria-hidden="true"></i>THE TEAM</a>
      </li>

       <!-- ANNOUNCEMENTS -->
       <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'announcements') { echo ' active'; } ?>" href="/announcements"><i class="fa fa-bullhorn" aria-hidden="true"></i>ANNOUNCEMENTS</a>
      </li>

         <!-- LOGIN -->
         <li class="nav-item">
        <a class="nav-link js-scroll-trigger <?php if($page == 'login') { echo ' active'; } ?>" href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i>LOGIN</a>
      </li>


    </ul>
</nav>