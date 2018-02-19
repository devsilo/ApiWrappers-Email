<?php

namespace FernleafSystems\ApiWrappers\Email\Drip\Purchases;

use FernleafSystems\ApiWrappers\Email\Drip;

/**
 * Class Create
 * @package FernleafSystems\ApiWrappers\Email\Drip\Purchases
 */
class Create extends Drip\Api {

	const REQUEST_METHOD = 'post';

	/**
	 * @param ItemVO $oItem
	 * @return $this
	 */
	public function addItem( $oItem ) {
		return $this->addItems( [ $oItem ] );
	}

	/**
	 * @param ItemVO[] $aNewItems
	 * @return $this
	 */
	public function addItems( $aNewItems ) {
		if ( empty( $aNewItems ) || !is_array( $aNewItems ) ) {
			return $this;
		}

		$aItems = $this->getRequestDataItem( 'items' );
		if ( !is_array( $aItems ) ) {
			$aItems = array();
		}

		$aNewItems = array_map(
			function ( $oItem ) {
				/** @var ItemVO $oItem */
				return $oItem->getRawDataAsArray();
			},
			$aNewItems
		);

		return $this->setRequestDataItem( 'items', array_merge( $aItems, $aNewItems ) );
	}

	/**
	 * @param int $nAmount - in cents, not floats
	 * @return $this
	 */
	public function setAmount( $nAmount ) {
		return $this->setRequestDataItem( 'amount', (int)round( $nAmount ) );
	}

	/**
	 * @param string $sEmail
	 * @return $this
	 */
	public function setSubscriberEmail( $sEmail ) {
		return $this->setParam( 'subscriber_email', $sEmail );
	}

	/**
	 * @param string $sId
	 * @return $this
	 */
	public function setOrderId( $sId ) {
		return $this->setRequestDataItem( 'order_id', $sId );
	}

	/**
	 * @param string $sLink - unix timestamp
	 * @return $this
	 */
	public function setPermalink( $sLink ) {
		return $this->setRequestDataItem( 'permalink', $sLink );
	}

	/**
	 * @param string $sValue
	 * @return $this
	 */
	public function setProvider( $sValue ) {
		return $this->setRequestDataItem( 'provider', $sValue );
	}

	/**
	 * @param int $nOccurredAt - unix timestamp
	 * @return $this
	 */
	public function setTime( $nOccurredAt ) {
		return $this->setRequestDataItem( 'occurred_at', date( 'c', $nOccurredAt ) );
	}

	/**
	 * @param array $aProps
	 * @return $this
	 */
	public function setProperties( $aProps ) {
		return $this->setRequestDataItem( 'properties', $aProps );
	}

	/**
	 * @param string $sKey
	 * @param mixed  $mValue
	 * @return $this
	 */
	public function setProperty( $sKey, $mValue ) {
		$aProps = $this->getRequestDataItem( 'custom_fields' );
		if ( !is_array( $aProps ) ) {
			$aProps = array();
		}
		$aProps[ $sKey ] = $mValue;
		return $this->setProperties( $aProps );
	}

	/**
	 * It's rare to override this Final data request, but when creating subscribers the data for
	 * the new subscriber needs to be wrapped up in an array.
	 * @return array
	 */
	public function getRequestDataFinal() {
		return array( 'purchases' => array( $this->getRequestData() ) );
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( 'subscribers/%s/purchases', urlencode( $this->getParam( 'subscriber_email' ) ) );
	}
}