<?php
  $task_start = "2024-04-18 13:00:00"; // First date
  $task_end = "2024-04-23 16:00:00";   // Second date
  $break_time = 3600;                  // Total break time
  $actual_total_working_hours = 32400; // Total working hours with break time
  $holidays = ['2024-04-22'];          // Set of holiday dates
  $working_days = 0;                   // Total days of acutal working hours
  
  // Use for computing the work days interval
  $task_start_date = new DateTime($task_start); 
  $task_end_date = new DateTime($task_end);
  $interval = $task_start_date -> diff ($task_end_date);
  $total_days = $interval -> days + 1; // Include the start day
  // End
  
  // Loop for getting the day of the week
  for ($i = 0; $i < $total_days; $i++) {
    $currentDate = $task_start_date -> modify ("+1 day");
    $dayOfWeek = $currentDate -> format ('N'); // 1 (Monday) to 7 (Sunday) 
  
    if ($dayOfWeek >= 1 && $dayOfWeek <= 5 && !in_array($currentDate->format('Y-m-d'), $holidays)){
      $working_days++;
    }
  }
  // End
  
  // Use for computing the work hours duration
  $start_timestamp = strtotime($task_start);
  $end_timestamp = strtotime($task_end);
  $total_duration_seconds = $end_timestamp - $start_timestamp;
  if ($total_duration_seconds > $actual_total_working_hours) {
    $total_duration_hours = ($total_duration_seconds - $break_time) / 3600;
  }
  else {
    $total_duration_hours = $total_duration_seconds / 3600; 
  }
  $total_working_hours = min($total_duration_hours, 8 * $working_days);
  // End
  
  // Output
  echo "Total duration: " . number_format($total_working_hours, 2) . " hours\n";
  echo "Total working days: $working_days";
?>