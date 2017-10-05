<?php
/* Template Name: Create Subscription*/

require_once('stripe-php-master/init.php');

\Stripe\Stripe::setApiKey("sk_test_RCEAoh9CEbMs3MPtRFeHB66v");

//print_r($_REQUEST);
try
{
  $customer = \Stripe\Customer::create(array(
    'email' => $_POST['stripeEmail'],
    'source'  => $_POST['stripeToken'],
    'plan' => 'monthly_plan'
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