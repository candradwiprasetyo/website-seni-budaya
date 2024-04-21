<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth
{
    private $CI;
    private $user_email;
    private $user_password;

    public function __construct()
    {
        $this->CI =& get_instance();
        // $dsn2 = 'mysqli://ddtc_darussalam:internasional23@localhost/ddtc_engine';
        $dsn2 = 'mysqli://root:root@localhost/ddtc_engine';
        $this->CI->db2= $this->CI->load->database($dsn2, true);
    }

    public function do_login($user_email, $user_password)
    {
        $this->user_email = $user_email;
        $this->user_password = $user_password;

        $this->CI->db2->where('user_email', $this->user_email);
        $user_count = $this->CI->db2->count_all_results('user');

        if($user_count === 1)
        {
            $this->CI->db2->where('user_email', $this->user_email);
            $user = $this->CI->db2->get('user')->row_array();

            $user_password_db = $user['user_password'];

            if($user_password_db == "")
            {
                return false;
            }
            else
            {
                $check_password = $this->check_password($this->user_password, $user_password_db);

                if($check_password)
                {
                    $user_id = $user['user_id'];
                    $user_name = $user['user_name'];
                    $user_email = $user['user_email'];
                    $user_image = $user['user_image'];

                    $data_session = array(
                                        'news_user_id'   => $user_id,
                                        'news_user_name' => $user_name,
                                        'news_user_email' => $user_email,
                                        'news_user_image' => $user_image,
                                        'news_user_auth'  => 'news_ddtc',
                                    );
                    $this->CI->session->set_userdata($data_session);

                    // $this->CI->load->model('user_model');
                    // $this->CI->user_model->update_login_current($user_id);

                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function is_logged_in()
    {
        // echo "woi";
        // echo $this->CI->session->userdata('news_user_id');
        if($this->CI->session->userdata('news_user_id') == '')
        {
            return false;
        }

        return true;
    }

    public function do_logout()
    {
        // $this->CI->load->helper('cookie');
        // delete_cookie('user_logged_in_cookies');

        $this->CI->session->sess_destroy();
    }

    public function create_cookies($user_id)
    {
        $this->CI->load->helper('cookie');

        $cookie = array(
                        'name'   => 'user_logged_in_cookies',
                        'value'  => $user_id,                            
                        'expire' => time() + 2592000
                        );

        set_cookie($cookie);
    }

    /*Password*/
    public function create_password($user_password)
    {
        $this->user_password = $this->crypt_password($user_password);

        return $this->user_password;
    }

    private function crypt_password($input, $rounds = 10)
    {
        $crypt_options = array(
            'cost' => $rounds
        );

        return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
    }

    public function check_password($input, $user_password)
    {
        if(password_verify($input, $user_password))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_user_data($user_id = '') {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('news_user_id');
        }

        if ($user_id) {
            $sql = "select 
                user_id,
                user_name,
                user_email,
                user_image,
                user_login_last,
                user_facebook_id
                from user where user_id = '$user_id'";
            $query = $this->CI->db2->query($sql);
            $result = null;
            $result = $query->result_array();

            if ($this->CI->session->userdata('news_user_auth') == 'Facebook' || $result[0]['user_facebook_id'] != 0) {
                $result[0]['user_image'] = 'https://graph.facebook.com/'.$result[0]['user_facebook_id'].'/picture?width=200';
            } else {
                $result[0]['user_image'] = $this->get_host_engine().'assets/upload/images/'.$result[0]['user_image'];
            }

            return $result[0];
        } else {
            return false;
        }

    }

    public function get_user_data_admin($user_id = '') {

        if ($user_id) {
            $sql = "select * from tbl_user where ID = '$user_id'";
            $query = $this->CI->db->query($sql);
            $result = null;
            $result = $query->result_array();

            return $result[0];
        } else {
            return false;
        }

    }

    public function get_host_engine() {
        return 'https://engine.ddtc.co.id/';
        // return 'http://localhost:8888/ddtc_engine/';
    }

    public function check_favourite($id) {
        $user_id = $this->CI->session->userdata('news_user_id');

        $sql = "select favourite_id as result from favourite where favourite_user = '$user_id' and favourite_document_id = '$id' and favourite_news = '1'";    
        $query = $this->CI->db2->query($sql);  
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        return $result['result'];
    }

    public function get_user_admin() {
        $ddtc = unserialize(base64_decode(get_cookie('ddtc')));
        if ($ddtc) {
            return $ddtc;
        } else {
            return false;
        }
    }

    public function check_user_admin() {
        $ddtc = unserialize(base64_decode(get_cookie('ddtc')));
        if ($ddtc['ROLE']=='admin' || $ddtc['ROLE']=='superadmin' || $ddtc['ROLE']=='subscriber') {
            return true;
        } else {
            return false;
        }
    }
}