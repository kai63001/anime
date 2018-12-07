
<?php  echo slaap(0.5); ?> 

<?php 
function slaap($seconds) 
{ 
    $seconds = abs($seconds); 
    if ($seconds < 1): 
     echo "asd"; usleep($seconds*1000000); 
    else: 
     echo  sleep($seconds); 
     echo "asd";

    endif;    
} 
?>
asds