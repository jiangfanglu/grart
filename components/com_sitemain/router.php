<?php

defined('_JEXEC') or die;

function SitemainBuildRoute(&$query)
{
       $segments = array();
       if(isset($query['view']))
       {
                $segments[] = $query['view'];
                unset( $query['view'] );
       }
       if(isset($query['id']))
       {
                $segments[] = $query['id'];
                unset( $query['id'] );
       }
       if(isset($query['tmpl']))
       {
                $segments[] = $query['tmpl'];
                unset( $query['tmpl'] );
       }
       if(isset($query['itemid']))
       {
                $segments[] = $query['itemid'];
                unset( $query['itemid'] );
       }
       if(isset($query['c_id']))
       {
                $segments[] = $query['c_id'];
                unset( $query['c_id'] );
       }
       if(isset($query['a_id']))
       {
                $segments[] = $query['a_id'];
                unset( $query['a_id'] );
       }
       return $segments;
}

function SitemainParseRoute($segments){
    $vars = array();
       switch($segments[0])
       {
               case 'usermanager':
                       $vars['view'] = 'usermanager';
                       break;
               case 'upload':
                       $vars['view'] = 'upload';
                       break;
       }
       if(count($segments)==2){
           if(isset($query['c_id']))
           {
               $vars['c_id'] = $segments[1];
           }
       }
       if(count($segments)==3){
           if(isset($query['a_id']))
           {
               $vars['a_id'] = $segments[2];
           }
       }
       return $vars;
}
?>
