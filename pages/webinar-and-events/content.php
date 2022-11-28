<?php  
    echo '<li class="list-inline-item">';
        
        echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'">';
        echo '<span class="center mt-2" >';
            echo date('F j, Y',strtotime($data['date_set']));
        echo '</span>';  
            echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
            echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
            echo '<h4 datadate="'.$data_date.'"></h4>';
            echo  '<pre style="white-space: normal;display:none;"><b>Host: </b>';
            
            $host_count_handler = 0;
            $hosts = explode(',', $data['webinar_host']);
            foreach($hosts as $host) {
                foreach($users_arr as $user) {
                    if($user['user_employee_id'] == $host) {
                        $hosts_count = count($hosts) - 1;
                        if ($host_count_handler == $hosts_count){
                            echo $user['user_firstname'].' '.$user['user_lastname'];
                            $host_count_handler = 0;
                        } else {
                            if ($host_count_handler == count($hosts)-2){
                                echo $user['user_firstname'].' '.$user['user_lastname'] .' and ';
                                $host_count_handler++;
                            } else {
                                echo $user['user_firstname'].' '.$user['user_lastname'] .', ';
                                $host_count_handler++;

                            }
                        }
                    }
                }
            }
            
            echo ' <br><b>Speaker:</b> ';
            $speakers = explode(',', $data['webinar_speaker']);
            $speaker_count_handler = 0;
            $speakers_arr = count($speakers)-2;
            foreach($speakers as $speaker) {
                foreach($users_arr as $user) {
                    if($user['user_employee_id'] == $speaker) {
                        echo $user['user_firstname'].' '.$user['user_lastname'];
                        $speaker_count_handler++;
                        break;
                    }
                }
                if ($user['user_employee_id'] != $speaker) {
                    echo $speaker;
                    $speaker_count_handler++;
                }

                if ($speaker_count_handler <= $speakers_arr) {
                    echo ', ';
                } else if ($speaker_count_handler == $speakers_arr+1) {
                    echo ' and ';
                }
            }
            echo ' <br><br><b>Description: </b><br>'.$data['webinar_description'].'</pre>';
        echo '</a>';  
    echo '</li>';