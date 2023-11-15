<?php
require_once('model/Motorbike.php');
require_once('lib/ObjectFileDB.php');

class MotorbikeStorageFile implements MotorbikeStorage
{
    private $db;

    public function __construct($dbFile)
    {
        $this->db = new ObjectFileDB($dbFile);
    }

    public function reinit()
    {
        $this->db->deleteAll();
        $this->db->insert(new Motorbike('Yamaha', 'R1', 'Blue', 1000 , 2021));
        $this->db->insert(new Motorbike('Suzuki', 'GSX-R', 'MarineBlue', 600, 1998));
        $this->db->insert(new Motorbike('Honda', 'VFR', 'Red', 800, 2003));
        $this->db->insert(new Motorbike('Kawazaki', 'ER-5', 'Green', 500, 2005));
    }

    public function read($id)
    {
        return $this->db->fetch($id);
    }

    public function readAll()
    {
        return $this->db->fetchAll();
    }

    public function create(Motorbike $motorbike)
    {
        return $this->db->insert($motorbike);
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