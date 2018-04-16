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
 * FTP client.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\FTP\Client
 */
class FTPClient extends AbstractFTPClient {

    /**
     * Constructor.
     *
     * @param Authenticator $authenticator The authenticator.
     */
    public function __construct(Authenticator $authenticator) {
        parent::__construct($authenticator);
        $this->getAuthenticator()->setScheme("ftp");
        if (null === $this->getAuthenticator()->getPort()) {
            $this->getAuthenticator()->setPort(21);
        }
    }

    /**
     * Closes this FTP connection.
     *
     * @return FTPClient Returns this FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function close() {
        if (false === ftp_close($this->getConnection())) {
            throw $this->newFTPException("disconnection failed");
        }
        return $this;
    }

    /**
     * Opens this FTP connection.
     *
     * @param integer $timeout The timeout.
     * @return FTPClient Returns this FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function connect($timeout = 90) {
        $host = $this->getAuthenticator()->getHost();
        $port = $this->getAuthenticator()->getPort();
        $this->setConnection(ftp_connect($host, $port, $timeout));
        if (false === $this->getConnection()) {
            throw $this->newFTPException("connection failed");
        }
        return $this;
    }

    /**
     * Logs in to this FTP connection.
     *
     * @return FTPClient Returns this FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function login() {
        $username = $this->getAuthenticator()->getPasswordAuthentication()->getUsername();
        $password = $this->getAuthenticator()->getPasswordAuthentication()->getPassword();
        if (false === ftp_login($this->getConnection(), $username, $password)) {
            throw $this->newFTPException("login failed");
        }
        return $this;
    }

    /**
     * Creates a directory.
     *
     * @param string $directory The directory.
     * @return FTPClient Returns this FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function mkdir($directory) {
        if (false === ftp_mkdir($this->getConnection(), $directory)) {
            throw $this->newFTPException(sprintf("mkdir %s failed", $directory));
        }
        return $this;
    }

}
