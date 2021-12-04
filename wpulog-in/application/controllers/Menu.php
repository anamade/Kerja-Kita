<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', array('email' =>
        $this->session->userdata('email')))->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', array('menu' => $this->input->post('menu')));
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
                role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', array('email' =>
        $this->session->userdata('email')))->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            );
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
                role="alert"> New Sub menu added!</div>');
            redirect('menu/submenu');
        }
    }

    // edit Menu
    public function editMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', "Data Gagal di edit");
            redirect('menu');
        } else {
            $this->db->set('menu', $this->input->post('menu'));
            $this->db->where('id', $this->input->post('menu_id'));
            $this->db->update('user_menu');
            $this->session->set_flashdata('message', "Data Berhasil di Edit");
            redirect('menu');
        }
    }

    public function editSubmenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', "Data Gagal Di Edit");
            redirect('menu/submenu');
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('title'),
            );
            $this->db->where('id', $this->input->post('submenu_id'));
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata('message', "Data berhasil di edit");
            redirect('menu/submenu');
        }
    }

    // hapus menu
    public function delete($id)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->deleteMenu($id);
        $this->session->set_flashdata('message', "Data Berhasil Dihapus");
        redirect('menu');
    }

    // hapus submenu

    public function deleteSubMenu($id)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->deleteSubMenu($id);
        $this->session->set_flashdata('message', "Data Berhasil Dihapus");
        redirect('menu/submenu');
    }
}
