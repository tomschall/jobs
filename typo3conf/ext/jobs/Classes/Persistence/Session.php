<?php
namespace Sozialinfo\Jobs\Persistence;

/**
 * Session class.
 *
 * An abstraction layer utilizing a namespaced session
 * for temporarily persisting data.
 */
class Session implements \TYPO3\CMS\Core\SingletonInterface {
	
	/**
	 * @var string
	 */
	protected static $namespace = 'jobsession';
	
	/**
	 * Class constructor.
	 */
	public function __construct() {
		@session_start();
		if (!is_array($_SESSION[self::$namespace])) {
			$_SESSION[self::$namespace] = array();
		}
	}
	
	/**
	 * Stores the given value.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	
	public function set($key, $value) {
		$_SESSION[self::$namespace][$key] = $value;
	}
	
	/**
	 * Stores the given value as serialized string.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function setSerialized($key, $value) {
		
		$_SESSION[self::$namespace][$key] = serialize($value);
	}
	
	/**
	 * Retrieves values for the given key.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		return $_SESSION[self::$namespace][$key];
	}
	
	/**
	 * Retrieves unserialized values for the given key.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getUnserialized($key) {
		return unserialize($_SESSION[self::$namespace][$key]);
	}
	
	/**
	 * Tests if the given key has data assigned.
	 *
	 * @param string $key
	 * @return bool
	 */
	public function has($key) {
		return !is_null($_SESSION[self::$namespace][$key]);
	}
	
	/**
	 * Removes key from session.
	 *
	 * @param string $key
	 * @return void
	 */
	public function remove($key) {
		unset($_SESSION[self::$namespace][$key]);
	}
}