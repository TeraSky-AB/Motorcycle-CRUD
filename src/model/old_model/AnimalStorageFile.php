<?php
require_once('model/Animal.php');
require_once('lib/ObjectFileDB.php');

class AnimalStorageFile implements AnimalStorage
{
    private $db;

    public function __construct($dbFile)
    {
        $this->db = new ObjectFileDB($dbFile);
    }

    public function reinit()
    {
        $this->db->deleteAll();
        $this->db->insert(new Animal('Médor', 'chien', 12));
        $this->db->insert(new Animal('Félix', 'chat', 4));
        $this->db->insert(new Animal('Denver', 'dinosaure', 800));
        $this->db->insert(new Animal('Booba', 'ours', 44));
    }

    public function read($id)
    {
        return $this->db->fetch($id);
    }

    public function readAll()
    {
        return $this->db->fetchAll();
    }

    public function create(Animal $animal)
    {
        return $this->db->insert($animal);
    }

    public function exists($id)
    {
        return $this->db->exists($id);
    }

    public function update($id, $obj)
    {
        $this->db->update($id, $obj);
    }

    public function delete($id)
    {
        $this->db->delete($id);
    }
}