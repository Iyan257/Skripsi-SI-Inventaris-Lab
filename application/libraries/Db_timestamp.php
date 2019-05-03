<?php defined('BASEPATH') or exit('No direct script access allowed');

class Db_timestamp
{
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->helper(['date']);
    }

    public function timestamp_field(&$data)
    {
        $data['created_at'] = [
            'type' => 'DATETIME',
            'null' => true,
        ];
        $data['updated_at'] = [
            'type' => 'DATETIME',
            'null' => true,
        ];
    }

    public function softdelete_field(&$data)
    {
        $data['deleted_at'] = [
            'type' => 'DATETIME',
            'null' => true,
        ];
    }

    public function timestamp_create(&$data)
    {
        $data['created_at'] = mdatenow();
        $this->timestamp_update($data);
    }

    public function timestamp_update(&$data)
    {
        $data['updated_at'] = mdatenow();
    }

    public function softdelete_delete()
    {
        return [
            'deleted_at' => mdatenow(),
        ];
    }
}
