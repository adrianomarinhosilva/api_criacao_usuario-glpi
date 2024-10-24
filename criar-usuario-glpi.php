<?php
// config.php
define('API_URL', 'http://enderecodoseuglpi/apirest.php');
define('API_TOKEN', 'sua api token');
define('APP_TOKEN', 'seu app token');
define('SESSION_TOKEN', 'seu session token');

// Função para registrar logs
function writeLog($message) {
    $logFile = 'user_creation.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// Função para adicionar o perfil ao usuário
function addUserProfile($userId) {
    try {
        $url = API_URL . '/Profile_User/';
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . API_TOKEN,
            'App-Token: ' . APP_TOKEN,
            'Session-Token: ' . SESSION_TOKEN
        ];

        $data = [
            'input' => [
                'profiles_id' => 176,
                'users_id' => $userId,
                'entities_id' => 0, // Entidade raiz
                'is_recursive' => 1
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new Exception('Curl error ao adicionar perfil: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            writeLog("Perfil ID 176 adicionado com sucesso para o usuário ID: $userId");
            return true;
        } else {
            $errorMessage = json_decode($response, true);
            writeLog("Erro ao adicionar perfil para usuário ID $userId: " . json_encode($errorMessage));
            throw new Exception('Erro ao adicionar perfil: ' . ($errorMessage['message'] ?? 'Erro desconhecido'));
        }
    } catch (Exception $e) {
        writeLog("Exceção ao adicionar perfil: " . $e->getMessage());
        throw $e;
    }
}

// Função para adicionar telefone do usuário
function updateUserPhone($userId, $phone) {
    try {
        $url = API_URL . '/User/' . $userId;
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . API_TOKEN,
            'App-Token: ' . APP_TOKEN,
            'Session-Token: ' . SESSION_TOKEN
        ];

        $data = [
            'input' => [
                'id' => $userId,
                'phone' => $phone
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new Exception('Curl error ao adicionar telefone: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            writeLog("Telefone adicionado com sucesso para o usuário ID: $userId");
            return true;
        } else {
            $errorMessage = json_decode($response, true);
            writeLog("Erro ao adicionar telefone para usuário ID $userId: " . json_encode($errorMessage));
            throw new Exception('Erro ao adicionar telefone: ' . ($errorMessage['message'] ?? 'Erro desconhecido'));
        }
    } catch (Exception $e) {
        writeLog("Exceção ao adicionar telefone: " . $e->getMessage());
        throw $e;
    }
}

// Função para adicionar email do usuário
function addUserEmail($userId, $email) {
    try {
        $url = API_URL . '/UserEmail/';
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . API_TOKEN,
            'App-Token: ' . APP_TOKEN,
            'Session-Token: ' . SESSION_TOKEN
        ];

        $data = [
            'input' => [
                'users_id' => $userId,
                'email' => $email,
                'is_default' => 1,
                'is_dynamic' => 0
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new Exception('Curl error ao adicionar email: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            writeLog("Email adicionado com sucesso para o usuário ID: $userId");
            return true;
        } else {
            $errorMessage = json_decode($response, true);
            writeLog("Erro ao adicionar email para usuário ID $userId: " . json_encode($errorMessage));
            throw new Exception('Erro ao adicionar email: ' . ($errorMessage['message'] ?? 'Erro desconhecido'));
        }
    } catch (Exception $e) {
        writeLog("Exceção ao adicionar email: " . $e->getMessage());
        throw $e;
    }
}

// Função para criar usuário via API
function createUser($userData) {
    try {
        $url = API_URL . '/User/';
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . API_TOKEN,
            'App-Token: ' . APP_TOKEN,
            'Session-Token: ' . SESSION_TOKEN
        ];

        $data = [
            'input' => [
                'name' => $userData['username'],
                'realname' => $userData['realname'],
                'firstname' => $userData['firstname'],
                'password' => $userData['password'],
                'password2' => $userData['password'],
                'is_active' => 1
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        $responseData = json_decode($response, true);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            // Pegar o ID do usuário criado
            $userId = $responseData['id'] ?? $responseData['data']['id'] ?? null;
            
            if (!$userId) {
                throw new Exception('ID do usuário não encontrado na resposta');
            }

            // Adicionar email do usuário
            addUserEmail($userId, $userData['email']);
            
            // Adicionar telefone do usuário
            updateUserPhone($userId, $userData['phone']);
            
            // Adicionar perfil do usuário
            addUserProfile($userId);
            
            writeLog("Usuário criado com sucesso: " . $userData['username'] . " (ID: $userId)");
            return ['success' => true, 'message' => 'Usuário criado com sucesso!'];
        } else {
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Erro desconhecido';
            writeLog("Erro ao criar usuário: " . $userData['username'] . " - " . $errorMessage);
            return ['success' => false, 'message' => $errorMessage];
        }
        
    } catch (Exception $e) {
        writeLog("Exceção ao criar usuário: " . $e->getMessage());
        return ['success' => false, 'message' => 'Erro: ' . $e->getMessage()];
    }
}

// Processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = createUser($_POST);
    $message = $result['message'];
    $success = $result['success'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário GLPI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3><a href="sua_pagina_de_criacao_de_usuario.php" style="display: flex; justify-content: center; margin-bottom: 20px;">
    <img src="https://i.imgur.com/kOwxvUW.png" alt="Criar Novo Usuário GLPI" style="max-width: 100%; height: auto;" />
</a>
</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-<?php echo $success ? 'success' : 'danger'; ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de Usuário*</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="realname" class="form-label">Nome Completo*</label>
                                <input type="text" class="form-control" id="realname" name="realname" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Primeiro Nome*</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone*</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required 
                                       pattern="[0-9]{10,11}" title="Digite um telefone válido (10 ou 11 dígitos)">
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha*</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Criar Usuário</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
