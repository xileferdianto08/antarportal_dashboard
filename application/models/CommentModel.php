<?php
defined('BASEPATH') or exit('No direct script access allowed');

class commentModel extends CI_Model
{
    public function getCommentList()
    {
        $this->db->select("comments.*, users.lastName, users.firstName, users.fotoUser, posts.postTitle, posts.postId")->from("comments")->join('users', 'comments.userId = users.userId', 'left')->join('posts', 'comments.postId = posts.postId');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCommentsPerPost($id)
    {
        $this->db->select("comments.*, users.lastName, users.firstName, users.fotoUser")->from("comments")->join('users', 'comments.userId = users.userId', 'left')->where('postId', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteComment($id)
    {
        $this->db->where('commentId', $id);
        $this->db->delete('comments');
    }
}