<?php
/**
 * Webnus Webnus Envato class.
 * @author Webnus <info@webnus.biz>
 */
class Webnus_Envato {
    /**
     * The theme current version
     */
    public $current_version = '';

    /**
     * The theme author username
     */
    public $user_name = 'webnus';

    /**
     * User for cashing directory
     */
    public $purchase_code = '';

    /**
     * MEC api Key
     */
    public $api_key = '';

    /**
     * Bearer token
     */
    public $bearer = '';

    /**
     * The theme remote update path
     */
    public $update_path = '';

    /**
     * Theme name
     */
    public $slug;

    /**
     * Get options
     */
    public $verifystatus;

    /**
     * Tehem info
     */
    public $themeinfo;

    /**
     * User for cashing directory
     */
    protected $cache_dir = 'cache';

    /**
     *  webnus update constructor
     */
    public function __construct()
    {
        // Get theme info
        $this->themeinfo = wp_get_theme();

        // Ste theme name
        $this->slug =  $this->themeinfo->get( 'Name' );

        // Set version
        $this->current_version = $this->themeinfo->get( 'Version' );

        // Get info
        $this->verifystatus = get_option( $this->slug.'theme_activate' );

        // Set user purchase code
        $this->set_purchase_code( isset( $this->verifystatus ['purchase_code'] ) ? $this->verifystatus ['purchase_code'] : '' );

        // Set user envato token
        $this->set_bearer( isset( $this->verifystatus ['security_token'] ) ? $this->verifystatus ['security_token'] : '' );

        // updating checking
        add_filter('pre_set_site_transient_update_themes', array($this, 'check_update'));

        // information checking
       // add_filter('site_transient_update_themes', array($this, 'check_info'), 10, 3);
    }

    /**
     * Set envato user name.
     * @author Webnus <info@webnus.biz>
     */
    public function set_user($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * Set purchase code.
     * @author Webnus <info@webnus.biz>
     */
    public function set_purchase_code($purchase_code)
    {
        $this->purchase_code = $purchase_code;
    }

    /**
     * Set API key.
     * @author Webnus <info@webnus.biz>
     */
    public function set_api_key($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Set bearer token.
     * @author Webnus <info@webnus.biz>
     */
    public function set_bearer($bearer)
    {
        $this->bearer = $bearer;
    }

    /**
     * Set update path.
     * @author Webnus <info@webnus.biz>
     */
    public function set_update_path($update_path)
    {
        $this->update_path = $update_path;
    }

    /**
     * Get envato user name.
     * @author Webnus <info@webnus.biz>
     */
    public function get_user()
    {
        return $this->user_name;
    }

    /**
     * GET purchase code.
     * @author Webnus <info@webnus.biz>
     */
    public function get_purchase_code()
    {
        return $this->purchase_code;
    }

    /**
     * Get API Key.
     * @author Webnus <info@webnus.biz>
     */
    public function get_api_key()
    {
        return $this->api_key;
    }

    /**
     * Get bearer token.
     * @author Webnus <info@webnus.biz>
     */
    public function get_bearer()
    {
        return $this->bearer;
    }

    /**
     * Get update path.
     * @author Webnus <info@webnus.biz>
     */
    public function get_update_path()
    {
        return $this->update_path;
    }

    /**
     * Add our self-hosted autoupdate theme to the filter transien
     * @author Webnus <info@webnus.biz>
     */
    public function check_update($transient)
    {

        if(empty($transient->checked)) return $transient;

        // Get the remote version and url
        $information = $this->get_MEC_info('info');
        $version = isset($information->item->wordpress_theme_metadata->version) ? $information->item->wordpress_theme_metadata->version : '';

        // Get the remote and url
        $url = isset( $information->item->url ) ? $information->item->url : '' ;

        // Set mec update path via token
        if ( isset( $this->get_MEC_info('dl')->wordpress_theme ) ) {
            $this->set_update_path( $this->get_MEC_info('dl')->wordpress_theme );
            update_option( $this->slug.'up_path', $this->get_update_path() );
        }

        // If a newer version is available, add the update
        if ( version_compare( $this->current_version , $version, '<' ) ) {

            $obj = new stdClass();
            $obj->theme = $this->slug;
            $obj->new_version = $version ;
            $obj->url = $url;
            $obj->package = get_option( $this->slug.'up_path' );
            $new_trans = json_decode(json_encode($obj),true);
            $transient->response[$this->slug] = $new_trans;
        } elseif( isset( $transient->response[$this->slug] ) ) {
            unset($transient->response[$this->slug]);
        }
        return $transient ;
    }

    /**
     * Add our self-hosted description to the filter
     * @author Webnus <info@webnus.biz>
     */
    public function check_info($false, $action, $arg)
    {
        if($arg->slug === $this->slug)
        {
            $information = $this->get_MEC_info('info');
            if($information->item)
            {
                $arg->fields->short_description = true;
                $arg->fields->description = true;
                $arg->fields->sections = true;
                $arg->slug = $this->slug;
                $arg->theme_name = isset($information->item->wordpress_theme_metadata->theme_name) ? $information->item->wordpress_theme_metadata->theme_name : '';
                $arg->author = isset($information->item->wordpress_theme_metadata->author) ?  $information->item->wordpress_theme_metadata->author : '';
                $arg->homepage = isset($information->item->classification_url) ? $information->item->classification_url : '';
                $arg->banners['low'] = 'https://0.s3.envato.com/files/202920118/mec-preview1.png';

                return $arg;
            }
        }

        return false;
    }

    /**
     * Return details from envato
     * @author Webnus <info@webnus.biz>
     */
    public function get_MEC_info($type = 'info')
    {
        // setting the header for the rest of the api
        $code = $this->get_purchase_code();
        $bearer = 'bearer '.$this->get_bearer();

        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        if($type == 'info') $verify_url = 'https://api.envato.com/v3/market/buyer/purchase?code='.$code;
        elseif($type == 'dl') $verify_url = 'https://api.envato.com/v3/market/buyer/download?purchase_code='.$code;
        else return;

        $ch_verify = curl_init($verify_url);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Envato Marketplace API Wrapper PHP)');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        if($cinit_verify_data != '') return json_decode($cinit_verify_data);
        else return false;
    }

    /**
     * Get user data
     * @author Webnus <info@webnus.biz>
     */
    public function user_data($set = 'verify-purchase')
    {
        $user_name = $this->get_user();
        $api = $this->get_api_key();
        $purchase_code = $this->get_purchase_code();

        if(!isset($this->api_key)) echo 'You have not set an api key yet.';
        if(!isset($set)) return 'Missing parameters';

        $url = "http://marketplace.envato.com/api/edge/$user_name/$api/$set";
        if(!is_null($purchase_code)) $url .= ":$purchase_code";

        $url .= '.json';
        $result = $this->fetch($url);

        if(isset($result->error)) return 'Username, API Key, or purchase code is invalid.';
        return $result->$set;
    }

    /*
     * Fetches the desired data from the API and caches it, or fetches the cached version
     * @author Webnus <info@webnus.biz>
     */
    protected function fetch($url, $set = null)
    {
        $cache_path = $this->cache_dir.'/'.str_replace(':', '-', substr(strrchr($url, '/'), 1));

        if($this->has_expired($cache_path))
        {
            // get fresh copy
            $data = $this->curl($url);

            if($data) $data = isset($set) ? $data->{$set} : $data;
            else echo 'Could not retrieve data.' ;

            $this->cache_it($cache_path, $data);
            return $data;
        }
        else
        {
            // if available in cache, use that
            return json_decode(file_get_contents($cache_path));
        }
    }

    /**
     * Verfy purchase from envato.
     * @author Webnus <info@webnus.biz>
     * @return boolean
     */
    public function verify_purchase()
    {
        $validity = $this->user_data();
        return isset($validity->buyer) ? $validity : false;
    }

    /**
     * Determines whether the provided file has expired yet
     * @author Webnus <info@webnus.biz>
     */
    protected function has_expired($cache_path, $expires = null)
    {
        if(!isset($expires)) $expires = $this->cache_expires;
        if(file_exists($cache_path))
        {
            return time() - $expires * 60 * 60 > filemtime($cache_path);
        }

        return true;
    }

    /**
     * Caches the results request to keep from hammering the API
     * @author Webnus <info@webnus.biz>
     */
    protected function cache_it($cache_path, $data)
    {
        if(!isset($data)) return;

        !file_exists($this->cache_dir) && mkdir($this->cache_dir);
        file_put_contents($cache_path, json_encode($data));

        return $cache_path;
    }

    /**
     * General purpose function to query the marketplace API.
     */
    protected function curl($url)
    {
        if(empty($url)) return false;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Envato Marketplace API Wrapper PHP)');

        $data = json_decode(curl_exec($ch));
        curl_close($ch);

        return $data;
    }
}
new Webnus_Envato;
