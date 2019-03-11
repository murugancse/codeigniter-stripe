<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class StripeController extends CI_Controller {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
    }
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('my_stripe');
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
		
		$customer = \Stripe\Customer::create([
			  'email' => 'murugancse1994@gmail.com',
			  'source' => $this->input->post('stripeToken'),
		  ]);
     
        \Stripe\Charge::create ([
				'customer' => $customer->id,
                "amount" => 100,
                "currency" => "usd",
                "description" => "Test payment." 
        ]);
            
        $this->session->set_flashdata('success', 'Payment made successfully.');
             
        redirect(base_url().'my-stripe', 'refresh');
    }
}