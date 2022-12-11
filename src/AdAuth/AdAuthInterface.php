<?php

namespace AdAuth;

use AdAuth\Response\AuthenticationResponse;
use AdAuth\Response\PasswordResponse;
use AdAuth\Response\PingResponse;
use AdAuth\Response\StatusResponse;

interface AdAuthInterface {

    /**
     * Send a ping to the server to check availability
     * @return PingResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function ping(): PingResponse;

    /**
     * Tries to authenticate a user
     *
     * @param Credentials $credentials
     * @return AuthenticationResponse The response object, which type depends on the authentication success
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function authenticate(Credentials $credentials): AuthenticationResponse;

    /**
     * Changes a user's password with the old user's credentials
     *
     * @param Credentials $oldCredentials The user's current credentials
     * @param Credentials $newCredentials The user's new credentials (only password is necessary)
     * @return PasswordResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function changePassword(Credentials $oldCredentials, Credentials $newCredentials): PasswordResponse;

    /**
     * Resets a user's password using admin credentials
     *
     * @param Credentials $newCredentials The user's new credentials
     * @param Credentials $adminCredentials The admin's credentials
     * @return PasswordResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function resetPassword(Credentials $newCredentials, Credentials $adminCredentials): PasswordResponse;

    /**
     * Fetches the given users from the remote Active Directory
     *
     * @param string[] $users List of usernames to get information about (UPNs)
     * @return StatusResponse
     */
    public function status(array $users): StatusResponse;
}