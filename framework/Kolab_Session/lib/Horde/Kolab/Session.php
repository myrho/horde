<?php
/**
 * The interface describing Horde_Kolab_Session handlers.
 *
 * PHP version 5
 *
 * @category Kolab
 * @package  Kolab_Session
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_Session
 */

/**
 * The interface describing Horde_Kolab_Session handlers.
 *
 * Horde_Kolab_Server currently has no caching so we mainly cache some core user
 * information in the Kolab session handler as reading this data is expensive
 * and it is sufficient to read it once per session.
 *
 * The core user credentials (login, pass) are kept within the Auth module and
 * can be retrieved using <code>Auth::getAuth()</code> respectively
 * <code>Auth::getCredential('password')</code>. Any additional Kolab user data
 * relevant for the user session should be accessed via the Horde_Kolab_Session
 * class.
 *
 * Copyright 2008-2009 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @category Kolab
 * @package  Kolab_Session
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_Session
 */
interface Horde_Kolab_Session
{
    /**
     * Try to connect the session handler.
     *
     * @param array $credentials An array of login credentials. For Kolab,
     *                           this must contain a "password" entry.
     *
     * @return NULL
     *
     * @throws Horde_Kolab_Session_Exception If the connection failed.
     */
    public function connect(array $credentials);

    /**
     * Return the user id used for connecting the session.
     *
     * @return string The user id.
     */
    public function getId();

    /**
     * Return the users mail address.
     *
     * @return string The users mail address.
     */
    public function getMail();

    /**
     * Return the users uid.
     *
     * @return string The users uid.
     */
    public function getUid();

    /**
     * Return the users name.
     *
     * @return string The users name.
     */
    public function getName();

    /**
     * Return a connection to the Kolab storage system.
     *
     * @return Horde_Kolab_Storage The storage connection.
     */
    public function getStorage();

    /**
     * Set the handler that provides getCurrentUser() for this instance.
     *
     * @param Horde_Kolab_Session_Auth $auth The authentication handler.
     *
     * @return NULL
     */
    public function setAuth(Horde_Kolab_Session_Auth $auth);

    /**
     * Get the handler that provides getCurrentUser() for this instance.
     *
     * @return Horde_Kolab_Session_Auth The authentication handler.
     */
    public function getAuth();

    /**
     * Does the current session still match the authentication information?
     *
     * @param string $user The user the session information is being requested
     *                     for. This is usually empty, indicating the current
     *                     user.
     * @param string $auth The user the current session belongs to.
     *
     * @return boolean True if the session is still valid.
     */
    public function isValid($user, $auth);
}
