<?php
defined('BASEPATH') or exit('No direct script access allowed');

class newsModel extends CI_Model
{
    //Show all posts or post based certain category from database
    public function getPosts($id)
    {
        if ($id === 0) {
            $this->db->select('posts.postId, posts.postTitle, posts.publishDate, posts.postAuthor, posts.postPicture, category.categoryName, category.categoryId')->from('posts')->join('category', 'posts.categoryId = category.categoryId', 'left');
        } else {
            $this->db->select('posts.postId, posts.postTitle, posts.publishDate, posts.postAuthor, posts.postPicture, category.categoryName, category.categoryId')->from('posts')->join('category', 'posts.categoryId = category.categoryId', 'left')->where('category.categoryId', $id);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getTitle($id)
    {
        $this->db->select('postTitle');
        $this->db->where('postId', $id);
        $query = $this->db->get('posts');

        if($query->num_rows() != 1){
            return false;
        }
        return $query->row()->postTitle;
    }

    public function getDetail($id)
    {
        $this->db->trans_begin();
        $query = $this->db->select('posts.postId, posts.postTitle, posts.publishDate, posts.postAuthor, posts.postPicture, posts.content, posts.categoryId, category.categoryName')->from('posts')->join('category', 'posts.categoryId = category.categoryId', 'left')->where('posts.postId', $id)->get();
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }else
        {
            return $query->result_array();
        }
    }

    public function checkPostIsExist($title)
    {
        return $this->db->get_where('posts', ['postTitle' => $title]);
    }

    public function addPost($title, $author, $date, $categoryId, $content, $picture)
    {
        $data = array(
            'postId' => NULL,
            'postTitle' => str_replace(array("\r","\n",'\r','\n', "'"), "", $title),
            'postAuthor' => str_replace(array("\r","\n",'\r','\n', "'"), "", $author),
            'categoryId' => str_replace(array("\r","\n",'\r','\n', "'"), "", $categoryId),
            'content' => str_replace(array("\r","\n",'\r','\n', "'"), "", $content),
            'publishDate' => str_replace(array("\r","\n",'\r','\n', "'"), "", $date),
            'postPicture' => str_replace(array("\r","\n",'\r','\n', "'"), "", $picture)
        );

        $this->db->insert('posts', $data);
    }

    public function updatePost($postId, $title, $author, $date, $categoryId, $content, $picture)
    {
        $this->db->set('postTitle', str_replace(array("\r","\n",'\r','\n', "'"), "", $title));
        $this->db->set('postAuthor', str_replace(array("\r","\n",'\r','\n', "'"), "", $author));
        $this->db->set('publishDate', str_replace(array("\r","\n",'\r','\n', "'"), "", $date));
        $this->db->set('categoryId', str_replace(array("\r","\n",'\r','\n', "'"), "", $categoryId));
        $this->db->set('postPicture', str_replace(array("\r","\n",'\r','\n', "'"), "", $picture));

        $this->db->where('postId', $postId);
        $this->db->update('posts');
    }

    public function deletePost($id)
    {
        $this->db->where('postId', $id);
        $this->db->delete('posts');
    }


}
