<?php
include_once($basepath."bdd/Connection.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author DELL
 */
class Profile extends Connection{
    
    public static function getProfileById($profile_id){
        $connection = Connection::getConnection();
        $sql_query = "SELECT * FROM profile WHERE id = ".$profile_id;
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
             return $result->fetch_object();   
        }else{
            return false;
        }            
    }
    
    public function verifiedURLActionPermission($profile_id, $url){

        $connection = Connection::getConnection();
        $sql_query = "SELECT * FROM action as a JOIN profile_action as pa ON a.id = pa.action_id "
                . "WHERE pa.profile_id = $profile_id AND a.url LIKE '$url'";
        
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }            
    }
    
    public function getActionsTreeByProfile($profile_id,$parent_id = NULL){
        if($parent_id == NULL){
            $parent_id = " IS NULL";
        }else{
            $parent_id = " = $parent_id";
        }
        $connection = Connection::getConnection();
        $sql_query = "SELECT * FROM action as a JOIN profile_action as pa ON a.id = pa.action_id "
                . "WHERE a.visible=1 AND pa.profile_id = $profile_id AND a.parent_id ".$parent_id;
        
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
            while($row = $result->fetch_object()) {
                $actions[] = $row; 
            }
            return $actions;
        }else{
            echo $connection->error;
            return false;
        }            
    }
    
    
    public function getMenu($option = NULL, $profile) {

        //get actions by profile
        $this_level_items = $this->getActionTreeByProfile($option, $profile);

        $cont = 1;
        $result = '';
        if ($this_level_items != false) {//if exist this level
            foreach ($this_level_items as $current_item) {
                //load a different size when  action name is short or long
                $style = (strlen($current_item->menu_name) > 15 ) ? "style='padding-top:8px;'" : "style='padding-top:15px;'";
                $style="";
                $result .= "<li class='" . $cont ."'   ><a style='width: 177px;' href=\"";
                if ($current_item->url != '#')
                    $result .= $current_item->url;
                else
                    $result .= '#';
                $result .= "\"" . $style . ">" . utf8_encode($current_item->menu_name) . "</a>";
                $next = $this->getMenu($current_item->id, $profile);
                if ($next != '') {
                    $result .= "<ul>" . $next . "</ul>";
                }
                $result .= "</li>";
                $cont++;
            }
        }
        else
            return $result;
        return $result . "\n";
    }

    /*
     * get actions by logged profile
     */
    public function getActionTreeByProfile($parent_id,$profile_id)
    {
        //control to parent actions
        $actions=$this->getActionsTreeByProfile($profile_id,$parent_id);

        //result
        if ($actions)
        {
            return $actions;
        }
        else
        {
            return false;
        }
    }
    
    /*
     * Construye las opciones del combo box de la lista de Perfiles con su id de valor
     */
    public function getComboBoxOptionsOfProfiles($selected = NULL){
        $html_options = "";
        $connection = Connection::getConnection();
        $sql_query = "SELECT id, name FROM profile";
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
            while($row = $result->fetch_object()) {
                if($selected == $row->id){
                    $html_options = $html_options."<option selected=selected id='$row->name' value='$row->id'>$row->name</option>";                      
                }else{
                    $html_options = $html_options."<option id='$row->name' value='$row->id'>$row->name</option>";  
                }
            }
        }
        
        return $html_options;
    }

}
