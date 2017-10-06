<?php
/* Template Name: Create Subscription*/

require_once('stripe-php-master/init.php');

$sk_key = (get_option("edit_check_mode")=="Test")? get_option("edit_test_secret_key") : get_option("edit_live_secret_key");


\Stripe\Stripe::setApiKey($sk_key);

//print_r($_REQUEST);
try
{
  $customer = \Stripe\Customer::create(array(
    'email' => $_POST['stripeEmail'],
    'source'  => $_POST['stripeToken'],
    'plan' => get_option("edit_signup_plan")
  ));

  $username = $wpdb->escape(trim($_POST['ttl_stripe_uname']));
  $password = $wpdb->escape(trim($_POST['ttl_stripe_password']));
  $email = $wpdb->escape(trim($_POST['ttl_stripe_email']));

  $user_id = wp_insert_user(
    array(
      'user_login'      =>  $username,
      'display_name'    =>  $username,
      'user_email'      =>  $email,
      'user_pass'       =>  $password,   
      )
    );
  wcgod_autoLoginUser($user_id);
  wp_redirect( home_url() );

  //header('Location: thankyou.html');
  exit;
}
catch(Exception $e)
{

  //header('Location:oops.html');
  error_log("unable to sign up customer:" . $_POST['stripeEmail'].
    ", error:" . $e->getMessage());
}