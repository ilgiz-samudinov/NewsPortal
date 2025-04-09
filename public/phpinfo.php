<?php
echo "Доступные драйверы PDO: ";
echo implode(", ", PDO::getAvailableDrivers());
?>
