<?php
/*
   Plugin Name: CoolCoin
   Plugin URI: https://www.example.com
   Description: This is an exmaple or testing Purpose plugin
   Version: 4.1.9
   Author: SpeedWrk
   Author URI: https://automattic.com/wordpress-plugins/
   License: GPLv2 or later
   Text Domain:  CoinTag
*/

if(!class_exists('CryptoData')):

     class CryptoData{
          
          function __construct(){
               add_shortcode('crypto-data', array( $this , 'crypto_shortcodeback'));
               add_action( 'wp_enqueue_scripts',  array($this , 'crypto_enqueue_file'));
               add_action('wp_ajax_datatables_endpoint', array($this , 'my_custom_ajax_endpoint')); 
          }

          public function my_custom_ajax_endpoint(){

            
          wp_send_json($response);
          // echo $response;
     }

          public function crypto_enqueue_file(){

               // Data table Enqueue
               wp_register_style('jquery-datatables-css','https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css');
               wp_enqueue_style('jquery-datatables-css');

               wp_register_script('jquery-datatables-js','https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',array('jquery'), true);
               wp_enqueue_script('jquery-datatables-js');

               
               wp_register_script('ajax-script', plugins_url('js/myjquery.js', __FILE__ ), array( 'jquery' ),'1.0.0',true);
               wp_enqueue_script( 'ajax-script');
               
               wp_localize_script(
                    'ajax-script',
                    'my_ajax_obj',
                    array(
                       'ajax_url' => admin_url( 'admin-ajax.php' ),
                    //    'nonce'    => wp_create_nonce('text_example')
                    )
                 );
             

          }
        

          public function crypto_shortcodeback($args){

               
               $args = shortcode_atts(array(
                    'limit'=> ''
               ),$args,'crypto-data');

               $content = "<table id='example'>
               <thead>
                   <th>ID</th>
                   <th>Title</th>
               </thead>
                <tbody>
          

               
                </tbody>
               </table>";
               

               
              
               return $content;
          }





     }



endif;
$obj = new CryptoData();
