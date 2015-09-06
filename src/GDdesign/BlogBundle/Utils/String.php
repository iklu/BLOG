<?php
namespace GDdesign\PageBundle\Utils;
#####################################################################################################
#
#
#
#
#
#
#
#
#
#####################################################################################################
class String 
{
     private $salt_length=5;
     public function cutString($text, $longitud, $html=true){
             $final='';
             $total=0;     
             foreach(explode(' ', $text) as $word){
                    if($word != ''){
                       $final.=' '.$word;
                       $total+=strlen($word);
                    }
                    
                    if($total>=$longitud){
                      
                       $final.= "...";                       
                       $tags_apertura = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\a]+[^>]*[^/]>)(?!/>))%";                       
                       $tags_cierre = "|</([a-zA-Z]+)>|";
                       
                       preg_match_all($tags_apertura, $final, $aBuffer);
                         
                          if(!empty($aBuffer[1])){
                            
                             preg_match_all($tags_cierre, $final, $aBuffer2);
                            
                             if(count($aBuffer[1]) != count($aBuffer2[1])){
                                  
                                $aBuffer[1] = array_reverse($aBuffer[1]);
                                 
                                
                                 foreach($aBuffer[1] as $index=>$tag){
                                         if(empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag){
                                            $final.='</'.$tag.'>';
                                         }   
                                 }
                             }
                          }
                       
                        break;
                      } 
                    }
           return $final;     
           }                  

     public function cryptString($str, $modo='md5'){
            if(in_array($modo, hash_algos())){
               $out=hash($modo, $str);
            
               return $out;
            }else{
               return "error algoritmo no suportado";
            }
     }          
     public function encodeString($str, $modo='md5'){
            $salt = substr(uniqid(rand(), true),0,$this->salt_length);
            if(in_array($modo, hash_algos())){
               $out = hash($modo, $salt.$str);
               return $this->salt_length.$out.$salt;
            }else{
               return "error algoritmo no suportado";
            }
    }
    
    ########################################################################
    ####first : hash = extracted length[db] + hash(extracted salt[db] + introduced password)
    ####second : compare = hash==hash[db]################################### 
     public function extractHash($str){
            $arrHash['length']=substr($str,0,1);
            $arrHash['hash']=substr($str,1,strlen($str)-($arrHash['length']+1));
            $arrHash['salt']=str_replace($arrHash['hash'], '', substr($str,1));
            return $arrHash;
     }
     public function randomString($longitud=8){
            $caracteresValidos = array('a' , 'b' , 'c' , 'd' , 'e' , 'f' , 'g' , 'h' , 'i' 
                                       , 'j' , 'k' , 'l' , 'm' , 'n' , 'o' , 'p' , 'q' , 'r'
                                        , 's' , 't' , 'u' , 'v' , 'x' , 'y' , 'z' , 'A' , 'B' ,
                                         'C' , 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J' , 'K' ,
                                          'L' , 'M' , 'N' , 'O' , 'P' , 'Q' , 'R' , 'S' , 'T' ,
                                           'U' , 'V' , 'X' , 'Y' , 'Z' , '.' , '/' , '$' , '!' ,
                                            '@' , '#' , '%' , '(' , ')' , '&' , ':' , '\\'
                                             , '=' , '+' , '[' , ']' , '{' , '}' ,
                                              ';' , '^' , '-' , '_' , '0' , '1' , 
                                              '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9', '?');
           $i=0;
           $rStr = "";
           while($i<$longitud){
                shuffle($caracteresValidos);
                $rand_s = mt_rand(0, count($caracteresValidos)-1);
                $caracter = $caracteresValidos[$rand_s];
                if(!strstr($rStr, $caracter)){
                   $rStr.=$caracter;
                   $i++;
                   }
           }
           return $rStr;
     }
     public function powerPass($str){
            $seguridad = 0;
            $uno=1;
            if(strlen($str)>=8){
               $seguridad++;
            }
            if(strlen($str)>=16){
               $seguridad++;
            }
            if(strtoupper($str)!=$str){
               $seguridad++;
            }
            preg_match_all('/[!@#$%&*\/=?,;.:\-_+^\\\]/' , $str, $simbolos);
            $seguridad+=sizeof($simbolos[0]);
            $unicos=sizeof(array_unique(str_split($str)));
            $seguridad+=$unicos;
            $arrStr = str_split($str);
            $consec = 0;
            for($i=1; $i<count($arrStr); $i++){
                $menos=$i-1;
                if($arrStr[$menos] == $arrStr[$i]){
                   $consec++;
                }
            }
            $seguridad = $seguridad - $consec;
            return $seguridad;
    }                
                                                                                 

}//final cls 



?> 
