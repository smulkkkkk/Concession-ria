<?php
// Inicia a sessão
session_start();

// Armazena dados na sessão
$_SESSION['usuario'] = 'João';
$_SESSION['email'] = 'joao@example.com';

echo "Sessão iniciada! Dados armazenados.";
?>