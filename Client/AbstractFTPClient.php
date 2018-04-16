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
     * Closes this FTP connection.
     *
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function close() {
        if (false === @ftp_close($this->getConnection())) {
            throw $this->newFTPException("close failed");
        }
        return $this;
    }

    /**
     * Opens this FTP connection.
     *
     * @param integer $timeout The timeout.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    abstract public function connect($timeout = 90);

    /**
     * Deletes a file on the FTP server.
     *
     * @param string $path The file to delete.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function delete($path) {
        if (false === @ftp_delete($this->getConnection(), $path)) {
            throw $this->newFTPException(sprintf("delete %s failed", $path));
        }
        return $this;
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
     * Logs in to this FTP connection.
     *
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function login() {
        $username = $this->getAuthenticator()->getPasswordAuthentication()->getUsername();
        $password = $this->getAuthenticator()->getPasswordAuthentication()->getPassword();
        if (false === @ftp_login($this->getConnection(), $username, $password)) {
            throw $this->newFTPException("login failed");
        }
        return $this;
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
     * Tuns passive mode on or off.
     *
     * @param boolean $pasv The passive mode.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function pasv($pasv) {
        if (false === @ftp_pasv($this->getConnection(), $pasv)) {
            throw $this->newFTPException(sprintf("pasv from %d to %d failed", !$pasv, $pasv));
        }
        return $this;
    }

    /**
     * Uploads a file to The FTP server.
     *
     * @param string $localFile The local file.
     * @param string $remoteFile The remote file.
     * @param integer $mode The mode.
     * @param integer $startPos The start position.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function put($localFile, $remoteFile, $mode = FTP_IMAGE, $startPos = 0) {
        if (false === @ftp_put($this->getConnection(), $remoteFile, $localFile, $mode, $startPos)) {
            throw $this->newFTPException(sprintf("put %s into %s failed", $localFile, $remoteFile));
        }
        return $this;
    }

    /**
     * Creates a directory.
     *
     * @param string $directory The directory.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function mkdir($directory) {
        if (false === @ftp_mkdir($this->getConnection(), $directory)) {
            throw $this->newFTPException(sprintf("mkdir %s failed", $directory));
        }
        return $this;
    }

    /**
     * Renames a file or a directory on the FTP server.
     *
     * @param string $oldName The old file/directory name.
     * @param string $newName The new name.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function rename($oldName, $newName) {
        if (false === @ftp_rename($this->getConnection(), $oldName, $newName)) {
            throw $this->newFTPException(sprintf("rename %s into %s failed", $oldName, $newName));
        }
        return $this;
    }

    /**
     * Removes a directory.
     *
     * @param string $directory The directory.
     * @return AbstractFTPClient Returns this abstract FTP client.
     * @throws FTPException Throws a FTP exception if an I/O error occurs.
     */
    public function rmdir($directory) {
        if (false === @ftp_rmdir($this->getConnection(), $directory)) {
            throw $this->newFTPException(sprintf("rmdir %s failed", $directory));
        }
        return $this;
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
