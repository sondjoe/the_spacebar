<?php
/**
 * Created by PhpStorm.
 * User: abellana
 * Date: 09/08/2018
 * Time: 1:35 PM
 */

namespace App\Helper;


use Psr\Log\LoggerInterface;

trait LoggerTrait
{

	/**
	 * @var LoggerInterface|null
	 */
	private $logger;

	/**
	 * @required
	 */
	public function setLogger(LoggerInterface $logger) {
		$this->logger = $logger;
	}

	public function logInfo(string $message, $content = []) {

		if ($this->logger) {
			$this->logger->info($message, $content);
		}
	}
}