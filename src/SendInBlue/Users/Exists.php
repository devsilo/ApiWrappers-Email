<?php

namespace FernleafSystems\ApiWrappers\Email\SendInBlue\Users;

use FernleafSystems\ApiWrappers\Base\ConnectionConsumer;

class Exists {

	use ConnectionConsumer;

	/**
	 * @param string $sEmail
	 * @return bool
	 */
	public function exists( $sEmail ) {
		$oSub = ( new Retrieve() )
			->setConnection( $this->getConnection() )
			->byEmail( $sEmail );
		return !empty( $oSub );
	}
}