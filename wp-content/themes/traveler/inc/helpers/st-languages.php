<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/9/15
 * Time: 10:22 AM
 */
if(!class_exists('STLanguage'))
{
    if(!function_exists('stlang_get_language_default'))
    {
        function stlang_get_language_default()
        {
            $language = get_option('st_language');
            $file =get_template_directory().'/language/'.$language.'/config.php';
            $file = str_ireplace('\\','/',$file);
            if(is_file($file)){
                return $language;
            }else{
                return 'english';
            }
        }
    }

    if(!function_exists('stlang_load_list_modun'))
    {
        function stlang_load_list_modun($language)
        {
            $list = array();

            $dir_english = get_template_directory().'/language/english/modun/';
            $dir_english = str_ireplace('\\','/',$dir_english);
            $files_english = scandir($dir_english);
            if(!empty($files_english)){
                foreach($files_english as $k=>$v){
                    $dir = get_template_directory().'/language/'.$language.'/modun/'.$v;
                    $dir = str_ireplace('\\','/',$dir);
                    if(file_exists($dir) and $v != "." and $v != ".."){
                        $name = $v;
                        $file = $dir;
                        array_push($list , array(
                            'name'=>$name,
                            'url'=>$file
                        ));
                    }else{
                        $file_english = get_template_directory().'/language/english/modun/'.$v;
                        if(is_file($file_english) ){
                            copy($file_english , $dir);
                            $name = $v;
                            $file = $dir;
                            array_push($list , array(
                                'name'=>$name,
                                'url'=>$file
                            ));
                        }
                    }
                }
            }
            return $list;
        }
    }
    if(!function_exists('stlang_load_language'))
    {
        function stlang_load_language()
        {
            global $st_language;
            $language = stlang_get_language_default();
            $list_modun = stlang_load_list_modun($language);
            if(!empty($list_modun)){
                foreach($list_modun as $k=>$v){
                    include $v['url'];
                    if(!empty($lang)){
                        foreach($lang  as $key => $value ){
                            $st_language[$key]=$value;
                        }
                    }
                }
            }
        }

    }

    // Init Language front end without plugins
    stlang_load_language();


}