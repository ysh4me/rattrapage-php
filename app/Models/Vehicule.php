<?php

namespace App\Models;

use PDO;
use Exception;

class Vehicule {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create(array $data): bool {
        try {
            $query = "INSERT INTO vehicules (brand, model, year, engine, photo, collection) 
                      VALUES (:brand, :model, :year, :engine, :photo, :collection)";
    
            $stmt = $this->db->prepare($query);
    
            return $stmt->execute([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
                'engine' => $data['engine'],
                'photo' => $data['photo'], 
                'collection' => $data['collection'] ? 1 : 0, 
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du véhicule : " . $e->getMessage());
        }
    }
    

    public function getAll(): array {
        try {
            $query = "SELECT * FROM vehicules";
            $stmt = $this->db->query($query);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des véhicules : " . $e->getMessage());
        }
    }

    public function getById(int $id): array {
        try {
            $query = "SELECT * FROM vehicules WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du véhicule : " . $e->getMessage());
        }
    }

    public function update(int $id, array $data): bool {
        try {
            $query = "UPDATE vehicules 
                      SET brand = :brand, model = :model, year = :year, engine = :engine, photo = :photo, collection = :collection
                      WHERE id = :id";

            $stmt = $this->db->prepare($query);

            return $stmt->execute([
                'id' => $id,
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
                'engine' => $data['engine'],
                'photo' => $data['photo'], 
                'collection' => $data['collection'],
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour du véhicule : " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM vehicules WHERE id = :id";
            $stmt = $this->db->prepare($query);

            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du véhicule : " . $e->getMessage());
        }
    }
}