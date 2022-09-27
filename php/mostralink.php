<?php
function MontarLink ($texto)
    {
           if (!is_string ($texto))
               return $texto;
 
        $er = "/((http|https|ftp|ftps):\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
        preg_match_all ($er, $texto, $match);
 
        foreach ($match[0] as $link)
        {
            //coloca o 'http://' caso o link não o possua
            if(stristr($link, "http://") === false && stristr($link, "https://") === false)
            {
                $link_completo = "http://" . $link;
            }else{
                $link_completo = $link;
            }
             
            $link_len = strlen ($link);
 
            //troca "&" por "&", tornando o link válido pela W3C
           $web_link = str_replace ("&", "&amp;", $link_completo);
           $texto = str_ireplace ($link, "<a href=\"" . $web_link . "\" target=\"_blank\">". (($link_len > 60) ? substr ($web_link, 0, 25). "...". substr ($web_link, -15) : $web_link) ."</a>", $texto);
            
        }
        return $texto;
    }
    ?>