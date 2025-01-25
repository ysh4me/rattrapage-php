CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(30) NOT NULL,
    model VARCHAR(30) NOT NULL,
    year INT NOT NULL,
    engine ENUM('diesel', 'unleaded', 'electric') NOT NULL,
    photo VARCHAR(255) NOT NULL,
    collection BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

