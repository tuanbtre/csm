<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>      
   </head>
   <body>
      <center>
         @switch($ext)
            @case("mp4")
               <video class="video-fluid" width="100%" controls autoplay loop muted>
                  <source src="{!!request()->fn!!}" type="video/mp4" />
               </video>
               @break
            @case("mp3")
               <audio class="video-fluid" controls>
                  <source src="{!!request()->fn!!}" type="audio/mpeg">
               </audio>
               @break
            @case("pdf")
               <embed id="pdf" src="{!!request()->fn!!}" type="application/pdf" width="100%" height="600px"/>
               @break    
            @default
               <img id="pix01" border="0" src="{!!request()->fn!!}" width="100%" hspace="0" vspace="0" alt="Close">
         @endswitch
      </center>
   </body>
</html>