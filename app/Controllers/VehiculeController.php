<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Models\Vehicule;

class VehiculeController
{
    private Vehicule $vehiculeModel;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8mb4';
        $pdo = new \PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->vehiculeModel = new Vehicule($pdo);
    }

    public function create()
    {
        require_once '../app/Views/form.php';
    }

    public function store()
    {
        $data = $_POST;

        $data['photo'] = $_FILES['photo'] ?? null;
        $data['collection'] = isset($data['collection']) ? '1' : '0';

        $errors = Validator::validate($data, [
            'brand' => 'required|min:3|max:30',
            'model' => 'required|min:3|max:30',
            'year' => 'required|integer|min_value:2000|max_value:' . (date('Y') + 1),
            'engine' => 'required|in:diesel,unleaded,electric',
            'photo' => 'required|file|type:image/jpeg,image/png|max_size:10',
            'collection' => 'boolean',
        ]);

        if (!empty($errors)) {
            require_once '../app/Views/form.php';
            return;
        }

        $data['photo'] = $_FILES['photo']['name'];
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $data['photo']);

        if ($this->vehiculeModel->create($data)) {
            header('Location: /vehicule/success');
            exit;
        } else {
            echo "Erreur lors de l'enregistrement du véhicule.";
        }
    }

    public function success()
    {
        require_once '../app/Views/success.php';
    }
}