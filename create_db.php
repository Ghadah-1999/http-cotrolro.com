**create_db.php:**

```php
<?php
$servername = "localhost";
$username = "rooot";
$password = "root";
$dbname = "create_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء جدول "buttons" لتخزين القيم المرتبطة بكل زر
    $sql = "CREATE TABLE buttons (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            button_name VARCHAR(30) NOT NULL,
            button_value VARCHAR(30) NOT NULL
            )";

    // تنفيذ الاستعلام لإنشاء الجدول
    $conn->exec($sql);

    echo "تم إنشاء القاعدة بنجاح";
} catch(PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>
```

**insert_buttons.php:**

```php
<?php
$servername = "localhost";
$username = "rooot";
$password = "root";
$dbname = "create_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إدخال قيم الأزرار في قاعدة البيانات
    $buttons = array(
        array("Forward", "Forward"),
        array("Backward", "Backward"),
        array("Left", "Left"),
        array("Right", "Right"),
        array("stop", "stop"),
        array("reset", "reset")
    );

    foreach ($buttons as $button) {
        $stmt = $conn->prepare("INSERT INTO buttons (button_name, button_value)
                                VALUES (:button_name, :button_value)");
        $stmt->bindParam(':button_name', $button[0]);
        $stmt->bindParam(':button_value', $button[1]);
        $stmt->execute();
    }

    echo "تم إدخال الأزرار بنجاح";
} catch(PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>

