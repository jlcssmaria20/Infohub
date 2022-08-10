<nav class="navbar-nav">
    <div class="nav-title">
    <h1><img class="img-logo" src="/assets/images/dx-info-hub-logo.svg" alt="DX Info Hub" /></h1>
    </div>
    <ul>
    <?php 
        if(isset($_SESSION['dx-home-page']) == 'dx-home-page') {
            echo '<li class="nav-item">';
                echo '<a class="nav-link js-scroll-trigger active" href="http://infohub.tcapdmwis.com/">Home';
                echo '</a>';
            echo '</li>';
        } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link js-scroll-trigger" href="/">Home</a>';
            echo '</li>';
        }
        if(isset($_SESSION['dx-webinar-and-events-page']) == 'dx-webinar-and-events-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-webinar-and-events">Webinars & Events ';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-webinar-and-events">Webinars & Events </a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-documents-and-quick-links-page']) == 'dx-documents-and-quick-links-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-documents-and-quick-links">Documents & Quick Links';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-documents-and-quick-links">Documents & Quick Links</a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-team-page']) == 'dx-team-page') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-team">The Team';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-team">The Team</a>';
            echo '</li>';
          }

          if(isset($_SESSION['dx-announcements']) == 'dx-announcements') {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger active" href="/dx-announcements">Announcements';
                
              echo '</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
              echo '<a class="nav-link js-scroll-trigger" href="/dx-announcements">Announcements</a>';
            echo '</li>';
          }
    ?>
    </ul>
</nav>