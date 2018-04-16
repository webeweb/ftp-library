<?php

/**
 * This file is part of the ftp-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\FTP\Client;

use WBW\Library\Core\Security\Authenticator;
use WBW\Library\FTP\Exception\FTPException;

/**
 * Abstract FTP client.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\FTP\Client
 * @abstract
 */
abstract class AbstractFTPClient {

    /**
     * Authenticator.
     *
     * @var Authenticator
     */
    private $authenticator;

    /**
     * Connection.
     *
     * @var mixed
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param Authenticator $authenticator The authenticator.
     */
    protected function __construct(Authenticator $authenticator) {
        $this->authenticator = $authenticator;
    }

    /**
     * Get the authenticator.
     *
     * @return Authenticator Returns the authenticator.
     */
    final public function getAuthenticator() {
        return $this->authenticator;
    }

    /**
     * Get the connection.
     *
     * @return mixed Returns the connection.
     */
    final public function getConnection() {
        return $this->connection;
    }

    /**
     * Construct a new FTP exception.
     *
     * @param string $message The message.
     * @return FTPException Returns a new FTP exception.
     */
    final protected function newFTPException($message) {
        return new FTPException(sprintf("%s://%s:%s@%s:%d " . $message, $this->authenticator->getScheme(), $this->authenticator->getPasswordAuthentication()->getUsername(), $this->authenticator->getPasswordAuthentication()->getPassword(), $this->authenticator->getHost(), $this->authenticator->getPort()));
    }

    /**
     * Set the authenticator.
     *
     * @param \WBW\Library\FTP\Client\Authenticator $authenticator The authenticator.
     * @returns AbstractFTPClient Returns this abstract FTP client.
     */
    final protected function setAuthenticator(Authenticator $authenticator) {
        $this->authenticator = $authenticator;
        return $this;
    }

    /**
     * Set the connection.
     *
     * @param mixed $connection The connection.
     * @returns AbstractFTPClient Returns this abstract FTP client.
     */
    final protected function setConnection($connection) {
        $this->connection = $connection;
        return $this;
    }

}
