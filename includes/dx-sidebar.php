<nav class="navbar-nav">
    <div class="nav-title">
    <h1><img class="img-logo" src="/assets/images/dx-info-hub-logo.svg" alt="DX Info Hub" /></h1>
    </div>
    <ul>
    <?php 
        if(isset($_SESSION['dx-home-page']) == 'dx-home-page') {
            echo '<li class="nav-item">';
                echo '<a class="nav-link js-scroll-trigger active" href="http://infohub.tcapdmwis.com/"> <i class="fa fa-home" aria-hidden="true"></i> Home';
                echo '</a>';
            echo '</li>';
        } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link js-scroll-trigger" href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a>';
            echo '</li>';
        }
        if(isset($_SESSION['dx-webinar-and-events-page']) == 'dx-webinar-and-events-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-webinar-and-events"><i class="fa fa-calendar" aria-hidden="true"></i> Webinars & Events ';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-webinar-and-events"><i class="fa fa-calendar" aria-hidden="true"></i> Webinars & Events </a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-documents-and-quick-links-page']) == 'dx-documents-and-quick-links-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-documents-and-quick-links"><i class="fa fa-file-text-o" aria-hidden="true"></i> Documents & Quick Links';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-documents-and-quick-links"><i class="fa fa-file-text-o" aria-hidden="true"></i> Documents & Quick Links</a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-team-page']) == 'dx-team-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-team"><i class="fa fa-users" aria-hidden="true"></i> The Team';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-team"><i class="fa fa-users" aria-hidden="true"></i> The Team</a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-announcements']) == 'dx-announcements') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-announcements"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcements';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-announcements"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcements</a>';
            echo '</li>';
          }

          if(isset($_SESSION['login-page']) == 'login-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN</a>';
            echo '</li>';
          }
    ?>
    </ul>
</nav>