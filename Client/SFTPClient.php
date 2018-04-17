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
 * SFTP client.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\FTP\Client
 */
class SFTPClient extends AbstractFTPClient {

    /**
     * Constructor.
     *
     * @param Authenticator $authenticator The authenticator.
     */
    public function __construct(Authenticator $authenticator) {
        parent::__construct($authenticator);
        $this->getAuthenticator()->setScheme("sftp");
        if (null === $this->getAuthenticator()->getPort()) {
            $this->getAuthenticator()->setPort(22);
        }
    }

    /**
     * Opens this FTP connection.
     *
     * @return SFTPClient Returns this SFTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function connect() {
        $host = $this->getAuthenticator()->getHost();
        $port = $this->getAuthenticator()->getPort();
        $this->setConnection(ssh2_ssl_connect($host, $port));
        if (false === $this->getConnection()) {
            throw $this->newFTPException("connection failed");
        }
        return $this;
    }

    /**
     * Logs in to this FTP connection.
     *
     * @return SFTPClient Returns this SFTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function login() {
        $username = $this->getAuthenticator()->getPasswordAuthentication()->getUsername();
        $password = $this->getAuthenticator()->getPasswordAuthentication()->getPassword();
        if (false === ssh2_auth_password($this->getConnection(), $username, $password)) {
            throw $this->newFTPException("login failed");
        }
        return $this;
    }

}
