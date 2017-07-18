<?php

namespace FernleafSystems\Apis\Email\SendInBlue\Webhooks;

use FernleafSystems\Utilities\Data\Adapter\StdClassAdapter;

class WebhookVO {

	use StdClassAdapter;

	/**
	 * @return int
	 */
	public function getWebhookId() {
		return $this->getParam( 'id' );
	}

	/**
	 * @return int
	 */
	public function getEmailAddress() {
		return $this->getStringParam( 'email' );
	}

	/**
	 * @return int
	 */
	public function getEvent() {
		return $this->getParam( 'event' );
	}

	/**
	 * @return int
	 */
	public function getKey() {
		return $this->getStringParam( 'key' );
	}

	/**
	 * @return int[]
	 */
	public function getListIds() {
		return $this->getArrayParam( 'list_id' );
	}

	/**
	 * @return bool
	 */
	public function isListAddition() {
		return $this->getEvent() == 'list_addition';
	}
}