<?php

class Fiets
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function create($merk, $type, $prijs)
    {
        $sql = "INSERT INTO fietsen (merk, type, prijs) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$merk, $type, $prijs]);
    }
    
    public function read($id)
    {
        $sql = "SELECT * FROM fietsen WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function update($id, $merk, $type, $prijs)
    {
        $sql = "UPDATE fietsen SET merk=?, type=?, prijs=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$merk, $type, $prijs, $id]);
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM fietsen WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM fietsen");
        return $stmt->fetchAll();
    }
}