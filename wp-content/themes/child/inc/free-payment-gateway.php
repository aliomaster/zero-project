<?php

// Add Free Payment Gateway

class WC_WITHOUTGATEWAY extends WC_Payment_Gateway {
	public function __construct() {

		$plugin_dir = plugin_dir_url(__FILE__);

		global $woocommerce;

		$this->id = 'WithOut';
		$this->has_fields = false;
		$this->init_form_fields();
		$this->init_settings();
		$this->title = $this->settings['title'];
		$this->description = $this->settings['description'];
		$this->instructions = $this->settings['instructions'];
		if ($this->debug == 'yes') {
			$this->log = $woocommerce->logger();
		}
		add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
		add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
	}

	// Appearance page of the Payment Gateway

	public function admin_options() {
	?>
		<h3><?php _e('WithOut', 'woocommerce'); ?></h3>
		<p>
			<?php _e('Free Settings', 'woocommerce'); ?></p>
		<table class="form-table">
			<?php
				// creating html settings
				$this -> generate_settings_html();
			?>
		</table>
		<!--/.form-table-->

		<?php
	}

	// End admin_options()

	// html options fields
	function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title' => __('On/Off', 'woocommerce'),
				'type' => 'checkbox',
				'label' => __('On', 'woocommerce'),
				'default' => 'yes'
			),
			'title' => array(
				'title' => __('Name', 'woocommerce'),
				'type' => 'text',
				'description' => __('This is the name that the user sees during checkout.', 'woocommerce'),
				'default' => __('Without', 'woocommerce')
			),
			'without_succes' => array(
				'title' => __('Page for redirect', 'woocommerce'),
				'type' => 'select',
				'options' => $this->get_pages('Select the page...'),
				'description' => "On this page the buyer gets after order confirmation, your page can be arranged to your liking"
			),
			'without_сonfirm' => array(
				'title' => __('disable confirmation', 'woocommerce'),
				'type' => 'checkbox',
				'label' => __('Disconnect the order confirmation page. If daw set - after choosing this method of payment, the buyer will be immediately taken to a page of your choice in the option "redirect page"', 'woocommerce'),
				'default' => 'no'
			),
			'debug' => array(
				'title' => __('Logging mode', 'woocommerce'),
				'type' => 'checkbox',
				'label' => __('Add logging (<code>woocommerce/logs/without.txt</code>)', 'woocommerce'),
				'default' => 'no'
			),
			'description' => array(
				'title' => __('Description', 'woocommerce'),
				'type' => 'textarea',
				'description' => __('Free method of pay', 'woocommerce'),
				'default' => 'Free'
			)
		);
	}

	// Button order confirmation
	public function generate_form($order_id) {
		global $woocommerce;

		$order = new WC_Order($order_id);

		if ($this->testmode == 'yes') {
				$action_adr = $this->testurl;
		} else {
				$action_adr = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
		$payu_args = array(
			'amount' => $order->order_total,
			'productinfo' => $productinfo,
			'firstname' => $order->billing_first_name,
			'lastname' => $order->billing_last_name,
			'address1' => $order->billing_address_1,
			'address2' => $order->billing_address_2,
			'city' => $order->billing_city,
			'state' => $order->billing_state,
			'country' => $order->billing_country,
			'zipcode' => $order->billing_zip,
			'email' => $order->billing_email,
			'phone' => $order->billing_phone,
			'surl' => $action_adr,
			'furl' => $action_adr,
			'curl' => $action_adr,
			'InvId' => $order_id, // order ID
		);
		$payu_args_array = array();
		foreach ($payu_args as $key => $value) {
			$payu_args_array[] = '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" />';
		}

		return '<form action="' . esc_url($action_adr) . '" method="POST">' . "\n" . implode("\n", $payu_args_array) . '<input type="submit" class="button alt" name="without_pay" value="' . __('Confirm order', 'woocommerce') . '" /><a class="button cancel" href="' . $order->get_cancel_order_url() . '">' . __('Refuse and return to Cart', 'woocommerce') . '</a>' . "\n" . '</form>';
	}

	//Triggers after selecting payment page input customer data
	function process_payment($order_id) {
		$order = new WC_Order($order_id);
		return array(
			'result' => 'success',
			'redirect' => add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay'))))
		);
	}

	// Order confirmation page
	function receipt_page($order_id) {
		$order = new WC_Order($order_id);
		global $woocommerce;

		if ($this->settings['without_сonfirm'] == 'yes') { // If the tick is set, skipping order confirmation page
			$woocommerce->cart->empty_cart();
			$action_adr = get_permalink($this->settings['without_succes']);
			$this->updateStatus($order_id);
			wp_redirect($action_adr);
		} else {
			echo '<p>' . __('Thanks for your order!', 'woocommerce') . '</p>';
			echo $this->generate_form($order_id); // Buttons and others
			if ( isset( $_POST['without_pay'] ) ) {
				$woocommerce -> cart -> empty_cart();
				$action_adr = get_permalink($this->settings['without_succes']);
				$this -> updateStatus();
				wp_redirect($action_adr);
			}
		}
	}

	// Changing the status of an order
	function updateStatus($order_id = null) {
		global $woocommerce;
		if (!empty($_POST['InvId'])) {
				$inv_id = $_POST['InvId'];
		} else {
			$inv_id = $order_id;
		}
		$order = new WC_Order($inv_id);
		$order->update_status('completed', __('Payment successfully!', 'woocommerce'));
	}

	// Pages of site
	function get_pages($title = false, $indent = true) {
		$wp_pages = get_pages('sort_column=menu_order');
		$page_list = array();
		if ($title) {
			$page_list[] = $title;
		}
		foreach ($wp_pages as $page) {
			$prefix = '';

			// Show indented child pages?
			if ($indent) {
				$has_parent = $page->post_parent;
				while ($has_parent) {
					$prefix .= ' - ';
					$next_page = get_page($has_parent);
					$has_parent = $next_page->post_parent;
				}
			}

			// Add to page list array array
			$page_list[$page->ID] = $prefix . $page->post_title;
		}
		return $page_list;
	}
}

// Add payment gateway class
function add_without_gateway($methods) {
	$methods[] = 'WC_WITHOUTGATEWAY';
	return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_without_gateway');