<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// A helper for generating gravatar links
class Gravatar_helper {

    // The gravatar base URL
    private static $image_base_url = 'http://gravatar.com/avatar.php';
    private static $profile_base_url = 'http://gravatar.com/';

    // Base path to look for custom non-gravatars
    private static $image_base_path = './uploads/user_avatars/';

    // List of available predefined sizes
    private static $sizes_available = array(
		'tiny' => 30,
		'smaller' => 50,
		'small' => 80,
		'smallish' => 120,
		'medium' => 180
	);
	// Default size if not in available sizes
	private static $size_default = 300;
	// Size of generated thumbnails
	private static $size_thumb = 180;

	/**
	 * Get the equivalent pixel size for any string
	 *
	 * Example: Gravatar_helper::size('smaller') = 50;
	 * 
	 * @param  string $size Textual representation of the desired avatar size
	 * @return int          Size in pixels if available, or the default size
	 */
	static function get_size($size)
	{
		if (is_int($size) || is_null($size))
		{
			return $size;
		}

		return (
			array_key_exists($size, self::$sizes_available)
			 ? self::$sizes_available[$size]
			 : self::$size_default
		);
	}

	/**
	 * Generate a gravatar link from a user object
	 *
	 * Requires at minimum an object containing at least 4 properties:
	 * stdClass (Object) {
	 * 		avatar_url
	 * 		avatar_thumb_url
	 * 		avatar_filename
	 * 		email
	 * }
	 *
	 * $size can either be numeric or one of the names in self::$sizes_available
	 *
	 * Returns avatar (thumb) URL from given user object if avatar_filename exists
	 * in the default path (self::$image_base_path). Otherwise gravatar is used.
	 * In case of error, the default avatar is returned.
	 */
	static function from_user(&$user, $rating = null, $size = null, $default = null)
	{
		// Translate the size in case friendly size given
		$size = self::get_size($size);

		// We could typecast arrays, but force object to play it safe
		if (!is_object($user))
		{
			log_message('error', 'Gravatar_helper::from_user() expects $user to be an object, ' . gettype($user) . ' given.');
		}
		else
		{
			foreach (array('avatar_url', 'avatar_thumb_url', 'avatar_filename', 'email') as $property)
			{
				if (!property_exists($user, $property))
				{
					log_message('error', 'Missing required property ' . $property);
					$failed_check = true;
					break;
				}
			}

			if (!isset($failed_check))
			{
				// If this passes then it's a locally uploaded avatar
				if (!empty($user->avatar_filename) && !empty($user->avatar_url) && !empty($user->avatar_thumb_url))
				{
					if (file_exists(self::$image_base_path . $user->avatar_filename))
					{
						// If an image exists in the default path, it's fairly safe
						// to assume that both avatar and thumb URLs are correct
						return (
							$size != self::$size_default
							 ? $user->avatar_thumb_url
							 : $user->avatar_url
						);
					}

					log_message('info', 'Avatar doesn\'t exist in "' . self::$image_base_path . $user->avatar_filename . '"');
				}
				else
				{
					// Don't need to bother checking for empty emails,
					// gravatar service will return the default anyway
					return self::from_email($user->email, $rating, self::get_size($size), $default);
				}
			}
		}

		// If we got this far something went wrong, so why not help to keep
		// the site looking nice by returning the default (gr)avatar instead
		return self::from_email('', $rating, $size, $default);
	}

    /*
     * Generate a gravatar link from an email address
     *
     * $email: The email to generate the link for
     * +++ all the other arguments for gravatar_hash()
     */
    static function from_email($email, $rating = null, $size = null, $default = null) {
        return self::from_hash(md5(strtolower($email)), $rating, $size, $default);
    }

    /*
     * Generate a gravatar link from an email hash
     *
     * $hash: the hash to generate the link for
     * $rating: the rating ('G', 'R', 'X')
     * $size: The size (square) of the desired image
     * $default: The default image if the user doesn't have one
     */
    static function from_hash($hash, $rating = null, $size = null, $default = null) {
        // Add the gravatar id
        $options = array();
        $options[] = "gravatar_id=$hash";
        // optional options
        if ($rating) $options[] = "rating=$rating";
        if ($size) $options[] = "size=$size";
        if ($default) $options[] = "default=$default";
        // put together the URL and return it
        return self::$image_base_url . '?' . implode($options, '&');
    }

    /*
     * Get the profile of a user by email, or null if not found
     *
     * $email: the email to fetch the profile for
     */
    static function profile_from_email($email) {
        return self::profile_from_hash(md5(strtolower($email)));
    }

    /*
     * Get the profile of a user by email hash, or null if not found
     *
     * $hash: the hash to fetch the profile for
     */
    static function profile_from_hash($hash) {
        $raw = file_get_contents(self::$profile_base_url . $hash . '.json');
        if ($raw) {
            $data = json_decode($raw);
            $entry = $data->entry;
            return $entry[0];
        } else {
            return null;
        }
    }

}
