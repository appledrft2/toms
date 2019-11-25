<!-- fullCalendar -->
<script src="<?php echo $baseurl; ?>bower_components/moment/moment.js"></script>
<script src="<?php echo $baseurl; ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript">
    /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()


        $('#calendar').fullCalendar({
          header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
          },
          //Random default events
          events    : [
          <?php 

          $sql = "SELECT t_travel_order.id,teacher.firstname,teacher.lastname,teacher.position,teacher.department,t_travel_order.destination,t_travel_order.departure,t_travel_order.dreturn,t_travel_order.purpose,t_travel_order.status,t_travel_order.created_at FROM t_travel_order LEFT JOIN teacher ON t_travel_order.teacher_id = teacher.id WHERE t_travel_order.status = 'Approved';";
            $qry = $connection->prepare($sql);
            $qry->execute();
            $qry->bind_result($id,$dbf,$dbl, $dbp, $dbd,$dbdes,$dbdep,$dbret, $dbpor,$dbstat,$dbcre);
            $qry->store_result();
            while($qry->fetch ()) {
              
            
           ?>
              {
                title          : '<?php echo "Teacher: ".$dbf." ".$dbl.",".$dbp." ".$dbd." - ".$dbpor ?>',
                start          : new Date('<?php echo $dbdep; ?>'),
                end          : new Date('<?php echo $dbret; ?>'),
                allDay  :true,
                backgroundColor: '#0073b7', 
                borderColor    : '#0073b7' 
              },
      <?php } ?>

        <?php 

          $sql = "SELECT s_travel_order.id,student.firstname,student.lastname,student.department,s_travel_order.destination,s_travel_order.departure,s_travel_order.dreturn,s_travel_order.purpose,s_travel_order.status,s_travel_order.created_at FROM s_travel_order LEFT JOIN student ON s_travel_order.student_id = student.id WHERE s_travel_order.status = 'Approved';";
          $qry = $connection->prepare($sql);
          $qry->execute();
          $qry->bind_result($id,$dbf,$dbl, $dbd,$dbdes,$dbdep,$dbret, $dbpor,$dbstat,$dbcre);
          $qry->store_result();
          while($qry->fetch ()) {
              
            
           ?>
              {
                title          : '<?php echo "Student: ".$dbf." ".$dbl.", ".$dbd." - ".$dbpor ?>',
                start          : new Date('<?php echo $dbdep; ?>'),
                end          : new Date('<?php echo $dbret; ?>'),
                allDay  :true,
                backgroundColor: '#00a65a ', 
                borderColor    : '#00a65a ' 
              },
      <?php } ?>

          ],
          editable  : true,
          droppable : false, // this allows things to be dropped onto the calendar !!!
          drop      : function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject')

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject)

            // assign it the date that was reported
            copiedEventObject.start           = date
            copiedEventObject.allDay          = allDay
            copiedEventObject.backgroundColor = $(this).css('background-color')
            copiedEventObject.borderColor     = $(this).css('border-color')

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove()
            }

          }
        })

  </script>