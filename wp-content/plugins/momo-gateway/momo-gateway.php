<?php
/**
 * Plugin Name: MOMO Payment Gateway
 * Plugin URI: https://levantoan.com
 * Description: Full integration for momo payment gateway for WooCommerce
 * Version: 1.0.0
 * Author: Lê Văn Toản
 * Author URI: https://levantoan.com
 * Text Domain: momo-gateway
 * Domain Path: /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 3.5.6
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'plugins_loaded', 'init_momo_gateway_class' );

function init_momo_gateway_class() {
    class WC_Gateway_Momo extends WC_Payment_Gateway {

        private $partnerCode;
        private $accessKey;
        private $serectkey;
        private $requestType;
        private $momo_url;
        private $merchantName;
        private $status_order;

        function __construct(){

            $this->id = 'momo';
            $this->method_title = 'Momo.vn';
            $this->has_fields = false;

            $this->init_form_fields();
            $this->init_settings();

            $this->icon = $this->get_option('icon');
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            $this->partnerCode = $this->get_option('partnerCode');
            $this->accessKey = $this->get_option('accessKey');
            $this->serectkey = $this->get_option('serectkey');
            $this->requestType = $this->get_option('requestType');
            $this->momo_url = $this->get_option('momo_url');
            $this->merchantName = $this->get_option('merchantName');
            $this->status_order = $this->get_option('status_order');

            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

            add_action( 'woocommerce_thankyou_momo', array( $this, 'thankyou_page' ) );

            add_filter( 'the_title', array($this, 'woo_personalize_order_received_title'), 10, 2 );
            add_filter('woocommerce_thankyou_order_received_text', array($this, 'woo_change_order_received_text'), 10, 2 );

        }
        function init_form_fields(){
            // Admin fields
            $this -> form_fields = array(
                'enabled' => array(
                    'title' => __('Activate', 'momo-gateway'),
                    'type' => 'checkbox',
                    'label' => __('Activate the payment gateway for momo', 'momo-gateway'),
                    'default' => 'no'
                ),
                'title' => array(
                    'title' => __('Name:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Name of payment method (as the customer sees it)', 'momo-gateway'),
                    'default' => __('Pay with Momo.vn', 'momo-gateway')
                ),
                'description' => array(
                    'title' => __('', 'momo-gateway'),
                    'type' => 'textarea',
                    'description' => __('Payment gateway description', 'momo-gateway'),
                    'default' => __('Click place order and you will be directed to the momo.vn website in order to make payment', 'momo-gateway')
                ),
                'icon' => array(
                    'title' => __('Momo icon:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Default: "https://static.momo.vn/momo.ico"', 'momo-gateway'),
                    'default' => __('https://static.momo.vn/momo.ico', 'momo-gateway')
                ),
                'momo_url' => array(
                    'title' => __('Domain:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Default https://payment.momo.vn', 'momo-gateway'),
                    'default' => __('https://payment.momo.vn', 'momo-gateway')
                ),
                'partnerCode' => array(
                    'title' => __('Partner Code:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Get Partner Code in <a href="https://business.momo.vn/merchant/integrateInfo" target="_blank">here</a>', 'momo-gateway'),
                    'default' => __('', 'momo-gateway')
                ),
                'accessKey' => array(
                    'title' => __('Access Key:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Get Access Key in <a href="https://business.momo.vn/merchant/integrateInfo" target="_blank">here</a>', 'momo-gateway'),
                    'default' => __('', 'momo-gateway')
                ),
                'serectkey' => array(
                    'title' => __('Serect Key:', 'momo-gateway'),
                    'type'=> 'text',
                    'description' => __('Get Serect Key in <a href="https://business.momo.vn/merchant/integrateInfo" target="_blank">here</a>', 'momo-gateway'),
                    'default' => __('', 'momo-gateway')
                ),
                'requestType' => array(
                    'title' => __('Request Type:', 'momo-gateway'),
                    'type'=> 'text',
                    'default' => 'captureMoMoWallet'
                ),
                'merchantName' => array(
                    'title' => __('Merchant Name:', 'momo-gateway'),
                    'type'=> 'text',
                    'default' => get_option('blogname')
                ),
                'status_order' => array(
                    'title' =>  __('Status:', 'momo-gateway'),
                    'type' => 'select',
                    'options' => wc_get_order_statuses(),
                    'description' => __('Order status after pay', 'momo-gateway'),
                    'default' => 'wc-received-payment'
                ),
            );
        }
        function process_payment( $order_id ) {
            global $woocommerce;
            $order = new WC_Order( $order_id );

            $data = array(
                'amount'    =>  strval($order->get_total()),
                'orderId'   =>  strval($order->get_id()),
                'returnUrl' =>  $this->get_return_url( $order ),
                'notifyUrl' =>  $this->get_return_url( $order ),
                //'notifyUrl' =>  admin_url('admin-ajax.php?action=momo_ipn_notifyurl'),
                'orderInfo' =>  sprintf('Bill payment No. %s', $order->get_id()),
                'extraData' =>  'merchantName='.$this->merchantName,
            );

            $checkoutUrl = $this->momo_payUrl($data);


            // Mark as on-hold (we're awaiting the cheque)
            //$order->update_status('pending', __( 'Awaiting cheque payment', 'woocommerce' ));

            // Reduce stock levels
            $order->reduce_order_stock();

            // Remove cart
            $woocommerce->cart->empty_cart();

            if($checkoutUrl){
                return array(
                    'result' => 'success',
                    'redirect' => $checkoutUrl
                );
            }else{
                return array(
                    'result' => 'success',
                );
            }

        }
        function momo_payUrl($data){
            $arg_param = wp_parse_args($data, array(
               'partnerCode' => $this->partnerCode,
               'accessKey' => $this->accessKey,
               'requestId' => time() . "",
               'amount' => '', // >1.000đ and < 20.000.000đ
               'orderId' => '',
               'orderInfo' => '',
               'returnUrl' => '',
               'notifyUrl' => '',
               'extraData' => '',
               'requestType' => $this->requestType,
               'signature' => '',
            ));

            extract($arg_param);

            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyUrl . "&extraData=" . $extraData;
            $arg_param['signature'] = hash_hmac("sha256", $rawHash, $this->serectkey);

            $response = wp_remote_post($this->momo_url . '/gw_payment/transactionProcessor', array(
                'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
                'body'        => json_encode($arg_param),
            ));

            $response_code = wp_remote_retrieve_response_code( $response );
            //print_r($response);

            if ( !is_wp_error( $response ) && $response_code == 200) {
                $body = json_decode(wp_remote_retrieve_body($response), true);
                //print_r($body);
                if(isset($body['errorCode']) && $body['errorCode'] == 0){
                    $payUrl = (isset($body['payUrl']) && $body['payUrl']) ? $body['payUrl'] : '';
                    if($payUrl) return $payUrl;
                }
            }
            return false;
        }
        function thankyou_page( $order_id ) {

            global $woocommerce;
            $order = wc_get_order( $order_id );

            $new_status = ($this->status_order) ? $this->status_order : 'received-payment';

            if($order->get_status() == $new_status) return;

            $partnerCode = isset($_REQUEST['partnerCode']) ? wc_clean($_REQUEST['partnerCode']) : '';
            $accessKey = isset($_REQUEST['accessKey']) ? wc_clean($_REQUEST['accessKey']) : '';
            $requestId = isset($_REQUEST['requestId']) ? wc_clean($_REQUEST['requestId']) : '';
            $amount = isset($_REQUEST['amount']) ? wc_clean($_REQUEST['amount']) : '';
            $orderId = isset($_REQUEST['orderId']) ? wc_clean($_REQUEST['orderId']) : '';
            $orderInfo = isset($_REQUEST['orderInfo']) ? wc_clean($_REQUEST['orderInfo']) : '';
            $orderType = isset($_REQUEST['orderType']) ? wc_clean($_REQUEST['orderType']) : '';
            $transId = isset($_REQUEST['transId']) ? wc_clean($_REQUEST['transId']) : '';
            $errorCode = isset($_REQUEST['errorCode']) ? wc_clean($_REQUEST['errorCode']) : '';
            $message = isset($_REQUEST['message']) ? wc_clean($_REQUEST['message']) : '';
            $localMessage = isset($_REQUEST['localMessage']) ? wc_clean($_REQUEST['localMessage']) : '';
            $payType = isset($_REQUEST['payType']) ? wc_clean($_REQUEST['payType']) : '';
            $responseTime = isset($_REQUEST['responseTime']) ? wc_clean($_REQUEST['responseTime']) : '';
            $extraData = isset($_REQUEST['extraData']) ? wc_clean($_REQUEST['extraData']) : '';
            $signature = isset($_REQUEST['signature']) ? wc_clean($_REQUEST['signature']) : '';

            /*$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
                "POST " . json_encode($_POST).PHP_EOL.
                "GET " . json_encode($_GET).PHP_EOL.
                "REQUEST " .json_encode($_REQUEST).PHP_EOL.
                "-------------------------".PHP_EOL;

            file_put_contents( dirname(__FILE__) . '/log_start_'.date("j.n.Y").'.txt', $log, FILE_APPEND);*/

            if($errorCode == 0) {
                $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&orderType=$orderType&transId=$transId&message=$message&localMessage=$localMessage&responseTime=$responseTime&errorCode=$errorCode&payType=$payType&extraData=$extraData";
                if ($signature == hash_hmac("sha256", $rawHash, $this->serectkey)) {
                    $order->update_status($new_status);
                    $woocommerce->cart->empty_cart();
                    unset($_SESSION['order_awaiting_payment']);
                    if(is_user_logged_in()) {
                        echo '<script type="text/javascript">
                        <!--
                        setTimeout(function() {
                          window.location = "' . $order->get_view_order_url() . '"
                        }, 2000);
                        //-->
                        </script>';
                    }
                }
            }

        }

        function woo_personalize_order_received_title( $title, $id ) {
            if ( is_order_received_page() && get_the_ID() === $id ) {
                global $wp;
                $order_id  = apply_filters( 'woocommerce_thankyou_order_id', absint( $wp->query_vars['order-received'] ) );
                $order_key = apply_filters( 'woocommerce_thankyou_order_key', empty( $_GET['key'] ) ? '' : wc_clean( $_GET['key'] ) );
                $errorCode = isset($_GET['errorCode']) ? wc_clean($_GET['errorCode']) : '';

                if ( $order_id > 0 ) {
                    $order = wc_get_order( $order_id );
                    if ( $order->get_order_key() != $order_key ) {
                        $order = false;
                    }
                }
                if ( isset ( $order ) && $errorCode == 0 ) {
                    $title = __('Đơn hàng đã được thanh toán THÀNH CÔNG!', 'momo-gateway');
                }
            }
            return $title;
        }

        function woo_change_order_received_text( $str, $order ) {
            $errorCode = isset($_GET['errorCode']) ? wc_clean($_GET['errorCode']) : '';
            if(is_user_logged_in() && $order->get_payment_method() == $this->id && $errorCode == 0 && $order->get_status() != $this->status_order) {
                $str = __('Cảm ơn bạn. Chúng tôi sẽ chuyển bạn đến chi tiết đơn hàng sau 2 giây.', 'momo-gateway');
            }elseif($order->get_payment_method() == $this->id && $errorCode == 0) {
                $str = __('Cảm ơn bạn. Đơn hàng của bạn đã được thanh toán.', 'momo-gateway');
            }
            return $str;
        }

    }
}


function add_momo_gateway_class( $methods ) {
    $methods[] = 'WC_Gateway_Momo';
    return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'add_momo_gateway_class' );

add_action( 'plugins_loaded', 'momo_load_textdomain' );
function momo_load_textdomain() {
    load_textdomain('momo-gateway', dirname(__FILE__) . '/languages/momo-gateway-' . get_locale() . '.mo');
}


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'momo_add_action_links', 10, 2 );
function momo_add_action_links($links, $file)
{
    if (strpos($file, 'momo-gateway.php') !== false) {
        $settings_link = '<a href="' . admin_url('admin.php?page=wc-settings&tab=checkout&section=momo') . '" title="' . __('Settings', 'momo-gateway') . '">' . __('Settings', 'momo-gateway') . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

//Add new status
function register_received_payment_order_status() {
    register_post_status( 'wc-received-payment', array(
        'label'                     => 'Đã thanh toán',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Đã thanh toán <span class="count">(%s)</span>', 'Đã thanh toán <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_received_payment_order_status' );
// Add to list of WC Order statuses
function add_received_payment_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-on-hold' === $key ) {
            $new_order_statuses['wc-received-payment'] = 'Đã thanh toán';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_received_payment_to_order_statuses' );

//add_action( 'wp_ajax_momo_ipn_notifyurl', 'momo_ipn_notifyurl_func' );
//add_action( 'wp_ajax_nopriv_momo_ipn_notifyurl', 'momo_ipn_notifyurl_func' );
function momo_ipn_notifyurl_func(){

    $POST = json_decode(file_get_contents('php://input'), true);

    if (isset($_POST) && empty($_POST)) {
        $_POST = $POST;
    }
    $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        json_encode($_POST).PHP_EOL.
        json_encode($_GET).PHP_EOL.
        "-------------------------".PHP_EOL;

    file_put_contents( dirname(__FILE__) . '/log_start_'.date("j.n.Y").'.txt', $log, FILE_APPEND);

    $orderid = isset($_POST['orderId']) ? intval($_POST['orderId']) : '';

    if($orderid) {
        $order = wc_get_order($orderid);
        if(!is_wp_error($order)) {

            $momo_setting = get_option('woocommerce_momo_settings');
            $status_order = 'received-payment';
            if($momo_setting && is_array($momo_setting)){
                $status_order = isset($momo_setting['status_order']) ? $momo_setting['status_order'] : 'received-payment';
            }

            $new_status = $status_order;

            if($order->get_status() != $new_status && $order->get_status() != 'completed') {

                $partnerCode = isset($_POST['partnerCode']) ? wc_clean($_POST['partnerCode']) : '';
                $accessKey = isset($_POST['accessKey']) ? wc_clean($_POST['accessKey']) : '';
                $requestId = isset($_POST['requestId']) ? wc_clean($_POST['requestId']) : '';
                $amount = isset($_POST['amount']) ? wc_clean($_POST['amount']) : '';
                $orderId = isset($_POST['orderId']) ? wc_clean($_POST['orderId']) : '';
                $orderInfo = isset($_POST['orderInfo']) ? wc_clean($_POST['orderInfo']) : '';
                $orderType = isset($_POST['orderType']) ? wc_clean($_POST['orderType']) : '';
                $transId = isset($_POST['transId']) ? wc_clean($_POST['transId']) : '';
                $errorCode = isset($_POST['errorCode']) ? wc_clean($_POST['errorCode']) : '';
                $message = isset($_POST['message']) ? wc_clean($_POST['message']) : '';
                $localMessage = isset($_POST['localMessage']) ? wc_clean($_POST['localMessage']) : '';
                $payType = isset($_POST['payType']) ? wc_clean($_POST['payType']) : '';
                $responseTime = isset($_POST['responseTime']) ? wc_clean($_POST['responseTime']) : '';
                $extraData = isset($_POST['extraData']) ? wc_clean($_POST['extraData']) : '';
                $signature = isset($_POST['signature']) ? wc_clean($_POST['signature']) : '';

                if ($errorCode == 0) {
                    $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&orderType=$orderType&transId=$transId&message=$message&localMessage=$localMessage&responseTime=$responseTime&errorCode=$errorCode&payType=$payType&extraData=$extraData";
                    if ($signature == hash_hmac("sha256", $rawHash, $this->serectkey)) {
                        $order->update_status($new_status);
                        wp_send_json_success($orderId, 200);
                    }
                }
            }
        }
    }
    wp_send_json_error($orderid, 500);
    die();
    
}