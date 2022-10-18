<?php
session_start();
//Получения данных с формы
$Names = $_POST['Names'];
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$photo = $_POST['photo'];
//обработка
$Names = trim($Names);
$login = str_replace(' ', '', $login);

$email = str_replace(' ', '', $email);
$password = str_replace(' ', '', $password);
$confirmPassword = $_POST['confirmPassword'];
//sqlConnect
$connect = mysqli_connect('localhost', 'root', '', 'dambinovregauto') or die('error' . mysqli_connect_error());
mysqli_set_charset($connect, 'UTF-8');
//$con
$db = mysqli_fetch_array(mysqli_query($connect, "select * from 'dbuserdamb'"));
print_r($db);
function correctAutorization($Names) {
    echo "$Names, вы успешно зарегестрировались<br>";
    echo '<a href = "../Autorization/formAuto.php">Авторизоваться</a>';
}



if (!($password === $confirmPassword)) {
    $_SESSION['message'] = "Пароли не совпадают";
    header('Location: ../index.php');
} else {
    if($email===$db['email']){
        $_SESSION['message'] = "такой email существует";
        header('Location: ../index.php');
    }
    if($login===$db['login']){
        $_SESSION['message'] = "такой login существует";
        header('Location: ../index.php');
    }
    $path = 'imgUsers/' . time() . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], $path);
    echo $_FILES['tmp_name'];
    $sql = "INSERT INTO dbusersdamb(id, email,login, password, Names,photo) VALUES (Null, '$email','$login', '$password', '$Names','$path')";
    mysqli_query($connect, $sql);
    mysqli_close($connect);
    $_SESSION['message'] = "{$Names}, вы успешно зарегестрировались<br><a href = '../Autorization/formAuto.php'>Авторизоваться</a>";
    header('Location: ../index.php');

//    correctAutorization($Names);
}
