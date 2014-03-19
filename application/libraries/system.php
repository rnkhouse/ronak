<?php
class SYSTEM
{
    
    public function container($data,$view_type='ECHO'){
    
          $return = '';
        
          $this->CI =& get_instance();
          $return .= $this->CI->load->view('system/header','',TRUE);
          $return .= $this->CI->load->view('system/navigation','',TRUE);
          $return .= $this->CI->load->view('system/main_container','',TRUE);
         
          #  LOAD THE TYPE OF VIEW YOU WANT TO SHOW THE DATA
          if(is_array($data)){
            switch(strtoupper($view_type))
            {
                case 'PRINT_R'  : print_r($data); break;
                case 'PRINT_R!' : echo'<pre>'; print_r($data); echo '</pre>'; break;
                default         : print_r($data);     break;
            }
          }
          else{ 
               $return .= $data;
              }
            
            $return .= $this->CI->load->view('system/main_container_close',NULL,TRUE);
            $return .=  $this->CI->load->view('system/footer',NULL,TRUE);
            
            echo $return;
    }
}
?>
