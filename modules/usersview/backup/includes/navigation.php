<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <!-- <a class="navbar-brand js-scroll-trigger" href="#">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="/assets/img/dxInfo-logo-img01.png" alt="DX Info Hub" />
        <span class="d-block d-lg-none">DX Info Hub</span>
    </a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
            <?php  
            if(isset($_SESSION['dx-home-page']) == 'dx-home-page') {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="http://infohub.tcapdmwis.com/">Home Page</a></li>';
            } else {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/">Home Page</a></li>';
            }

            if(isset($_SESSION['dx-webinar-and-events-page']) == 'dx-webinar-and-events-page') {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="/dx-webinar-and-events">Webinars & Events</a></li>';
            } else {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/dx-webinar-and-events">Webinars & Events</a></li>';
            }

            //announcemment
            
            if(isset($_SESSION['dx-documents-and-quick-links-page']) == 'dx-documents-and-quick-links-page') {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="/dx-documents-and-quick-links">Documents and Quick Links</a></li>';
            } else {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/dx-documents-and-quick-links">Documents and Quick Links</a></li>';
            }
            if(isset($_SESSION['dx-team-page']) == 'dx-team-page') {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="/dx-team">The Team</a></li>';
            } else {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/dx-team">The Team</a></li>';
            }

            if(isset($_SESSION['dx-announcements']) == 'dx-announcements') {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="/dx-announcements">Announcements</a></li>';
            } else {
                echo ' <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/dx-announcements">Announcements</a></li>';
            }
            ?>
           
        </ul>
    </div>
</nav>