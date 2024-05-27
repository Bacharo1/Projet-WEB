<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Pays</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .productImg {
            width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Liste des Pays</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nom du Pays</th>
                        <th>Volume de Ventes</th>
                        <th>Revenu</th>
                        <th>Profit</th>
                        <th>Marge de Profit</th>
                        <th>Produit Principal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "marimoun", "marimoun", "pays_database");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM pays";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                  <td>{$row['nom_pays']}</td>
                                  <td>{$row['volume_ventes']}</td>
                                  <td>{$row['revenu']}</td>
                                  <td>{$row['profit']}</td>
                                  <td>{$row['marge_profit']}</td>
                                  <td>{$row['produit_principal']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucun pays trouvé</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
